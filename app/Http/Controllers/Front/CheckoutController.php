<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Front\Cart;
use App\Models\Front\CartProduct;
use App\Models\Payment;
use App\Models\RentalProduct;
use App\Models\RentalPayment;
use App\Models\RentalOrder;
use App\Models\RentalAddress;
use App\Models\Admin\Order;
use App\Models\Admin\OrderItem;
use App\Models\Admin\Product;
use App\Models\Admin\Status;
use App\Models\Admin\OrderAddress;
use App\Models\Front\Adress;
use App\Models\User;
use App\Services\RazorpayService;
use Razorpay\Api\Api;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use App\Mail\confimorderEmail;
use App\Mail\RentalConfirmationMail;
use Illuminate\Support\Facades\Mail;


class CheckoutController extends Controller
{
    protected $razorpayService;

    public function __construct(RazorpayService $razorpayService)
    {
        $this->razorpayService = $razorpayService;
    }

    public function checkoutAll(Request $request)
    {
        DB::beginTransaction();
        Log::channel('payment_log')->info('Initiating combined checkout', ['user_id' => Auth::id()]);

        if (!Auth::check() || !Auth::user()->hasRole('Customer')) {
            return response()->json([
                'message' => 'Please login to proceed with payment.',
            ], 401);
        }

        try {
            $address = Adress::where([
                ['customer_id', '=', Auth::id()],
                ['is_delivery_address', '=', true]
            ])->first();

            if (!$address) {
                Log::channel('payment_log')->warning('Delivery address not found', ['user_id' => Auth::id()]);
                return response()->json(['message' => 'Please add a delivery address.'], 404);
            }

            $cartId = $request->input('cart_id');
            $cart = Cart::with(['cartProducts.product'])->where('id', $cartId)->first();
            
            if (!$cart) {
                Log::channel('payment_log')->error('Cart not found', ['cart_id' => $cartId]);
                return response()->json(['error' => 'Cart not found'], 404);
            }

            // Separate buy and rental items
            $buyItems = [];
            $rentalItems = [];
            $cartProductsCount = 0;
            
            foreach ($cart->cartProducts as $cartItem) {
                if ($cartItem->is_visible == 1) {
                    $cartProductsCount++;
                    if (isset($cartItem->is_rental) && $cartItem->is_rental == 1) {
                        $rentalItems[] = $cartItem;
                    } else {
                        $buyItems[] = $cartItem;
                    }
                }
            }

            if ($cartProductsCount == 0) {
                Log::channel('payment_log')->warning('Cart is empty', ['cart_id' => $cart->id]);
                return response()->json(['error' => 'At least one item should be in cart.'], 404);
            }

            $totalAmount = 0.0;
            $paymentData = [];

            // Process buy items
            if (!empty($buyItems)) {
                $buyOrder = $this->processBuyItems($buyItems, Auth::user());
                $totalAmount += (float)($buyOrder['total'] ?? 0);
                $paymentData['buy_order_id'] = $buyOrder['order_id'];
            }

            // Process rental items
            if (!empty($rentalItems)) {
                $rentalOrder = $this->processRentalItems($rentalItems, Auth::user());
                $totalAmount += (float)($rentalOrder['total'] ?? 0);
                $paymentData['rental_order_id'] = $rentalOrder['order_id'];
            }

            // Apply discount if any
            if (!empty($cart->discount_offer_amount)) {
                $totalAmount -= $cart->discount_offer_amount;
            }

            $totalAmount = max($totalAmount, 0);
            $totalAmount =round($totalAmount, 2);
            
            // Ensure amount is properly formatted for Razorpay (in paise)
            $amountInPaise = round($totalAmount * 100);
            $amountInPaise= (int) $amountInPaise;
            // Debug logging for amount calculation
            Log::channel('payment_log')->info('Amount calculation debug', [
                'total_amount' => $totalAmount,
                'amount_in_paise' => $amountInPaise,
                'buy_items_count' => count($buyItems),
                'rental_items_count' => count($rentalItems),
                'cart_discount' => $cart->discount_offer_amount ?? 0,
            ]);

            // Create Razorpay order
            try {
                $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
                $res = $api->order->create([
                    'receipt' => 'COMBINED-' . time(),
                    'amount' => $amountInPaise,
                    'currency' => 'INR',
                ]);

                if (isset($res['id'])) {
                    Log::channel('payment_log')->info('Razorpay order created', ['razorpay_order_id' => $res['id']]);
                } else {
                    throw new \Exception('Failed to create order in Razorpay.');
                }
            } catch (\Exception $e) {
                Log::channel('payment_log')->error('Razorpay error', ['message' => $e->getMessage()]);
                DB::rollBack();
                return response()->json(['error' => 'Payment gateway error', 'message' => $e->getMessage()], 500);
            }

            DB::commit();
            
            // Cache the cart for payment verification
            $cacheKey = 'combined_cart_' . Auth::id() . '_' . $res['id'];
            Cache::put($cacheKey, $cart->id, now()->addMinutes(15));
            
            $customer = User::where('id', Auth::user()->id)->first();
            
            return response()->json([
                'success' => true,
                'amount' => round($totalAmount, 2),
                'customer' => $customer,
                'order_id' => $res['id'],
            ]);

        } catch (\Exception $e) {
            Log::channel('payment_log')->error('Combined checkout failed', ['message' => $e->getMessage()]);
            DB::rollBack();
            return response()->json(['error' => 'Something went wrong', 'message' => $e->getMessage()], 500);
        }
    }

    private function processBuyItems($buyItems, $user)
    {
        $total = 0;
        $gst = 0;
        $otherCharges = 0;
        $orderItemsData = [];

        // Create order
        $order = Order::create([
            'cart_id' => null, // Will be updated later
            'offer_id' => null, // Will be updated later
            'customer_id' => $user->id,
            'amount' => 0,
            'status_id' => 1,
            'razorpay_order_id' => null,
        ]);

        // Process each buy item
        foreach ($buyItems as $cartItem) {
            $productPrice = (float)($cartItem->product->our_price ?? 0);
            $productGST = (float)($cartItem->product->gst ?? 0);
            $productDelivery = (float)($cartItem->product->delivery_and_installation_fees ?? 0);
            $productMaintenance = (float)($cartItem->product->maintenance ?? 0);
            $quantity = (int)($cartItem->quantity ?? 1);
            
            $itemTotal = $productPrice * $quantity;
            $itemGST = round(($itemTotal * $productGST) / 100, 2);
            $itemOtherCharges = $productMaintenance + $productDelivery;

            $total += $itemTotal;
            $gst += $itemGST;
            $otherCharges += $itemOtherCharges;

            $totalAmount = $itemTotal + $itemGST + $productDelivery + $productMaintenance;
            
            $orderItemsData[] = [
                'product_id' => $cartItem->product_id,
                'quantity' => $quantity,
                'price' => $productPrice,
                'delivery_and_installation_fees' => $productDelivery,
                'maintenance' => $productMaintenance,
                'gst' => $itemGST,
                'total_amount' => $totalAmount,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Update order totals
        $finalTotal = max($total + $gst + $otherCharges, 0);
        $order->update([
            'amount' => $finalTotal,
            'gst' => $gst,
        ]);

        // Create order items
        foreach ($orderItemsData as $item) {
            $item['order_id'] = $order->id;
            $item['status_id'] = 1; // Pending status
            OrderItem::create($item);
        }

        return [
            'order_id' => $order->id,
            'total' => $finalTotal,
        ];
    }

    private function processRentalItems($rentalItems, $user)
    {
        $totalAmount = 0;
        $rentalOrderIds = [];

        // Process each rental item
        foreach ($rentalItems as $cartItem) {
            $product = $cartItem->product;
            $tenure = $cartItem->tenure ?? 1;
            
            // Calculate rental amounts using tier-based percentage
            $rentalPercentages = $product->renting_presentag ? explode('|', $product->renting_presentag) : ['10'];
            $tenures = $product->rent_tenur ? explode('|', $product->rent_tenur) : ['1'];
            
            // Find the index of the selected tenure
            $tenureIndex = array_search($tenure, $tenures);
            if ($tenureIndex === false) {
                $tenureIndex = 0; // Default to first option
            }
            
            // Get the corresponding rental percentage
            $rentalPercentage = isset($rentalPercentages[$tenureIndex]) ? (float)$rentalPercentages[$tenureIndex] : 10;
            
            $productPrice = (float)($product->our_price ?? 0);
            $totalRent = ($productPrice * $rentalPercentage) / 100;
            $monthlyRent=$totalRent/$tenure;
            $gstAmount = $totalRent * 0.18;
            $depositAmount = $productPrice * 0.25;
            $deliveryFees = (float)($product->delivery_and_installation_fees ?? 0);
            

            
            $itemTotal = $totalRent + $gstAmount + $depositAmount + $deliveryFees;
            $montlyTotal=$monthlyRent + ($gstAmount/$tenure) + $deliveryFees + $depositAmount;
            $totalAmount += $montlyTotal;

            // Create rental order for each product
            $rentalOrder = RentalOrder::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'tenure' => $tenure,
                'base_amount' => $totalRent,
                'gst_amount' => $gstAmount,
                'delivery_fees' => $deliveryFees,
                'total_amount' => $itemTotal,
                'status' => 'pending',
            ]);

            $rentalOrderIds[] = $rentalOrder->id;

            // Create rental product
            $rentalProduct = RentalProduct::create([
                'rental_order_id' => $rentalOrder->id,
                'product_id' => $product->id,
                'user_id' => $user->id,
                'tenure' => $tenure,
                'monthly_rent' => $monthlyRent,
                'total_rent' => $totalRent,
                'deposit_amount' => $depositAmount,
                'gst_amount' => $gstAmount,
                'delivery_fees' => $deliveryFees,
                'total_amount' => $itemTotal,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths($tenure),
                'status' => 'placed',
            ]);

            // Create monthly rental payments (only first month is paid initially)
            for ($month = 1; $month <= $tenure; $month++) {
                $dueDate = Carbon::now()->addMonths($month - 1);
                $status = $month == 1 ? 'paid' : 'pending';
                $paidDate = $month == 1 ? Carbon::now() : null;

                RentalPayment::create([
                    'rental_product_id' => $rentalProduct->id,
                    'user_id' => $user->id,
                    'month_number' => $month,
                    'amount' => $monthlyRent,
                    'due_date' => $dueDate,
                    'paid_date' => $paidDate,
                    'status' => $status,
                ]);
            }
        }

        return [
            'order_id' => $rentalOrderIds[0], // Return first order ID for compatibility
            'total' => $totalAmount,
            'rentalPercentage' => $rentalPercentage,
        ];
    }

    public function verifyPayment(Request $request)
    {
        DB::beginTransaction();
        Log::channel('payment_log')->info('Payment verification callback received', ['request_data' => $request->all()]);

        try {
            if (!Auth::check()) {
                Log::channel('payment_log')->warning('User not authenticated during payment verification');
                return response()->json(['error' => 'User not authenticated.'], 401);
            }

            $user = Auth::user();
            $paymentId = $request->input('razorpay_payment_id');
            $orderId = $request->input('razorpay_order_id');
            $signature = $request->input('razorpay_signature');

            // Verify payment signature
            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
            $attributes = [
                'razorpay_order_id' => $orderId,
                'razorpay_payment_id' => $paymentId,
                'razorpay_signature' => $signature
            ];
            // return $attributes;

            try {
                $api->utility->verifyPaymentSignature($attributes);
            } catch (\Exception $e) {
                Log::channel('payment_log')->error('Payment verification failed', ['message' => $e->getMessage()]);
                DB::rollBack();
                return response()->json(['error' => 'Payment verification failed.'], 400);
            }

            // Get cached cart data
            $cacheKey = 'combined_cart_' . Auth::id() . '_' . $orderId;
            $cacheCartId = Cache::get($cacheKey);
            
            if (!$cacheCartId) {
                Log::channel('payment_log')->error('Cart not found in cache', ['order_id' => $orderId]);
                return response()->json(['error' => 'Order session expired. Please try again.'], 400);
            }

            $cart = Cart::with('cartProducts.product')->where('id', $cacheCartId)->first();
            
            if (!$cart) {
                Log::channel('payment_log')->error('Cart not found', ['cart_id' => $cacheCartId]);
                return response()->json(['error' => 'Cart not found.'], 404);
            }

            // Update order statuses based on cart items
            foreach ($cart->cartProducts as $cartItem) {
                if ($cartItem->is_visible) {
                    if (isset($cartItem->is_rental) && $cartItem->is_rental == 1) {
                        // Update rental order status
                        $rentalOrder = RentalOrder::where('product_id', $cartItem->product_id)
                            ->where('user_id', Auth::id())
                            ->where('status', 'pending')
                            ->first();
                        
                        if ($rentalOrder) {
                            $rentalOrder->update([
                                'status' => 'completed',
                                'razorpay_payment_id' => $paymentId,
                                'payment_verified_at' => Carbon::now(),
                            ]);
                            $deliveryAddress = Adress::where([
                                ['customer_id', '=', Auth::id()],
                                ['is_delivery_address', '=', true]
                                
                            ])->first();
                            $deliveryAddress->rental_order_id = $rentalOrder->id;
                
                            if ($deliveryAddress) {
                                $orderAddress = RentalAddress::create($deliveryAddress->toArray());
                                Log::channel('payment_log')->info('Order address created', ['order_address_id' => $orderAddress->id]);
                            }
                            $rentalOrder = RentalOrder::with('rentalProducts.product','rentalAddress')->where('id', $rentalOrder->id)->first();
                            Mail::to($user->email)->send(new RentalConfirmationMail($rentalOrder));
                        }
                    } else {
                        // Update buy order status
                        $order = Order::where('customer_id', Auth::id())
                            ->where('status_id', 1)
                            ->first();
                        
                        if ($order) {
                            $order->update([
                                'status_id' => 2,
                                'razorpay_payment_id' => $paymentId,
                                'payment_response' => json_encode($request->all()),
                            ]);
                            $order->order_id = $order->id;
                            $orderItem=OrderItem::where('order_id',$order->id)->get()->toArray();
                            foreach ($orderItem as $item) {
                                $item['order_id'] = $order->id;
                                $item['status_id'] = 2;
                                OrderItem::create($item);
                            }
                            $deliveryAddress = Adress::where([
                                ['customer_id', '=', Auth::id()],
                                ['is_delivery_address', '=', true]
                                
                            ])->first();
                            $deliveryAddress->order_id = $order->id;
                
                            if ($deliveryAddress) {
                                $orderAddress = OrderAddress::create($deliveryAddress->toArray());
                                Log::channel('payment_log')->info('Order address created', ['order_address_id' => $orderAddress->id]);
                            }
                            $order = Order::with('orderItems.product', 'orderAddress')->where('id', $order->id)->first();

                            if ($order) {
                                foreach ($order->orderItems as $item) {
                                    if ($item->status_id != 2) {
                                        $item->delete();
                                    }
                                }
                            }
                            
                            $order = Order::with('orderItems.product','orderAddress')->where('id', $order->id)->first();
                            Mail::to($user->email)->send(new confimorderEmail($order));
                        }
                    }
                }
            }

            // Create order address
         

            // Clear cart and cache
            Cart::where('id', $cacheCartId)->delete();
            Cache::forget($cacheKey);

            DB::commit();
            Log::channel('payment_log')->info('Payment verified successfully', ['order_id' => $orderId]);

            return response()->json([
                'success' => true,
                'message' => 'Payment verified successfully',
                'order_id' => $orderId,
            ]);

        } catch (\Exception $e) {
            Log::channel('payment_log')->error('Payment verification error', ['message' => $e->getMessage()]);
            DB::rollBack();
            return response()->json(['error' => 'An error occurred while processing payment.'], 500);
        }
    }
}

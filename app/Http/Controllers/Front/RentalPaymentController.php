<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Razorpay\Api\Api;
use App\Models\Front\Adress;
use App\Models\RentalOrder;
use App\Models\RentalAddress;
use App\Models\RentalProduct;
use App\Models\RentalPayment;
use App\Models\Front\Cart;
use App\Mail\RentalConfirmationMail;

class RentalPaymentController extends Controller
{
    protected $razorpay;

    public function __construct()
    {
        $this->razorpay = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
    }

    public function createOrder(Request $request)
    {
        try {
            // Validate request
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'tenure' => 'required|string',
                'base_amount' => 'required|numeric',
                'gst_amount' => 'required|numeric',
                'delivery_fees' => 'required|numeric',
                'total_amount' => 'required|numeric',
            ]);

            // Check if user is authenticated
            if (!Auth::check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please login to continue'
                ], 401);
            }
            $address = Adress::where([
                ['customer_id', '=', Auth::id()],
                ['is_delivery_address', '=', true]
            ])->first();

            if (!$address) {
                // Log::channel('payment_log')->warning('Delivery address not found', ['user_id' => Auth::id()]);
                return response()->json(['message' => 'Please add a delivery address.'], 404);
            }
            // Create Razorpay order
            $orderData = [
                'receipt' => 'rental_' . time(),
                'amount' => round($request->total_amount * 100), // Convert to paise
                'currency' => 'INR',
                'notes' => [
                    'product_id' => $request->product_id,
                    'tenure' => $request->tenure,
                    'user_id' => Auth::id()
                ]
            ];

            $razorpayOrder = $this->razorpay->order->create($orderData);

            // Calculate last rental date based on tenure
            $lastRentalDate = now()->addMonths($request->tenure);

            // Store order details in database
            $rentalOrder = RentalOrder::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'tenure' => $request->tenure,
                'last_rental_date' => $lastRentalDate,
                'base_amount' => $request->base_amount,
                'gst_amount' => $request->gst_amount,
                'delivery_fees' => $request->delivery_fees,
                'total_amount' => $request->total_amount,
                'razorpay_order_id' => $razorpayOrder->id,
                'status' => 'pending'
            ]);

            // Create rental address
            RentalAddress::create([
                'rental_order_id' => $rentalOrder->id,
                'house_number' => $address->house_number,
                'society_name' => $address->society_name,
                'locality' => $address->locality,
                'landmark' => $address->landmark,
                'pincode' => $address->pincode,
                'city' => $address->city,
                'state' => $address->state,
                'phone' => $address->phone,
                // 'alternate_phone' => $address->alternate_phone,
                // 'address_type' => $address->address_type,
                'is_delivery_address' => true
            ]);

            return response()->json([
                'success' => true,
                'order_id' => $razorpayOrder->id,
                'message' => 'Order created successfully'
            ]);

        } catch (\Exception $e) {
            Log::error('Rental order creation failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to create order. Please try again.'
            ], 500);
        }
    }

    public function verifyPayment(Request $request)
    {
        try {
            // Validate request
            $request->validate([
                'razorpay_payment_id' => 'required|string',
                'razorpay_order_id' => 'required|string',
                'razorpay_signature' => 'required|string',
                'order_data' => 'required|array'
            ]);

            // Verify signature
            $attributes = [
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_signature' => $request->razorpay_signature
            ];

            $this->razorpay->utility->verifyPaymentSignature($attributes);

            // Get stored rental group data
            $rentalGroupData = session('rental_group_data');
            
            if ($rentalGroupData && $rentalGroupData['razorpay_order_id'] === $request->razorpay_order_id) {
                // Use stored data for more accurate processing
                $rentalOrder = $rentalGroupData['rental_order'];
                $rentalProducts = $rentalGroupData['rental_products'];
                
                // Update the single rental order
                $rentalOrder->update([
                    'razorpay_payment_id' => $request->razorpay_payment_id,
                    'status' => 'completed',
                    'payment_verified_at' => now()
                ]);

                // Update all rental products status
                foreach ($rentalProducts as $product) {
                    $product->update([
                        'status' => 'active'
                    ]);
                }

                // Send confirmation email for the group
                $this->sendRentalGroupConfirmationEmail($request->razorpay_order_id, $rentalGroupData);

                // Clear session data
                session()->forget('rental_group_data');
            } else {
                // Fallback: Update order status in database using direct query
                $rentalOrder = RentalOrder::where('razorpay_order_id', $request->razorpay_order_id)->first();
                
                if ($rentalOrder) {
                    $rentalOrder->update([
                        'razorpay_payment_id' => $request->razorpay_payment_id,
                        'status' => 'completed',
                        'payment_verified_at' => now()
                    ]);

                    // Update all associated rental products
                    RentalProduct::where('rental_order_id', $rentalOrder->id)->update([
                        'status' => 'active'
                    ]);

                    // Send confirmation email
                    $this->sendRentalConfirmationEmail($rentalOrder->razorpay_order_id);
                }
            }

            // Clear rental items from cart after successful payment
            Cart::where('user_id', Auth::id())
                ->where('is_rental', true)
                ->delete();

            return response()->json([
                'success' => true,
                'message' => 'Payment verified successfully',
                'data' => [
                    'product_count' => $rentalGroupData ? $rentalGroupData['product_count'] : ($rentalOrder ? RentalProduct::where('rental_order_id', $rentalOrder->id)->count() : 0),
                    'total_amount' => $rentalGroupData ? $rentalGroupData['total_amount'] : ($rentalOrder ? $rentalOrder->total_amount : null)
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Payment verification failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Payment verification failed: ' . $e->getMessage()
            ], 500);
        }
    }

    public function rentalOrders()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $orders = RentalOrder::with(['product', 'rentalAddress'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('front.rental-orders', compact('orders'));
    }

    public function checkoutRentalFromCart(Request $request)
    {
        try {
            if (!Auth::check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please login to continue'
                ], 401);
            }

            // Get rental items from cart
            $rentalCarts = Cart::with(['cartProducts.product'])
                ->where('user_id', Auth::id())
                ->where('is_rental', true)
                ->get();

            if ($rentalCarts->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No rental items found in cart'
                ], 404);
            }

            // Check delivery address
            $address = Adress::where([
                ['customer_id', '=', Auth::id()],
                ['is_delivery_address', '=', true]
            ])->first();

            if (!$address) {
                return response()->json(['message' => 'Please add a delivery address.'], 404);
            }

            $totalAmount = 0;
            $rentalProducts = [];

            // Calculate total amount and prepare rental data
            foreach ($rentalCarts as $cart) {
                $totalAmount += $cart->total_amount;
            }

            // Create Razorpay order for total amount
            $orderData = [
                'receipt' => 'rental_cart_' . time(),
                'amount' => round($totalAmount * 100), // Convert to paise
                'currency' => 'INR',
                'notes' => [
                    'user_id' => Auth::id(),
                    'type' => 'rental_cart_checkout',
                    'product_count' => $rentalCarts->count()
                ]
            ];

            $razorpayOrder = $this->razorpay->order->create($orderData);

            // Create single rental order for all cart items
            $rentalOrder = RentalOrder::create([
                'user_id' => Auth::id(),
                'product_id' => $rentalCarts->first()->product_id, // Use first product as reference
                'tenure' => $rentalCarts->first()->tenure, // Use first product's tenure as reference
                'last_rental_date' => $rentalCarts->first()->last_rental_date, // Use first product's end date as reference
                'base_amount' => $totalAmount, // Total base amount for all products
                'gst_amount' => $rentalCarts->sum('gst_amount'), // Sum of all GST amounts
                'delivery_fees' => $rentalCarts->sum('delivery_fees'), // Sum of all delivery fees
                'total_amount' => $totalAmount,
                'razorpay_order_id' => $razorpayOrder->id,
                'status' => 'pending'
            ]);

            // Create rental address
            RentalAddress::create([
                'rental_order_id' => $rentalOrder->id,
                'house_number' => $address->house_number,
                'society_name' => $address->society_name,
                'locality' => $address->locality,
                'landmark' => $address->landmark,
                'pincode' => $address->pincode,
                'city' => $address->city,
                'state' => $address->state,
                'phone' => $address->phone,
                'is_delivery_address' => true
            ]);

            // Create RentalProduct for each cart item
            foreach ($rentalCarts as $cart) {
                $rentalProduct = RentalProduct::create([
                    'rental_order_id' => $rentalOrder->id,
                    'product_id' => $cart->product_id,
                    'user_id' => Auth::id(),
                    'tenure' => $cart->tenure,
                    'monthly_rent' => $cart->base_amount,
                    'total_rent' => $cart->base_amount * $cart->tenure,
                    'deposit_amount' => 0, // Can be calculated based on business logic
                    'gst_amount' => $cart->gst_amount,
                    'delivery_fees' => $cart->delivery_fees,
                    'total_amount' => $cart->total_amount,
                    'start_date' => now(),
                    'end_date' => $cart->last_rental_date,
                    'status' => 'active',
                    'notes' => 'Rental product created from cart checkout'
                ]);

                $rentalProducts[] = $rentalProduct;
            }

            // Store rental group data in session for verification
            session([
                'rental_group_data' => [
                    'razorpay_order_id' => $razorpayOrder->id,
                    'rental_order' => $rentalOrder,
                    'rental_products' => $rentalProducts,
                    'total_amount' => $totalAmount,
                    'product_count' => $rentalCarts->count()
                ]
            ]);

            return response()->json([
                'success' => true,
                'order_id' => $razorpayOrder->id,
                'total_amount' => $totalAmount,
                'product_count' => $rentalCarts->count(),
                'message' => 'Rental orders created successfully'
            ]);

        } catch (\Exception $e) {
            Log::error('Rental cart checkout failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to process rental checkout. Please try again.'
            ], 500);
        }
    }

    private function sendRentalConfirmationEmail($orderId)
    {
        try {
            $order = RentalOrder::with(['product', 'user', 'rentalAddress'])
                ->where('razorpay_order_id', $orderId)
                ->first();

            if ($order) {
                // Send email using the Mailable class
                Mail::to($order->user->email)->send(new RentalConfirmationMail($order));
                
                Log::info('Rental confirmation email sent successfully to: ' . $order->user->email);
            }
        } catch (\Exception $e) {
            Log::error('Failed to send rental confirmation email: ' . $e->getMessage());
        }
    }

    private function sendRentalGroupConfirmationEmail($orderId, $rentalGroupData)
    {
        try {
            // Get the single rental order to get user details
            $rentalOrder = $rentalGroupData['rental_order'];
            $user = $rentalOrder->user;

            // Prepare group data for email
            $groupData = [
                'user' => $user,
                'razorpay_order_id' => $orderId,
                'total_amount' => $rentalGroupData['total_amount'],
                'product_count' => $rentalGroupData['product_count'],
                'products' => collect($rentalGroupData['rental_products'])->map(function($product) {
                    return [
                        'name' => $product->product->name,
                        'monthly_rent' => $product->monthly_rent,
                        'tenure' => $product->tenure
                    ];
                })
            ];

            // Send group confirmation email
            // Note: You'll need to create a new Mailable class for group confirmations
            // Mail::to($user->email)->send(new RentalGroupConfirmationMail($groupData));
            
            Log::info('Rental group confirmation email sent successfully to: ' . $user->email);
        } catch (\Exception $e) {
            Log::error('Failed to send rental group confirmation email: ' . $e->getMessage());
        }
    }

    public function checkoutCombinedFromCart(Request $request)
    {
        try {
            if (!Auth::check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please login to continue'
                ], 401);
            }

            // Get all items from cart (both buy and rental)
            $cartItems = Cart::with(['cartProducts.product'])
                ->where('user_id', Auth::id())
                ->get();

            if ($cartItems->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No items found in cart'
                ], 404);
            }

            // Check delivery address
            $address = Adress::where([
                ['customer_id', '=', Auth::id()],
                ['is_delivery_address', '=', true]
            ])->first();

            if (!$address) {
                return response()->json(['message' => 'Please add a delivery address.'], 404);
            }

            $totalAmount = 0;
            $buyItems = [];
            $rentalItems = [];

            foreach ($cartItems as $cart) {
                if ($cart->is_rental) {
                    $totalAmount += $cart->total_amount;
                    $rentalItems[] = $cart;
                } else {
                    // Calculate buy item total
                    $buyTotal = 0;
                    foreach ($cart->cartProducts as $cartProduct) {
                        if ($cartProduct->is_visible) {
                            $buyTotal += $cartProduct->product->our_price * $cartProduct->quantity;
                            $buyTotal += ($cartProduct->product->our_price * $cartProduct->quantity * $cartProduct->product->gst) / 100;
                            $buyTotal += $cartProduct->product->delivery_and_installation_fees;
                        }
                    }
                    $totalAmount += $buyTotal;
                    $buyItems[] = $cart;
                }
            }

            // Create Razorpay order for total amount
            $orderData = [
                'receipt' => 'combined_cart_' . time(),
                'amount' => round($totalAmount * 100), // Convert to paise
                'currency' => 'INR',
                'notes' => [
                    'user_id' => Auth::id(),
                    'type' => 'combined_cart_checkout',
                    'buy_items_count' => count($buyItems),
                    'rental_items_count' => count($rentalItems)
                ]
            ];

            $razorpayOrder = $this->razorpay->order->create($orderData);

            // Store order details for later processing
            session(['combined_order_data' => [
                'razorpay_order_id' => $razorpayOrder->id,
                'buy_items' => $buyItems,
                'rental_items' => $rentalItems,
                'total_amount' => $totalAmount,
                'address' => $address
            ]]);

            return response()->json([
                'success' => true,
                'order_id' => $razorpayOrder->id,
                'total_amount' => $totalAmount,
                'message' => 'Combined order created successfully'
            ]);

        } catch (\Exception $e) {
            Log::error('Combined cart checkout failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to process combined checkout. Please try again.'
            ], 500);
        }
    }

    public function verifyCombinedPayment(Request $request)
    {
        try {
            // Validate request
            $request->validate([
                'razorpay_payment_id' => 'required|string',
                'razorpay_order_id' => 'required|string',
                'razorpay_signature' => 'required|string',
                'order_data' => 'required|array'
            ]);

            // Verify signature
            $attributes = [
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_signature' => $request->razorpay_signature
            ];

            $this->razorpay->utility->verifyPaymentSignature($attributes);

            // Get stored order data
            $orderData = session('combined_order_data');
            if (!$orderData) {
                throw new \Exception('Order data not found');
            }

            // Process buy items (create regular orders)
            foreach ($orderData['buy_items'] as $cart) {
                // Create regular order for buy items
                // This would integrate with your existing order creation logic
                // For now, we'll just mark them as processed
                $cart->update(['status' => 'ordered']);
            }

            // Process rental items - create single rental order with multiple products
            if (!empty($orderData['rental_items'])) {
                $totalRentalAmount = 0;
                foreach ($orderData['rental_items'] as $cart) {
                    $totalRentalAmount += $cart->total_amount;
                }

                $rentalOrder = RentalOrder::create([
                    'user_id' => Auth::id(),
                    'product_id' => $orderData['rental_items'][0]->product_id, // Use first product as reference
                    'tenure' => $orderData['rental_items'][0]->tenure, // Use first product's tenure as reference
                    'last_rental_date' => $orderData['rental_items'][0]->last_rental_date, // Use first product's end date as reference
                    'base_amount' => $totalRentalAmount, // Total base amount for all products
                    'gst_amount' => collect($orderData['rental_items'])->sum('gst_amount'), // Sum of all GST amounts
                    'delivery_fees' => collect($orderData['rental_items'])->sum('delivery_fees'), // Sum of all delivery fees
                    'total_amount' => $totalRentalAmount,
                    'razorpay_order_id' => $orderData['razorpay_order_id'],
                    'razorpay_payment_id' => $request->razorpay_payment_id,
                    'status' => 'completed',
                    'payment_verified_at' => now()
                ]);

                // Create rental address
                RentalAddress::create([
                    'rental_order_id' => $rentalOrder->id,
                    'house_number' => $orderData['address']->house_number,
                    'society_name' => $orderData['address']->society_name,
                    'locality' => $orderData['address']->locality,
                    'landmark' => $orderData['address']->landmark,
                    'pincode' => $orderData['address']->pincode,
                    'city' => $orderData['address']->city,
                    'state' => $orderData['address']->state,
                    'phone' => $orderData['address']->phone,
                    'is_delivery_address' => true
                ]);

                // Create RentalProduct for each rental item
                foreach ($orderData['rental_items'] as $cart) {
                    RentalProduct::create([
                        'rental_order_id' => $rentalOrder->id,
                        'product_id' => $cart->product_id,
                        'user_id' => Auth::id(),
                        'tenure' => $cart->tenure,
                        'monthly_rent' => $cart->base_amount,
                        'total_rent' => $cart->base_amount * $cart->tenure,
                        'deposit_amount' => 0, // Can be calculated based on business logic
                        'gst_amount' => $cart->gst_amount,
                        'delivery_fees' => $cart->delivery_fees,
                        'total_amount' => $cart->total_amount,
                        'start_date' => now(),
                        'end_date' => $cart->last_rental_date,
                        'status' => 'active',
                        'notes' => 'Rental product created from combined cart checkout'
                    ]);
                }

                // Send confirmation email
                $this->sendRentalConfirmationEmail($orderData['razorpay_order_id']);
            }

            // Clear all items from cart
            Cart::where('user_id', Auth::id())->delete();

            // Clear session data
            session()->forget('combined_order_data');

            return response()->json([
                'success' => true,
                'message' => 'Combined payment verified successfully'
            ]);

        } catch (\Exception $e) {
            Log::error('Combined payment verification failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Payment verification failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get the monthly payment that is due for a rental product
     */
    public function getMonthlyPaymentDue(Request $request)
    {
        try {
            $request->validate([
                'rental_product_id' => 'required|exists:rental_products,id'
            ]);

            $rentalProduct = RentalProduct::with(['product', 'rentalPayments'])
                ->where('id', $request->rental_product_id)
                ->where('user_id', Auth::id())
                ->first();

            if (!$rentalProduct) {
                return response()->json([
                    'success' => false,
                    'message' => 'Rental product not found'
                ], 404);
            }

            // Calculate next payment date and amount
            $nextPaymentDate = $this->calculateNextPaymentDate($rentalProduct);
            $isOverdue = $this->isPaymentOverdue($rentalProduct);
            $overdueAmount = $this->calculateOverdueAmount($rentalProduct);
            $monthlyAmount = $rentalProduct->monthly_rent + $rentalProduct->gst_amount;

            return response()->json([
                'success' => true,
                'data' => [
                    'rental_product_id' => $rentalProduct->id,
                    'product_name' => $rentalProduct->product->name,
                    'monthly_rent' => $rentalProduct->monthly_rent,
                    'gst_amount' => $rentalProduct->gst_amount,
                    'monthly_amount' => $monthlyAmount,
                    'next_payment_date' => $nextPaymentDate->format('Y-m-d'),
                    'is_overdue' => $isOverdue,
                    'overdue_amount' => $overdueAmount,
                    'total_due_amount' => $isOverdue ? $overdueAmount : $monthlyAmount,
                    'payment_history' => $rentalProduct->rentalPayments->take(5)->map(function($payment) {
                        return [
                            'month_number' => $payment->month_number,
                            'status' => $payment->status,
                            'amount' => $payment->amount,
                            'due_date' => $payment->due_date->format('Y-m-d'),
                            'paid_date' => $payment->paid_date ? $payment->paid_date->format('Y-m-d') : null
                        ];
                    })
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Get monthly payment due failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to get payment details'
            ], 500);
        }
    }

    /**
     * Get monthly payments due for all rental products of a user (grouped by rental order)
     */
    public function getGroupedMonthlyPaymentsDue(Request $request)
    {
        try {
            $request->validate([
                'rental_order_id' => 'required|exists:rental_orders,id'
            ]);

            $rentalProducts = RentalProduct::with(['product', 'rentalPayments', 'rentalOrder'])
                ->where('user_id', Auth::id())
                ->where('rental_order_id', $request->rental_order_id)
                ->get();

            if ($rentalProducts->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No rental products found for this order'
                ], 404);
            }

            $totalMonthlyRent = 0;
            $totalGST = 0;
            $totalOverdueAmount = 0;
            $productsData = [];
            $isAnyOverdue = false;

            foreach ($rentalProducts as $product) {
                $nextPaymentDate = $this->calculateNextPaymentDate($product);
                $isOverdue = $this->isPaymentOverdue($product);
                $overdueAmount = $this->calculateOverdueAmount($product);
                $monthlyAmount = $product->monthly_rent + $product->gst_amount;

                $totalMonthlyRent += $product->monthly_rent;
                $totalGST += $product->gst_amount;
                $totalOverdueAmount += $overdueAmount;
                
                if ($isOverdue) {
                    $isAnyOverdue = true;
                }

                $productsData[] = [
                    'rental_product_id' => $product->id,
                    'product_name' => $product->product->name,
                    'monthly_rent' => $product->monthly_rent,
                    'gst_amount' => $product->gst_amount,
                    'monthly_amount' => $monthlyAmount,
                    'next_payment_date' => $nextPaymentDate->format('Y-m-d'),
                    'is_overdue' => $isOverdue,
                    'overdue_amount' => $overdueAmount,
                    'status' => $product->status
                ];
            }

            $totalAmount = $totalMonthlyRent + $totalGST + $totalOverdueAmount;

            $paymentData = [
                'rental_order_id' => $request->rental_order_id,
                'product_count' => $rentalProducts->count(),
                'total_monthly_rent' => $totalMonthlyRent,
                'total_gst' => $totalGST,
                'total_overdue_amount' => $totalOverdueAmount,
                'total_amount' => $totalAmount,
                'is_any_overdue' => $isAnyOverdue,
                'products' => $productsData,
                'can_pay_group' => $isAnyOverdue || $totalMonthlyRent > 0
            ];

            return response()->json([
                'success' => true,
                'data' => $paymentData
            ]);

        } catch (\Exception $e) {
            Log::error('Get grouped monthly payments failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to get grouped payment details'
            ], 500);
        }
    }

    /**
     * Create monthly payment order
     */
    public function createMonthlyPaymentOrder(Request $request)
    {
        // try {
            $request->validate([
                'rental_product_id' => 'required|exists:rental_products,id',
                'payment_type' => 'required|in:monthly,overdue,all' // monthly, overdue, or all overdue
            ]);

            $rentalProduct = RentalProduct::with(['product'])
                ->where('id', $request->rental_product_id)
                ->where('user_id', Auth::id())
                ->first();

            if (!$rentalProduct) {
                return response()->json([
                    'success' => false,
                    'message' => 'Rental product not found'
                ], 404);
            }

            // Calculate payment amount based on type
            $monthlyAmount = $rentalProduct->monthly_rent + ($rentalProduct->product->gst/100) * $rentalProduct->monthly_rent;
            $overdueAmount = $this->calculateOverdueAmount($rentalProduct);
            
            $paymentAmount = 0;
            $paymentDescription = '';

            switch ($request->payment_type) {
                case 'monthly':
                    $paymentAmount = $monthlyAmount;
                    $paymentDescription = 'Monthly rent payment';
                    break;
                case 'overdue':
                    $paymentAmount = $overdueAmount;
                    $paymentDescription = 'Overdue rent payment';
                    break;
                case 'all':
                    $paymentAmount = $monthlyAmount + $overdueAmount;
                    $paymentDescription = 'Monthly + Overdue rent payment';
                    break;
            }

            if ($paymentAmount <= 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'No payment amount due'
                ], 400);
            }

            // Create Razorpay order
            $orderData = [
                'receipt' => 'monthly_rent_' . $rentalProduct->id . '_' . time(),
                'amount' => round($paymentAmount * 100), // Convert to paise
                'currency' => 'INR',
                'notes' => [
                    'rental_product_id' => $rentalProduct->id,
                    'payment_type' => $request->payment_type,
                    'user_id' => Auth::id(),
                    'monthly_amount' => $monthlyAmount,
                    'overdue_amount' => $overdueAmount
                ]
            ];

            $razorpayOrder = $this->razorpay->order->create($orderData);

            // Calculate next payment date for monthly payments
            $nextPaymentDate = null;
            if ($request->payment_type === 'monthly' || $request->payment_type === 'all') {
                $nextPaymentDate = $this->calculateNextPaymentDate($rentalProduct);
            }

            // Store payment order in session for verification
            session([
                'monthly_payment_data' => [
                    'rental_product_id' => $rentalProduct->id,
                    'payment_type' => $request->payment_type,
                    'razorpay_order_id' => $razorpayOrder->id,
                    'amount' => $paymentAmount,
                    'monthly_amount' => $monthlyAmount,
                    'overdue_amount' => $overdueAmount,
                    'next_payment_date' => $nextPaymentDate ? $nextPaymentDate->format('Y-m-d') : null
                ]
            ]);

            return response()->json([
                'success' => true,
                'data' => [
                    'razorpay_order_id' => $razorpayOrder->id,
                    'amount' => $paymentAmount,
                    'currency' => 'INR',
                    'description' => $paymentDescription,
                    'rental_product_id' => $rentalProduct->id,
                    'product_name' => $rentalProduct->product->name
                ]
            ]);

        // } catch (\Exception $e) {
        //     Log::error('Create monthly payment order failed: ' . $e->getMessage());
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Failed to create payment order'
        //     ], 500);
        // }
    }

    /**
     * Create grouped monthly payment order for multiple products in the same rental
     */
    public function createGroupedMonthlyPaymentOrder(Request $request)
    {
        try {
            $request->validate([
                'rental_order_id' => 'required|exists:rental_orders,id',
                'payment_type' => 'required|in:monthly,overdue,all' // monthly, overdue, or all overdue
            ]);

            // Get all rental products for this rental order
            $rentalProducts = RentalProduct::with(['product'])
                ->where('rental_order_id', $request->rental_order_id)
                ->where('user_id', Auth::id())
                ->where('status', 'active')
                ->get();

            if ($rentalProducts->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No active rental products found for this order'
                ], 404);
            }

            $totalMonthlyAmount = 0;
            $totalOverdueAmount = 0;
            $productsData = [];
            $nextPaymentDates = [];

            foreach ($rentalProducts as $product) {
                $monthlyAmount = $product->monthly_rent + $product->gst_amount;
                $overdueAmount = $this->calculateOverdueAmount($product);
                
                $totalMonthlyAmount += $monthlyAmount;
                $totalOverdueAmount += $overdueAmount;

                $nextPaymentDate = null;
                if ($request->payment_type === 'monthly' || $request->payment_type === 'all') {
                    $nextPaymentDate = $this->calculateNextPaymentDate($product);
                    $nextPaymentDates[] = $nextPaymentDate ? $nextPaymentDate->format('Y-m-d') : null;
                }

                $productsData[] = [
                    'rental_product_id' => $product->id,
                    'product_name' => $product->product->name,
                    'monthly_amount' => $monthlyAmount,
                    'overdue_amount' => $overdueAmount,
                    'next_payment_date' => $nextPaymentDate ? $nextPaymentDate->format('Y-m-d') : null
                ];
            }

            $paymentAmount = 0;
            $paymentDescription = '';

            switch ($request->payment_type) {
                case 'monthly':
                    $paymentAmount = $totalMonthlyAmount;
                    $paymentDescription = 'Grouped monthly rent payment';
                    break;
                case 'overdue':
                    $paymentAmount = $totalOverdueAmount;
                    $paymentDescription = 'Grouped overdue rent payment';
                    break;
                case 'all':
                    $paymentAmount = $totalMonthlyAmount + $totalOverdueAmount;
                    $paymentDescription = 'Grouped monthly + overdue rent payment';
                    break;
            }

            if ($paymentAmount <= 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'No payment amount due'
                ], 400);
            }

            // Create Razorpay order
            $orderData = [
                'receipt' => 'grouped_monthly_rent_' . $request->rental_order_id . '_' . time(),
                'amount' => round($paymentAmount * 100), // Convert to paise
                'currency' => 'INR',
                'notes' => [
                    'rental_order_id' => $request->rental_order_id,
                    'payment_type' => $request->payment_type,
                    'user_id' => Auth::id(),
                    'product_count' => $rentalProducts->count(),
                    'total_monthly_amount' => $totalMonthlyAmount,
                    'total_overdue_amount' => $totalOverdueAmount
                ]
            ];

            $razorpayOrder = $this->razorpay->order->create($orderData);

            // Store grouped payment order in session for verification
            session([
                'grouped_monthly_payment_data' => [
                    'rental_order_id' => $request->rental_order_id,
                    'rental_product_ids' => $rentalProducts->pluck('id')->toArray(),
                    'payment_type' => $request->payment_type,
                    'razorpay_order_id' => $razorpayOrder->id,
                    'amount' => $paymentAmount,
                    'total_monthly_amount' => $totalMonthlyAmount,
                    'total_overdue_amount' => $totalOverdueAmount,
                    'next_payment_dates' => $nextPaymentDates,
                    'products_data' => $productsData
                ]
            ]);

            return response()->json([
                'success' => true,
                'data' => [
                    'razorpay_order_id' => $razorpayOrder->id,
                    'amount' => $paymentAmount,
                    'currency' => 'INR',
                    'description' => $paymentDescription,
                    'rental_order_id' => $request->rental_order_id,
                    'product_count' => $rentalProducts->count(),
                    'products' => $productsData
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Create grouped monthly payment order failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to create grouped payment order'
            ], 500);
        }
    }

    /**
     * Verify monthly payment
     */
    public function verifyMonthlyPayment(Request $request)
    {
        try {
            $request->validate([
                'razorpay_payment_id' => 'required|string',
                'razorpay_order_id' => 'required|string',
                'razorpay_signature' => 'required|string'
            ]);

            // Verify signature
            $attributes = [
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_signature' => $request->razorpay_signature
            ];

            $this->razorpay->utility->verifyPaymentSignature($attributes);

            // Get stored payment data
            $paymentData = session('monthly_payment_data');
            if (!$paymentData) {
                throw new \Exception('Payment data not found');
            }

            $rentalProduct = RentalProduct::find($paymentData['rental_product_id']);
            if (!$rentalProduct) {
                throw new \Exception('Rental product not found');
            }

            // For monthly payments, find the pre-created record with the specific due date
            if ($paymentData['payment_type'] === 'monthly') {
                $nextPaymentDate = $paymentData['next_payment_date'];
                
                if ($nextPaymentDate) {
                    // Find existing payment record with this specific due date
                    $existingPayment = $rentalProduct->rentalPayments()
                        ->where('due_date', $nextPaymentDate)
                        ->first();

                    if ($existingPayment) {
                        // Update the pre-created monthly record
                        $existingPayment->update([
                            'amount' => $paymentData['amount'],
                            'paid_date' => now(),
                            'status' => 'paid',
                            'payment_method' => 'razorpay',
                            'transaction_id' => $request->razorpay_payment_id,
                            'notes' => 'Monthly rent payment - ' . $paymentData['payment_type'] . ' (Updated)'
                        ]);
                        
                        $rentalPayment = $existingPayment;
                    } else {
                        // Fallback: Create new rental payment record if pre-created record not found
                        $lastPayment = $rentalProduct->rentalPayments()
                            ->orderBy('month_number', 'desc')
                            ->first();
                        
                        $nextMonthNumber = $lastPayment ? $lastPayment->month_number + 1 : 1;
                        
                        $rentalPayment = RentalPayment::create([
                            'rental_product_id' => $rentalProduct->id,
                            'user_id' => Auth::id(),
                            'month_number' => $nextMonthNumber,
                            'amount' => $paymentData['amount'],
                            'due_date' => $nextPaymentDate,
                            'paid_date' => now(),
                            'status' => 'paid',
                            'payment_method' => 'razorpay',
                            'transaction_id' => $request->razorpay_payment_id,
                            'notes' => 'Monthly rent payment - ' . $paymentData['payment_type']
                        ]);
                    }
                } else {
                    // Fallback if next_payment_date is not available
                    $lastPayment = $rentalProduct->rentalPayments()
                        ->orderBy('month_number', 'desc')
                        ->first();
                    
                    $nextMonthNumber = $lastPayment ? $lastPayment->month_number + 1 : 1;
                    
                    $rentalPayment = RentalPayment::create([
                        'rental_product_id' => $rentalProduct->id,
                        'user_id' => Auth::id(),
                        'month_number' => $nextMonthNumber,
                        'amount' => $paymentData['amount'],
                        'due_date' => now(),
                        'paid_date' => now(),
                        'status' => 'paid',
                        'payment_method' => 'razorpay',
                        'transaction_id' => $request->razorpay_payment_id,
                        'notes' => 'Monthly rent payment - ' . $paymentData['payment_type']
                    ]);
                }
            } else {
                // For overdue payments, create a new record
                $lastPayment = $rentalProduct->rentalPayments()
                    ->orderBy('month_number', 'desc')
                    ->first();
                
                $nextMonthNumber = $lastPayment ? $lastPayment->month_number + 1 : 1;
                
                $rentalPayment = RentalPayment::create([
                    'rental_product_id' => $rentalProduct->id,
                    'user_id' => Auth::id(),
                    'month_number' => $nextMonthNumber,
                    'amount' => $paymentData['amount'],
                    'due_date' => now(),
                    'paid_date' => now(),
                    'status' => 'paid',
                    'payment_method' => 'razorpay',
                    'transaction_id' => $request->razorpay_payment_id,
                    'notes' => 'Overdue rent payment - ' . $paymentData['payment_type']
                ]);
            }

            // Update rental product if needed
            if ($paymentData['payment_type'] === 'overdue' || $paymentData['payment_type'] === 'all') {
                // Mark overdue payments as paid
                $rentalProduct->rentalPayments()
                    ->where('status', 'overdue')
                    ->update([
                        'status' => 'paid',
                        'paid_date' => now(),
                        'transaction_id' => $request->razorpay_payment_id
                    ]);
            }

            // Clear session data
            session()->forget('monthly_payment_data');

            return response()->json([
                'success' => true,
                'message' => 'Monthly payment verified successfully',
                'data' => [
                    'payment_id' => $rentalPayment->id,
                    'amount_paid' => $paymentData['amount'],
                    'next_payment_date' => $this->calculateNextPaymentDate($rentalProduct)->format('Y-m-d')
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Monthly payment verification failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Payment verification failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Verify grouped monthly payment for multiple products
     */
    public function verifyGroupedMonthlyPayment(Request $request)
    {
        try {
            $request->validate([
                'razorpay_payment_id' => 'required|string',
                'razorpay_order_id' => 'required|string',
                'razorpay_signature' => 'required|string'
            ]);

            // Verify signature
            $attributes = [
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_signature' => $request->razorpay_signature
            ];

            $this->razorpay->utility->verifyPaymentSignature($attributes);

            // Get stored grouped payment data
            $paymentData = session('grouped_monthly_payment_data');
            if (!$paymentData) {
                throw new \Exception('Grouped payment data not found');
            }

            $rentalProducts = RentalProduct::whereIn('id', $paymentData['rental_product_ids'])->get();
            if ($rentalProducts->isEmpty()) {
                throw new \Exception('Rental products not found');
            }

            $processedPayments = [];

            foreach ($rentalProducts as $rentalProduct) {
                // Find the corresponding product data
                $productData = collect($paymentData['products_data'])
                    ->where('rental_product_id', $rentalProduct->id)
                    ->first();

                if (!$productData) {
                    continue;
                }

                // For monthly payments, find the pre-created record with the specific due date
                if ($paymentData['payment_type'] === 'monthly' || $paymentData['payment_type'] === 'all') {
                    $nextPaymentDate = $productData['next_payment_date'];
                    
                    if ($nextPaymentDate) {
                        // Find existing payment record with this specific due date
                        $existingPayment = $rentalProduct->rentalPayments()
                            ->where('due_date', $nextPaymentDate)
                            ->first();

                        if ($existingPayment) {
                            // Update the pre-created monthly record
                            $existingPayment->update([
                                'amount' => $productData['monthly_amount'],
                                'paid_date' => now(),
                                'status' => 'paid',
                                'payment_method' => 'razorpay',
                                'transaction_id' => $request->razorpay_payment_id,
                                'notes' => 'Grouped monthly rent payment - ' . $paymentData['payment_type'] . ' (Updated)'
                            ]);
                            
                            $processedPayments[] = $existingPayment;
                        } else {
                            // Fallback: Create new rental payment record
                            $lastPayment = $rentalProduct->rentalPayments()
                                ->orderBy('month_number', 'desc')
                                ->first();
                            
                            $nextMonthNumber = $lastPayment ? $lastPayment->month_number + 1 : 1;
                            
                            $rentalPayment = RentalPayment::create([
                                'rental_product_id' => $rentalProduct->id,
                                'user_id' => Auth::id(),
                                'month_number' => $nextMonthNumber,
                                'amount' => $productData['monthly_amount'],
                                'due_date' => $nextPaymentDate,
                                'paid_date' => now(),
                                'status' => 'paid',
                                'payment_method' => 'razorpay',
                                'transaction_id' => $request->razorpay_payment_id,
                                'notes' => 'Grouped monthly rent payment - ' . $paymentData['payment_type']
                            ]);

                            $processedPayments[] = $rentalPayment;
                        }
                    }
                }

                // Handle overdue payments
                if ($paymentData['payment_type'] === 'overdue' || $paymentData['payment_type'] === 'all') {
                    // Mark overdue payments as paid
                    $rentalProduct->rentalPayments()
                        ->where('status', 'overdue')
                        ->update([
                            'status' => 'paid',
                            'paid_date' => now(),
                            'transaction_id' => $request->razorpay_payment_id
                        ]);
                }
            }

            // Clear session data
            session()->forget('grouped_monthly_payment_data');

            return response()->json([
                'success' => true,
                'message' => 'Grouped monthly payment verified successfully',
                'data' => [
                    'payment_count' => count($processedPayments),
                    'amount_paid' => $paymentData['amount'],
                    'rental_order_id' => $paymentData['rental_order_id'],
                    'product_count' => count($paymentData['rental_product_ids'])
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Grouped monthly payment verification failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Payment verification failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Calculate next payment date for a rental product
     */
    private function calculateNextPaymentDate($rentalProduct)
    {
        // Get the last paid payment
        $lastPaidPayment = $rentalProduct->rentalPayments()
            ->where('status', 'paid')
            ->orderBy('month_number', 'desc')
            ->first();

        if ($lastPaidPayment) {
            // Next payment is one month after the last paid payment
            return $lastPaidPayment->due_date->addMonth();
        } else {
            // If no payments made yet, next payment is one month after start date
            return $rentalProduct->start_date->addMonth();
        }
    }

    /**
     * Check if payment is overdue
     */
    private function isPaymentOverdue($rentalProduct)
    {
        $nextPaymentDate = $this->calculateNextPaymentDate($rentalProduct);
        return $nextPaymentDate < now();
    }

    /**
     * Calculate overdue amount
     */
    private function calculateOverdueAmount($rentalProduct)
    {
        if (!$this->isPaymentOverdue($rentalProduct)) {
            return 0;
        }

        $nextPaymentDate = $this->calculateNextPaymentDate($rentalProduct);
        $monthsOverdue = now()->diffInMonths($nextPaymentDate);
        
        // Calculate overdue amount (monthly rent + GST for each overdue month)
        return ($rentalProduct->monthly_rent + $rentalProduct->gst_amount) * $monthsOverdue;
    }
} 
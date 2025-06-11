<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\RazorpayService;
use Razorpay\Api\Api;
use App\Models\Front\Cart;
use App\Models\Admin\Status;
use App\Models\Admin\Order;
use App\Models\Admin\OrderItem;
use App\Models\Admin\OrderAddress;
use App\Models\Admin\Product;
use App\Models\Front\Adress;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use App\Models\Admin\ProductAttribute;


class NewPaymentController extends Controller
{
    protected $razorpay;

    public function __construct(RazorpayService $razorpay)
    {
        $this->razorpay = $razorpay;
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        Log::channel('payment_log')->info('Initiating order creation', ['user_id' => Auth::id()]);

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

            $cart = Cart::with('cartProducts')->where('id', $request->cart_id)->first();

            if (!$cart) {
                Log::channel('payment_log')->error('Cart not found', ['cart_id' => $request->cart_id]);
                return response()->json(['error' => 'Cart not found'], 404);
            }

            // Process order items...
            Log::channel('payment_log')->info('Cart found', ['cart_id' => $cart->id, 'total_items' => count($cart->cartProducts)]);

            $total = 0;
            $gst = 0;
            $otherCharges=0;
            $orderItemsData = [];
            $cartProductsCount = 0;

            foreach ($cart->cartProducts as $product) {
                if ($product->is_visible) {
                    $cartProductsCount++;
                    $total += $product->price * $product->quantity;
                    $gst += ($product->price * $product->quantity * $product->product->gst / 100);
                    $otherCharges += $product->product->maintenance + $product->product->delivery_and_installation_fees;
                    $gstAmount = ($product->price * $product->quantity * $product->product->gst / 100);
                    $totalAmount = $product->price + $gstAmount + $product->product->delivery_and_installation_fees + $product->product->maintenance;
                    $orderItemsData[] = [
                        'product_id' => $product->product_id,
                        'quantity' => $product->quantity,
                        'price' => $product->price,
                        'delivery_and_installation_fees' => $product->product->delivery_and_installation_fees,
                        'maintenance' => $product->product->maintenance,
                        'gst' => $gstAmount,
                        'total_amount' => $totalAmount,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }

            if ($cartProductsCount == 0) {
                Log::channel('payment_log')->warning('Cart is empty', ['cart_id' => $cart->id]);
                return response()->json(['error' => 'At least one item should be in cart.'], 404);
            }

            // Apply discount
            if (!empty($cart->discount_offer_amount)) {
                $total -= $cart->discount_offer_amount;
            }

            $total = max($total + $gst + $otherCharges, 0);

            // Create Order
            $order = Order::create([
                'cart_id' => $cart->id,
                'offer_id' => $cart->discount_offer_id,
                'customer_id' => Auth::user()->id,
                'amount' => $total,
                'status_id' => 1,
                'razorpay_order_id' => null,
            ]);

            Log::channel('payment_log')->info('Order created', ['order_id' => $order->id, 'amount' => $total]);
            // Create Razorpay Order
            try {
                $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
                $res = $api->order->create([
                    'receipt' => (string)$order->id,
                    'amount' => intval($total * 100),
                    'currency' => 'INR',
                ]);
                
                if (isset($res['id'])) {
                    $order->update([
                        'payment_response' => json_encode($res),
                        'razorpay_order_id' => $res['id'],
                    ]);
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
            $cacheKey = 'cart_' . Auth::id() . '_' . $order->razorpay_order_id;
            Cache::put($cacheKey, $cart->id, now()->addMinutes(15));
            Log::channel('payment_log')->info('cacheKey', ['cacheKey' => $cacheKey]);
            $customer =  User::where('id', Auth::user()->id)->first();
            return response()->json([
                'success' => true,
                'amount' => $total,
                'customer' => $customer,
                'order_id' => $order->razorpay_order_id,
            ]);
        } catch (\Exception $e) {
            Log::channel('payment_log')->error('Order creation failed', ['message' => $e->getMessage()]);
            DB::rollBack();
            return response()->json(['error' => 'Something went wrong', 'message' => $e->getMessage()], 500);
        }
    }



    public function paymentSuccess(Request $request)
    {
        DB::beginTransaction();
        Log::channel('payment_log')->info('Payment success callback received', ['request_data' => $request->all()]);

        try {
            if (!Auth::check()) {
                Log::channel('payment_log')->warning('User not authenticated during payment success');
                return response()->json(['error' => 'User not authenticated.'], 401);
            }

            $user = Auth::user();
            $order = Order::where('razorpay_order_id', $request->razorpay_order_id)->first();

            if (!$order) {
                Log::channel('payment_log')->error('Order not found in payment success', ['order_id' => $request->razorpay_order_id]);
                return response()->json(['error' => 'Order not found.'], 404);
            }

            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
            $attributes = [
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature
            ];

            try {
                $api->utility->verifyPaymentSignature($attributes);
            } catch (\Exception $e) {
                Log::channel('payment_log')->error('Payment verification failed', ['message' => $e->getMessage()]);
                DB::rollBack();
                return response()->json(['error' => 'Payment verification failed.'], 400);
            }

            $order->update([
                'status_id' => 2,
                'payment_response' => json_encode($request->all()),
                'razorpay_payment_id' => $request->razorpay_payment_id,
            ]);
            $orderitemData = OrderItem::where('order_id', $order->id)->get()->toArray();
            // foreach ($orderitemData as $item) {
            //     $item['status_id'] = 2; // Update status to 'Paid'
            //     OrderItem::where('id', $item['id'])->update($item);
            // }
            Log::channel('payment_log')->info('Order marked as paid', ['order_id' => $order->id]);

            $cacheKey = 'cart_' . Auth::id() . '_'  . $request->razorpay_order_id;
            $cacheCartId = Cache::get($cacheKey);
            Log::channel('payment_log')->info('cacheKey payment success', ['cacheKey' => $cacheCartId]);
            $cart = Cart::with('cartProducts')->where('id', $cacheCartId)->first();
            $total = 0;
            $gst = 0;
            $orderItemsData = [];
            $cartProductsCount = 0;
            foreach ($cart->cartProducts as $product) {
                if ($product->is_visible) {
                    $cartProductsCount++;
                    $total += $product->price * $product->quantity;
                    $gst += ($product->price * $product->quantity * $product->product->gst / 100);
                    $otherCharges = $product->product->maintenance + $product->product->delivery_and_installation_fees;
                    $gstAmount = ($product->price * $product->quantity * $product->product->gst / 100);
                    $totalAmount = $product->price + $gstAmount + $product->product->delivery_and_installation_fees + $product->product->maintenance;
                    $orderItemsData[] = [
                        'product_id' => $product->product_id,
                        'quantity' => $product->quantity,
                        'price' => $product->price,
                        'delivery_and_installation_fees' => $product->product->delivery_and_installation_fees,
                         'maintenance' => $product->product->maintenance ? $product->product->maintenance : 0,
                        'gst' => $gstAmount,
                        'total_amount' => $totalAmount,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
            $deliveradress=Adress::where([
                ['customer_id', '=', Auth::id()],
                ['is_delivery_address', '=', true]
            ])->first();
            $deliveradress['order_id'] = $order->id;
            $orderAddress = OrderAddress::create($deliveradress->toArray());
            Log::channel('payment_log')->info('Order address created', ['order_address_id' => $orderAddress->id]);
            

            foreach ($orderItemsData as $item) {
                $item['order_id'] = $order->id; // Associate the item with the created order
                $item['status_id'] = 2; // Set initial status to 'Pending'
                OrderItem::create($item);
            }
            $orderitemData=OrderItem::where('order_id',$order->id)->get()->toArray();  
            // print_r($orderitemData);
            foreach ($orderitemData as $item) {
                $atribute=ProductAttribute::where('product_id',$item['product_id'])->first();
                $atribute->stock -= $item['quantity'];
                $atribute->save();
            }
            Cart::where('id', $cacheCartId)->delete();
            Cache::forget($cacheKey);

            DB::commit();
            $orderData= Order::with('orderItems.product', 'orderAddress')
                ->where('id', $order->id)
                ->first();
            return view('front.thank-you')->with('orderData', $orderData);
        } catch (\Exception $e) {
            Log::channel('payment_log')->error('Payment success error', ['message' => $e->getMessage()]);
            DB::rollBack();
            return response()->json(['error' => 'An error occurred while processing payment.'], 500);
        }
    }




    public function createOrder(Request $request, $productId)
    {
        $product = Product::with('productAttributes')->where('id', $productId)->first();
        if (!$product) {
            Log::channel('payment_log')->error('Product not found', ['product_id' => $productId]);
            return response()->json(['error' => 'Product not found'], 404);
        }

        // Check if product attributes exist and if stock is less than 1
        if (!$product->productAttributes || $product->productAttributes->stock < 1) {
            Log::channel('payment_log')->warning('Product out of stock', ['product_id' => $productId]);
            return response()->json(['error' => 'Product is out of stock!'], 400);
        }

        if (!Auth::check() || !Auth::user()->hasRole('Customer')) {
            Log::channel('payment_log')->warning('Unauthorized user attempted purchase');
            return response()->json(['message' => 'Please login to proceed with payment.'], 401);
        }

        $customerAddress = Adress::where([
            ['customer_id', '=', Auth::id()],
            ['is_delivery_address', '=', true]
        ])->first();

        if (!$customerAddress) {
            Log::channel('payment_log')->warning('No delivery address found', ['user_id' => Auth::id()]);
            return response()->json(['message' => 'Please add an address to proceed with payment.'], 400);
        }

        DB::beginTransaction();
        try {
            $gst = ($product->our_price * $product->gst / 100);
            $total = $product->our_price + $gst + $product->delivery_and_installation_fees;

            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
            $receiptId = 'ORD-' . strtoupper(uniqid());

            $orderData = [
                'receipt' => $receiptId,
                'amount' => intval($total * 100), // Convert to paise
                'currency' => 'INR',
                'payment_capture' => 1
            ];

            $order = $api->order->create($orderData);
            Log::channel('payment_log')->info('Razorpay order created', ['order' => $order]);

            // Cache the order temporarily
            $cacheKey = 'order_' . Auth::id() . '_' . $order->id;
            Cache::put($cacheKey, $product->id, now()->addMinutes(15));

            DB::commit();

            return response()->json([
                'id' => $order->id,
                'amount' => $order->amount,
                'customer' => Auth::user()
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::channel('payment_log')->error('Payment order creation failed', ['error' => $e->getMessage()]);

            if ($e instanceof \Razorpay\Api\Errors\Error) {
                return response()->json(['error' => 'Razorpay API error: ' . $e->getMessage()], 500);
            }

            return response()->json(['error' => 'An unexpected error occurred: ' . $e->getMessage()], 500);
        }
    }

    public function verifyPayment(Request $request)
    {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $paymentId = $request->input('razorpay_payment_id');
        $orderId = $request->input('razorpay_order_id');
        $signature = $request->input('razorpay_signature');

        Log::channel('payment_log')->info('Verifying payment', [
            'razorpay_order_id' => $orderId,
            'razorpay_payment_id' => $paymentId
        ]);

        $generatedSignature = hash_hmac('sha256', $orderId . '|' . $paymentId, env('RAZORPAY_SECRET'));

        if ($generatedSignature !== $signature) {
            Log::channel('payment_log')->error('Invalid payment signature', [
                'razorpay_order_id' => $orderId,
                'razorpay_payment_id' => $paymentId
            ]);
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        $cacheKey = 'order_' . Auth::id() . '_' . $orderId;
        $cacheProductId = Cache::get($cacheKey);
        if (!$cacheProductId) {
            Log::channel('payment_log')->error('Order not found in cache', ['order_id' => $orderId]);
            return response()->json(['error' => 'Order session expired. Please try again.'], 400);
        }

        $product = Product::with('productAttributes')->find($cacheProductId);
        if (!$product) {
            Log::channel('payment_log')->error('Product not found for order', ['product_id' => $cacheProductId]);
            return response()->json(['error' => 'Product not found.'], 404);
        }

        DB::beginTransaction();
        try {
            $gst = ($product->our_price * $product->gst / 100);
            $total = $product->our_price + $gst +$product->delivery_and_installation_fees;

            $order = new Order();
            $order->customer_id = Auth::id();
            $order->status_id = 1;
            $order->razorpay_order_id = $orderId;
            $order->gst = $gst;
            $order->amount = $total;
            $order->razorpay_payment_id = $paymentId;
            $order->razorpay_signature = $signature;
            $order->payment_response = json_encode($request->all());
            $order->save();

            $gstAmount = ($product->our_price * $product->gst / 100);
            $totalAmount = $product->our_price + $gstAmount + $product->delivery_and_installation_fees + $product->maintenance;

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'status_id' => 1, // Set initial status to 'Pending'
                'quantity' => 1,
                'price' => $product->our_price,
                'gst' => $gstAmount,
                'delivery_and_installation_fees' => $product->delivery_and_installation_fees,
                'maintenance' => $product->maintenance,
                'total_amount' => $totalAmount,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $orderitemData=OrderItem::where('order_id',$order->id)->get()->toArray();  
            // print_r($orderitemData);
            foreach ($orderitemData as $item) {
                $atribute=ProductAttribute::where('product_id',$item['product_id'])->first();
                $atribute->stock -= $item['quantity'];
                $atribute->save();
            }
            $deliveradress=Adress::where([
                ['customer_id', '=', Auth::id()],
                ['is_delivery_address', '=', true]
            ])->first();
            $deliveradress['order_id'] = $order->id;
            $orderAddress = OrderAddress::create($deliveradress->toArray());
            Log::channel('payment_log')->info('Order address created', ['order_address_id' => $orderAddress->id]);
            Cache::forget($cacheKey);

            DB::commit();
            Log::channel('payment_log')->info('Payment verified successfully', ['order_id' => $order->id]);

            return response()->json(['message' => 'Payment Verified','order_id' => $order->id]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::channel('payment_log')->error('Payment verification failed', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Payment processing failed. Please contact support.'], 500);
        }
    }
    public function getdataforthankyou(Request $request){
        $orderid=$request->order_id;
         $orderData= Order::with('orderItems.product', 'orderAddress')
                ->where('id', $orderid)
                ->first();
            return view('front.thank-you')->with('orderData', $orderData);
    }
}

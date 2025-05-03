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

class PaymentController extends Controller
{
    protected $razorpay;

    public function __construct(RazorpayService $razorpay)
    {
        $this->razorpay = $razorpay;
    }

    public function store(Request $request)
{
    DB::beginTransaction(); // Start a new database transaction

    
        // Ensure the user is logged in and has the 'Customer' role
        if (Auth::check() && Auth::user()->hasRole('Customer')) {
            try {
            // Check if a delivery address exists for the customer
            $deliveryAddressExists = Adress::where('customer_id', Auth::id())
                                            ->where('is_delivery_address', true)
                                            ->exists();

            if (!$deliveryAddressExists) {
                return response()->json(['message' => 'Please add delivery address.'], 404);
            }

            // Retrieve the cart and its products
            $cart = Cart::with('cartProducts')->where('id', $request->cart_id)->first();

            if (!$cart) {
                return response()->json(['error' => 'Cart not found'], 404);
            }

            // Initialize necessary variables
            $gst = 0;
            $total = 0;
            $orderItemsData = [];
            $cartProductsCount = 0;

            // Loop through the cart products and calculate total and GST
            foreach ($cart->cartProducts as $product) {
                if ($product->is_visible) {
                    $cartProductsCount++;
                    $total += $product->price * $product->quantity;
                    \Log::info(['GST Calculation' => ($product->price * $product->quantity * $product->product->gst / 100)]);
                    $gst += ($product->price * $product->quantity * $product->product->gst / 100);
                    $orderItemsData[] = [
                        'product_id' => $product->product_id,
                        'quantity' => $product->quantity,
                        'price' => $product->price,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }

            // Ensure the cart has at least one visible product
            if ($cartProductsCount == 0) {
                return response()->json(['error' => 'At least one item should be in cart.'], 404);
            }

            // Apply discount to the total if any
            if (!empty($cart->discount_offer_amount)) {
                $total -= $cart->discount_offer_amount;
            }

            // Calculate the final total amount (including GST)
            $total = $gst + $total;
            $total = max($total, 0); // Ensure total is non-negative

            // Create a new order record with a temporary status
            $order = Order::create([
                'cart_id' => $cart->id,
                'offer_id' => $cart->discount_offer_id,
                'customer_id' => Auth::user()->id,
                'amount' => $total,
                'status_id' => 1,
                'payment_response' => null,
                'razorpay_order_id' => null,
            ]);

            // Get the delivery address of the customer
            $address = Adress::where([
                'customer_id' => Auth::user()->id,
                'is_delivery_address' => true,
            ])->first();

            // Create the order address record
            $orderAddress = OrderAddress::create([
                'order_id' => $order->id,
                'house_number' => $address->house_number,
                'society_name' => $address->society_name,
                'locality' => $address->locality,
                'landmark' => $address->landmark,
                'pincode' => $address->pincode,
                'city' => $address->city,
                'state' => $address->state,
            ]);

            // Create order items
            foreach ($orderItemsData as $item) {
                $item['order_id'] = $order->id; // Associate the item with the created order
                OrderItem::create($item);
            }

            \Log::info(['Total' => $total]);

            // Razorpay payment gateway integration
            try {
                $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
                $res = $api->order->create([
                    'receipt' => (string)$order->id,
                    'amount' => intval($total * 100), // Amount in paise (100 paise = 1 INR)
                    'currency' => 'INR',
                ]);

                \Log::info(['Payment Response Order ID' => $res['id']]);

                if (isset($res)) {
                    $order->update([
                        'payment_response' => json_encode($res),
                        'razorpay_order_id' => $res['id'],
                    ]);
                } else {
                    throw new \Exception('Failed to create order in Razorpay.');
                }
            } catch (\Exception $e) {
                \Log::error(['Payment Error' => $e->getMessage()]);
                DB::rollBack(); // Rollback the transaction if payment fails
                return response()->json([
                    'error' => 'An error occurred while processing payment.',
                    'message' => $e->getMessage(),
                ], 500);
            }

            // Clear cart items after successful order
            $cart->cartProducts()->delete();
            $cart->delete();

            // Commit the transaction if everything is successful
            DB::commit();

            // Return success response with order details
            return response()->json([
                'success' => true,
                'amount' => $total,
                'order_id' => $order->razorpay_order_id,
                'customer' => Auth::user(),
            ]);

        } catch (\Exception $e) {
            DB::rollBack(); // Rollback the transaction if any exception occurs

            // Return error response
            return response()->json([
                'error' => 'An error occurred while processing your request.',
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
            ], 500);
        }
    } else {
        return response()->json([
            'message' => 'Please login to proceed with payment.',
        ], 401);
    }
}



    public function paymentSuccess(Request $request) {
        DB::beginTransaction();
        \Log::info(['$request' => $request->all()]);
        try {
        
            //add order address
            $orderAddress = Adress::where([
                'customer_id' => Auth::user()->id,
                'is_delivery_address' => true,
                ])->first();

            // $order = OrderAddress::create([
            //     'house_number' => $address->house_number, 
            //     'society_name' => $address->society_name,
            //     'locality' => $address->locality, 
            //     'landmark' => $address->landmark,
            //     'pincode' => $address->pincode, 
            //     'city' => $address->city, 
            //     'state' => $address->state,  
            // ]);
            $orderSummaryHtml = view('front.common.cart.payment-success')->render();
            DB::commit(); 
            return redirect()->route('cart')->with('orderAddress', $orderAddress);
        } catch (\Exception $e) {
            DB::rollBack(); 
    
            return response()->json([
                'error' => 'An error occurred while processing your request.',
                'message' => $e->getMessage(),
                'line' => $e->getLine()
            ], 500);
        }
    }    

    public function createOrder(Request $request, $productId)
{
    $product = Product::with('productAttributes')->where('id', $productId)->first();
    if (!$product) {
        return response()->json(['error' => 'Product not found'], 404);
    }

    // Check if product attributes exist and if stock is less than 1
    if (!$product->productAttributes || $product->productAttributes->stock < 1) {
        return response()->json(['error' => 'Product is out of stock!'], 400);
    }


    // Check if the user is logged in and has the 'Customer' role
    if (!Auth::check() || !Auth::user()->hasRole('Customer')) {
        return response()->json(['message' => 'Please login to proceed with payment.'], 401); 
    }

    $customerAddress = Adress::where([
        ['customer_id', '=', Auth::id()],
        ['is_delivery_address', '=', true]
    ])->first();
    
    if (!$customerAddress) {
        return response()->json(['message' => 'Please add an address to proceed with payment.'], 400); 
    }


    // Begin database transaction for order creation
    DB::beginTransaction();
    
    try {
        $gst = ($product->our_price * $product->gst / 100);
        $total = $product->our_price + $gst;

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $receiptId = 'ORD-' . strtoupper(uniqid());

        $orderData = [
            'receipt' => $receiptId,
            'amount' => intval($total * 100), // Amount in paise
            'currency' => 'INR',
            'payment_capture' => 1 // 1 for auto capture
        ];

        // Attempt to create the Razorpay order
        $order = $api->order->create($orderData);
        \Log::info(['order razopay' => $order]);

        // Cache the order temporarily for verification
        $cacheKey = 'order_' . Auth::id() . '_' . $order->id;
        Cache::put($cacheKey, $product->id, now()->addMinutes(5));

        return response()->json([
            'id' => $order->id,
            'amount' => $order->amount,
            'customer' => Auth::user()
        ]);

    } catch (\Exception $e) {
        Log::error('Create Order Error', ['message' => $e->getMessage(), 'line' => $e->getLine()]);
        
        // Handle specific errors (Razorpay, database, etc.)
        if ($e instanceof \Razorpay\Api\Errors\Error) {
            return response()->json(['error' => 'Razorpay API error: ' . $e->getMessage()], 500);
        }

        return response()->json(['error' => 'An unexpected error occurred: ' . $e->getMessage()], 500);
    } finally {
        DB::commit();
    }
}


    public function verifyPayment(Request $request)
    {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $paymentId = $request->input('razorpay_payment_id');
        $orderId = $request->input('razorpay_order_id');
        $signature = $request->input('razorpay_signature');

        $generatedSignature = hash_hmac('sha256', $orderId . '|' . $paymentId, env('RAZORPAY_SECRET'));

        if ($generatedSignature == $signature) {
            $cacheKey = 'order_' . Auth::id() . '_' . $orderId;
            $cacheProductId = Cache::get($cacheKey);
            $product = Product::with('productAttributes')->where('id', $cacheProductId)->first();
            $gst = ($product->price * 1 * $product->gst / 100);
            $total = $product->price + $gst;
            \Log::info(['product in order' => $product]);
            $order = new Order;
            $order->customer_id  = Auth::id();
            // $order->cart_id  = $cart->id;
            $order->status_id = 1;
            $order->razorpay_order_id = $orderId;
            $order->gst = $gst;
            $order->amount = $total;
            $order->razorpay_payment_id = $paymentId;
            $order->razorpay_signature = $signature;
            $order->payment_response = json_encode($request->all());
            $order->save();
           
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => 1,
                'price' => $product->price,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Cache::forget($cacheKey);
            return response()->json(['message' => 'Payment Verified']);
        } else {
            return response()->json(['error' => 'Invalid signature']);
        }
    }    
}    

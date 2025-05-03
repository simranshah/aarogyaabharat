<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Notifications\UserNotification;
use App\Models\Front\Cart;
use App\Models\Admin\Product;
use App\Models\Front\CartProduct;
use App\Models\Admin\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;
use App\Models\Admin\OfferAndDiscount;
use App\Models\Admin\ProductAttribute;
use App\Models\Front\Adress;

class CartController extends Controller
{
    public function index()
    {
        // Retrieve session ID from cache or session if not cached
        $session_id = Cache::get('session_id', Session::getId());
        \Log::info(['$session_id  cart controller' => $session_id]);
            $cartProducts = Cart::with('cartProducts.product', 'offer')
                ->Where('session_id', $session_id)
                ->orwhere('user_id', Auth::id())
                ->get();

            $offerOrDiscount = OfferAndDiscount::first();
            $customerAndAddresses = Auth::check() ? User::with(['addresses' => function ($query) {
                            $query->where('is_delivery_address', true);
                        }])->where('id', Auth::id())->first()->addresses 
                        : null;

            // dd($customerAndAddresses);
            return view('front.cart-new', compact('cartProducts', 'customerAndAddresses', 'offerOrDiscount'));
    }

    public function addToCart(Request $request, $productId)
    {
        $product = Product::with('productAttributes')->where('id', $productId)->first();
        if($product->productAttributes->stock < 1){
            return redirect()->back()->with('error', 'Product is out of stock!');
        }
        $session_id = Cache::get('session_id');

        // If the session ID doesn't exist in the cache, create a new one and store it
        if (!$session_id) {
            $session_id = Session::getId();
            Cache::put('session_id', $session_id);
        }

        $cart = Cart::where('user_id', Auth::id())
                ->orWhere('session_id', $session_id)
                ->first();

        if ($cart) {
            $cart->quantity += $request->input('quantity', 1);
            $cart->sub_total += ($product->price * $request->input('quantity', 1));

                
                $cartProduct = CartProduct::where('cart_id', $cart->id)
                ->where('product_id', $product->id)
                ->first();

                if ($cartProduct) {
                // Product exists, update quantity and subtotal
                $cartProduct->quantity += $request->input('quantity', 1);
                $cartProduct->total_price = $product->price * $cartProduct->quantity; // Update total price
                $cartProduct->save();

                // Update the cart's subtotal as well
                $cart->sub_total += ($product->price * $request->input('quantity', 1));
                } else {
                    $cartProduct = new CartProduct([
                        'cart_id' => $cart->id,
                        'product_id' => $product->id,
                        'price' => $product->price,
                        'quantity' => $request->input('quantity', 1),
                        'total_price' => $product->price * $request->input('quantity', 1),
                        ]);
                        $cartProduct->save();
                }
        } else {
            $cart = new Cart([
                'user_id' => Auth::id(),
                'session_id' => $session_id,
                'product_id' => $product->id,
                'quantity' => $request->input('quantity', 1),
                'price' => $product->price,
                'sub_total' => ($product->price * $request->input('quantity', 1)),
            ]);
            $cart->save();
            $cartProduct = new CartProduct([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'price' => $product->price,
                'quantity' => $request->input('quantity', 1),
                'total_price' => $product->price * $request->input('quantity', 1),
                ]);
                $cartProduct->save();
        }

        $cart->save();
        // $ProductAttribute = ProductAttribute::where('product_id', $productId)->first();
        // $ProductNewStock = $ProductAttribute->stock - 1;
        // $ProductAttribute->stock = $ProductNewStock;
        // $ProductAttribute->save();
        // Notify customer (if logged in)
        $customer = Auth::user();
        if ($customer) {
            $customer->notify(new UserNotification('Product added to cart', 'Your product has been added to cart, check now your cart.'));
        }

        return redirect()->route('cart')->with('success', 'Product added to cart!');
    }

    public function updateCart(Request $request, $cartId)
    {
        $session_id = Cache::get('session_id', Session::getId());

        $cart = Cart::where('id', $cartId)
            ->where(function ($query) use ($session_id) {
                $query->where('user_id', Auth::id())
                    ->orWhere('session_id', $session_id);
            })
            ->firstOrFail();

        $cart->quantity = $request->input('quantity');
        $cart->save();

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');
    }

    public function deleteItem(Request $request, $cartItemId)
        {
            $cartItem = CartProduct::with('cart')->where('id',$cartItemId)->first();

            if (!$cartItem) {
                return response()->json(['success' => false, 'message' => 'Cart item not found']);
            }
            $cart = $cartItem->cart;
            $cartItemTotal = $cartItem->price * $cartItem->quantity;
            $newSubTotal = $cart->sub_total - $cartItemTotal;
            $cart->sub_total = $newSubTotal;
            $cart->save();
            // Delete the cart item
            $cartItem->delete();
            $session_id = Cache::get('session_id', Session::getId());
            $cartProducts = Cart::with('cartProducts.product', 'offer')
                ->Where('session_id', $session_id)
                ->orwhere('user_id', Auth::id())
                ->get();
                
            $total = 0;
            $gst = 0;
            $offer = 0;

            $cartItemsHtml = view('front.common.cart.items', compact('cartProducts', 'total', 'gst'))->render();
            $orderSummaryHtml = view('front.common.cart.order-summary', compact('cartProducts', 'total', 'gst','offer'))->render();

             return response()->json(['success' => true, 'newQuantity' => $cartItem->quantity, 'cartItmes' => $cartItemsHtml, 'orderSummaryResponse' => $orderSummaryHtml, 'message' => 'Item deleted successfully']);

        }


    public function updateCartItemVisibility(Request $request){

        $cartItem = CartProduct::with('cart')->where('id', $request->cartItemId)->first();

        if (!$cartItem) {
            return response()->json(['success' => false, 'message' => 'Cart item not found']);
        }
        
        $cartItem->is_visible = $request->is_visible;
        $cart = $cartItem->cart;
        $cartItemTotal = $cartItem->price * $cartItem->quantity;
        $ProductAttribute = ProductAttribute::where('product_id', $cartItem->product_id)->first();
        if($request->is_visible) {
            if ($ProductAttribute->stock < $cartItem->quantity) {
                return response()->json(['success' => false, 'message' => 'You cant add these items to cart because product is out of stock!']);
            }
            $newSubTotal = $cart->sub_total + $cartItemTotal;
            $ProductNewStock = $ProductAttribute->stock - $cartItem->quantity;
        } else {
            $newSubTotal = $cart->sub_total - $cartItemTotal;
            $ProductNewStock = $ProductAttribute->stock + $cartItem->quantity;
        }
        $cart->sub_total = $newSubTotal;
        $cart->save();
        $cartItem->save();
        
        $ProductAttribute->stock = $ProductNewStock;
        // $ProductAttribute->save();
        
        $session_id = Cache::get('session_id', Session::getId());
            $cartProducts = Cart::with('cartProducts.product', 'offer')
                ->Where('session_id', $session_id)
                ->orwhere('user_id', Auth::id())
                ->get();
                
            $total = 0;
            $gst = 0;
            $offer = 0;

            $orderSummaryHtml = view('front.common.cart.order-summary', compact('cartProducts', 'total', 'gst', 'offer'))->render();

             return response()->json(['success' => true, 'newQuantity' => $cartItem->quantity, 'orderSummaryResponse' => $orderSummaryHtml, 'message' => 'Visibility updated successfully']);
    }

    public function updateCartItemQuantity(Request $request)
        {
            
            $request->validate([
                'action' => 'required|in:plus,minus',
            ]);
            $cartItem = CartProduct::find($request->cartItemId);
            $cart = Cart::find($request->cartId);

            if (!$cartItem || !$cart) {
                return response()->json(['success' => false, 'message' => 'Cart item not found']);
            }
            
            $ProductAttribute = ProductAttribute::where('product_id', $cartItem->product_id)->first();
            // Update the quantity based on the action
            if ($request->action === 'plus') {
                if ($ProductAttribute->stock == 0) {
                    return response()->json(['success' => false, 'message' => 'Product is out of stocks!']);
                }
                $cartItem->quantity++;
                $newSubTotal = $cart->sub_total + $cartItem->price;  
                $cart->update(['sub_total' => $newSubTotal]);
                $ProductNewStock = $ProductAttribute->stock - 1;
            } elseif ($request->action === 'minus') {
                if ($cartItem->quantity > 1) { // Prevent quantity going below 1
                    $cartItem->quantity--;
                    $newSubTotal = $cart->sub_total - $cartItem->price;  
                    $cart->update(['sub_total' => $newSubTotal]);
                    $ProductNewStock = $ProductAttribute->stock + 1;
                }
            }
            $ProductAttribute->stock = $ProductNewStock;
            // $ProductAttribute->save();
            $cartItem->save();

            $session_id = Cache::get('session_id', Session::getId());
            $cartProducts = Cart::with('cartProducts.product', 'offer')
                ->Where('session_id', $session_id)
                ->orwhere('user_id', Auth::id())
                ->get();
                
            $total = 0;
            $gst = 0;
            $offer = 0;

            $orderSummaryHtml = view('front.common.cart.order-summary', compact('cartProducts', 'total', 'gst', 'offer'))->render();
            // $orderSummaryHtml = '<h1> order summary</h1>';
            return response()->json(['success' => true, 'total' => $total,'newQuantity' => $cartItem->quantity, 'orderSummaryResponse' => $orderSummaryHtml,'message' => 'Quantity updated successfully']);
        }


        public function applyCoupon(Request $request)
        {
            // Validate input
            $request->validate([
                'cartId' => 'required|integer|exists:carts,id',
                'couponCode' => 'required|string'
            ]);

            $cart = Cart::find($request->cartId);
            $coupon = OfferAndDiscount::where('code', $request->couponCode)->first();
            
            if (!$cart || !$coupon) {
                return response()->json(['success' => false, 'message' => 'Invalid cart or coupon']);
            }
            
            
            // Apply discount based on coupon type
            if ($coupon) {
                if ($coupon->type === 'percentage') {
                    // Calculate the percentage amount
                    $couponAmount = ($cart->sub_total * $coupon->value) / 100; 
                    // $cart->sub_total -= $couponAmount; 
                    // $cart->discount_offer_amount = $couponAmount; 
                } else {
                    // Direct discount amount
                    $couponAmount = $coupon->value; 
                    // $cart->sub_total -= $coupon->value; 
                    // $cart->discount_offer_amount = $coupon->value;
                }
                if ($cart->sub_total < $couponAmount) {
                    return response()->json(['success' => false, 'message' => 'Coupon amount is greater than cart total.']);
                }
                $cart->sub_total -= $couponAmount; 
                $cart->discount_offer_amount = $couponAmount; 
                
                // Ensure sub_total does not go below zero
                $cart->sub_total = max($cart->sub_total, 0);
                
                // Save the discount offer ID
                $cart->discount_offer_id = $coupon->id; 
            } else { 
                return response()->json(['success' => false, 'message' => 'Coupon application failed']);
            }
            
            $cart->save();
            
            $session_id = Cache::get('session_id', Session::getId());
            $cartProducts = Cart::with('cartProducts.product', 'offer')
            ->Where('session_id', $session_id)
            ->orwhere('user_id', Auth::id())
            ->get();
            
            $total = 0;
            $gst = 0;
            $offer = 0;
            
            $couponHtml = view('front.common.offer-success', compact('couponAmount', 'coupon'))->render();          
            $orderSummaryHtml = view('front.common.cart.order-summary', compact('cartProducts', 'total', 'gst', 'offer'))->render();          
            return response()->json(['success' => true, 'cart' => $cartProducts ,'code' => $request->couponCode, 'total' => $total, 'orderSummaryResponse' => $orderSummaryHtml, 'couponHtml' => $couponHtml, 'message' => 'Coupon applied successfully']);
        }

    public function applyCouponCode(Request $request)
    {
        $couponCode = $request->input('couponCode');

        // Validate the coupon code
        if (!$couponCode) {
            return response()->json(['success' => false, 'message' => 'Coupon code is required.']);
        }
        $coupon = OfferAndDiscount::where('code', $couponCode)->first();
        if (!$coupon) {
            return response()->json(['success' => false, 'message' => 'Please enter valid coupon code.']);
        }

        return response()->json(['success' => true, 'message' => "Coupon '$couponCode' applied successfully!"]);
    }


    public function removeCoupon(Request $request)
    {
        $user = Auth::guard('customer')->user();
    
        // Validate the request to ensure cartId is provided
        $request->validate([
            'cartId' => 'required|integer|exists:carts,id',
        ]);
    
        // Find the cart
        $cart = Cart::find($request->cartId);
        $coupon = OfferAndDiscount::where('code', $request->couponCode)->first();
    
        if (!$cart) {
            return response()->json(['success' => false, 'message' => 'Invalid cart']);
        }
    
        if ($coupon) {
            // Restore the original subtotal based on the coupon type
            if ($coupon->type === 'percentage') {
                // Calculate the original subtotal before the coupon was applied
                $originalSubtotal = $cart->sub_total / (1 - ($coupon->value / 100));
            } else {
                // Restore the subtotal by adding back the discount value
                $originalSubtotal = $cart->sub_total + $coupon->value;
            }
    
            // Update the cart's subtotal
            $cart->sub_total = max($originalSubtotal, 0); // Prevent negative values
            $cart->discount_offer_id = null; // Clear the discount offer
            $cart->discount_offer_amount = 0; // Clear the discount offer amount
    
            $cart->save(); // Save the changes
        } else {
            return response()->json(['success' => false, 'message' => 'Coupon removal failed']);
        }
        
        $session_id = Cache::get('session_id', Session::getId());
        $cartProducts = Cart::with('cartProducts.product', 'offer')
            ->Where('session_id', $session_id)
            ->orwhere('user_id', Auth::id())
            ->get();
            
        $total = 0;
        $gst = 0;
        $offer = 0;

            $orderSummaryHtml = view('front.common.cart.order-summary', compact('cartProducts', 'total', 'gst', 'offer'))->render();              
        return response()->json(['success' => true, 'code' => $request->couponCode, 'total' => $total, 'orderSummaryResponse' => $orderSummaryHtml, 'message' => 'Coupon removed successfully']);
    }
    

    public function getCoupons()
    {
        $offers = OfferAndDiscount::inRandomOrder()->take(3)->get();
        return view('front.common.more-offer', compact('offers'))->render();
    }
}

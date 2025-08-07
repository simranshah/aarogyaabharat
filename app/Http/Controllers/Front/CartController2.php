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
use Illuminate\Support\Facades\DB;

class CartController2 extends Controller
{
    public function index()
    {

        $session_id = session()->get('cart_id');
        \Log::channel('cart_log')->info('Index method - Session ID:', ['session_id' => $session_id]);
        $customer = Auth::user();
        $cartProducts = Cart::with(['cartProducts.product.category', 'offer'])->where(function ($query) use ($customer, $session_id) {
            if ($customer) {
                $query->where('user_id', $customer->id);
            }
            $query->orWhere('session_id', $session_id);
        })->get();

        \Log::channel('cart_log')->info('Index method - $cartProducts:', ['$cartProducts' => $cartProducts]);
        if( Auth::check()){
        $customerDetail = User::with([
            'addresses'
        ])
        ->where('id', Auth::user()->id)
        ->first();
        }
        else{
            $customerDetail = null;
        }
        $offerOrDiscount = OfferAndDiscount::first();
        $customerAndAddresses = Auth::check() ? User::with(['addresses' => function ($query) {
            $query->where('is_delivery_address', true);
        }])->where('id', Auth::id())->first()->addresses
            : null;

        return view('front.cart-2', compact('cartProducts', 'customerAndAddresses', 'offerOrDiscount','customerDetail'));
    }



    public function addToCart(Request $request, $productId)
    {
        DB::beginTransaction();

        try {
            $product = Product::with('productAttributes')->where('id', $productId)->first();
            if (!$product || $product->productAttributes->stock < 1) {
                return response()->json(['success' => false, 'message' => 'Product is out of stock!']);
            }

            $customer = Auth::user();
            $session_id = session()->get('cart_id');

            // If no session ID exists, generate a new one
            if (!$session_id) {
                $session_id = uniqid('cart_', true);
                session()->put('cart_id', $session_id);
            }
            \Log::channel('cart_log')->info('addToCart method - Session ID:', ['session_id' => $session_id]);

            // Check if a cart exists for either the logged-in user OR the session ID
            $cart = Cart::where(function ($query) use ($customer, $session_id) {
                if ($customer) {
                    $query->where('user_id', $customer->id);
                }
                $query->orWhere('session_id', $session_id);
            })->first();

            \Log::channel('cart_log')->info('addToCart method - Cart Detail:',
            [
                '$product->our_price' => $product->our_price,
                'quantity' => $request->input('quantity', 1),
                'product->gst' => $product->gst,
            ]);

            if ($cart) {
                // $cart->quantity += $request->input('quantity', 1);
                // $cart->sub_total += ($product->our_price * $request->input('quantity', 1));
                // $cart->total_gst += ($product->our_price * $request->input('quantity', 1) * $product->gst) / 100;


                $cartProduct = CartProduct::where('cart_id', $cart->id)
                ->where('product_id', $product->id)
                ->first();

                if ($cartProduct) {
                    // Product exists, update quantity and subtotal
                    // $cartProduct->quantity += $request->input('quantity', 1);
                    // $cartProduct->total_price = $product->our_price * $cartProduct->quantity; // Update total price
                    $cartProduct->save();
                    DB::commit();
                   return response()->json(['success' => false, 'message' => 'Product already exists in cart']);

                    // Update the cart's subtotal as well
                    // $cart->sub_total += ($product->our_price * $request->input('quantity', 1));
                    // $cart->total_delivery_charges += ($$product->delivery_and_installation_fees);

                } else {
                    $cartProduct = new CartProduct([
                        'cart_id' => $cart->id,
                        'product_id' => $product->id,
                        'price' => $product->our_price,
                        'quantity' => $request->input('quantity', 1),
                        'total_price' => $product->our_price * $request->input('quantity', 1),
                    ]);
                    $cart->sub_total += ($product->our_price * $request->input('quantity', 1));
                    $cart->total_delivery_charges += ($product->delivery_and_installation_fees);
                    $cart->total_gst +=  ($product->our_price * $request->input('quantity', 1) * $product->gst) / 100;
                    $cartProduct->save();
                    $cart->save();
                    DB::commit();
                    return response()->json(['success' => true, 'message' => 'Item Added to Cart','cartproductcount' => $cart->cartProducts->count()]);
                }
            } else {
                $cart = new Cart([
                    'user_id' => Auth::id(),
                    'session_id' => $session_id,
                    'product_id' => $product->id,
                    'quantity' => $request->input('quantity', 1),
                    'price' => $product->our_price,
                    'sub_total' => ($product->our_price * $request->input('quantity', 1)),
                    'total_gst' => ($product->our_price * $request->input('quantity', 1) * $product->gst) / 100,
                    'total_delivery_charges'=>($product->delivery_and_installation_fees)

                ]);
                $cart->save();
                $cartProduct = new CartProduct([
                    'cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'price' => $product->our_price,
                    'quantity' => $request->input('quantity', 1),
                    'total_price' => $product->our_price * $request->input('quantity', 1),
                ]);
                $cartProduct->save();
                DB::commit();
                return response()->json(['success' => true, 'message' => 'Item Added to Cart','cartproductcount' => $cart->cartProducts->count()]);
            }

            $cart->save();
            // $ProductAttribute = ProductAttribute::where('product_id', $productId)->first();
            // $ProductNewStock = $ProductAttribute->stock - 1;
            // $ProductAttribute->stock = $ProductNewStock;
            // $ProductAttribute->save();
            // Notify customer (if logged in)

            // Commit transaction if everything is successful
            DB::commit();

            // Notify customer if logged in
            if ($customer) {
                $customer->notify(new UserNotification('Product added to cart', 'Your product has been added to cart. Check your cart now.'));
            }

            return redirect()->route('cart')->with('success', 'Product added to cart!');
        } catch (\Exception $e) {
            // Rollback transaction if anything fails
            DB::rollback();
            \Log::channel('cart_log')->error('addToCart method - Error:', ['Message' => $e->getMessage()]);

            return redirect()->back()->with('error', 'Something went wrong. Please try again!');
        }
    }


    public function updateCart(Request $request, $cartId)
    {
        $session_id = session()->get('cart_id');
        \Log::channel('cart_log')->info('updateCart method - Session ID:', ['session_id' => $session_id]);
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
        $cartItem = CartProduct::with('cart','product')->where('id', $cartItemId)->first();

        if (!$cartItem) {
            return response()->json(['success' => false, 'message' => 'Cart item not found']);
        }
        \Log::channel('cart_log')->info('cartItemId:', ['cartItemId' => $cartItemId]);
        $cart = $cartItem->cart;
        $cartItemTotal = $cartItem->price * $cartItem->quantity;
        $newSubTotal = $cart->sub_total - $cartItemTotal;
        
        // Handle GST and delivery charges based on item type
        if (isset($cartItem->is_rental) && $cartItem->is_rental) {
            // For rental items, use the stored GST and delivery fees
            $newGST = $cart->total_gst - $cartItem->gst_amount;
            $newDeliveryCharges = $cart->total_delivery_charges - $cartItem->delivery_fees;
        } else {
            // For buy items, calculate from product
            $product = Product::where('id', $cartItem->product_id)->first();
            $productGST = ($cartItemTotal * $product->gst) / 100;
            $newGST = $cart->total_gst - $productGST;
            $newDeliveryCharges = $cart->total_delivery_charges - $product->delivery_and_installation_fees;
        }
        
        $cart->total_gst = $newGST;
        $cart->total_delivery_charges = $newDeliveryCharges;
        
        \Log::channel('cart_log')->info('deleteItem method - Cart Detail:',
        [
            '$cartItemTotal' => $cartItemTotal,
            'is_rental' => isset($cartItem->is_rental) ? $cartItem->is_rental : false,
            'new gst' => $newGST,
            'new delivery charges' => $newDeliveryCharges,
        ]);
        
        $cart->sub_total = $newSubTotal + $cart->discount_offer_amount;
        if ($cart->discount_offer_amount >= $newSubTotal) {
            $cart->discount_offer_amount = 0;
            $cart->discount_offer_id = null;
        }
        $cart->save();
        // Delete the cart item
        $cartItem->delete();
        // Check if the cart has any remaining items
        $remainingItems = CartProduct::where('cart_id', $cart->id)->count();
        \Log::channel('cart_log')->info('remainingItems  after delete cart item:', ['item' => $remainingItems]);

        if ($remainingItems === 0) {
            $cart->delete();
            session()->forget('cart_id');
        }
        $session_id = session()->get('cart_id');
        $customer = Auth::user();
        $cartProducts = Cart::with(['cartProducts.product', 'offer'])->where(function ($query) use ($customer, $session_id) {
            if ($customer) {
                $query->where('user_id', $customer->id);
            }
            $query->orWhere('session_id', $session_id);
        })->get();

        $total = 0;
        $gst = 0;
        $offer = 0;

        $cartItemsHtml = view('front.common.cart.items', compact('cartProducts', 'total', 'gst'))->render();
        $orderSummaryHtml = view('front.common.cart.order-summary', compact('cartProducts', 'total', 'gst', 'offer'))->render();

        return response()->json(['success' => true, 'newQuantity' => $cartItem->quantity, 'cartItmes' => $cartItemsHtml, 'orderSummaryResponse' => $orderSummaryHtml, 'message' => 'Item deleted successfully']);
    }


    public function updateCartItemVisibility(Request $request)
    {

        $cartItem = CartProduct::with('cart')->where('id', $request->cartItemId)->first();

        if (!$cartItem) {
            return response()->json(['success' => false, 'message' => 'Cart item not found']);
        }

        $cartItem->is_visible = $request->is_visible;
        $cart = $cartItem->cart;
        $cartItemTotal = $cartItem->price * $cartItem->quantity;
        $ProductAttribute = ProductAttribute::where('product_id', $cartItem->product_id)->first();
        $coupon = OfferAndDiscount::where('id', $cart->discount_offer_id)->first();
        
        // Handle GST and delivery charges based on item type
        if (isset($cartItem->is_rental) && $cartItem->is_rental) {
            // For rental items, use the stored GST and delivery fees
            $productGST = $cartItem->gst_amount;
            $productdelivercharg = $cartItem->delivery_fees;
        } else {
            // For buy items, calculate from product
            $product = Product::where('id', $cartItem->product_id)->first();
            $productGST = ($cartItemTotal * $product->gst) / 100;
            $productdelivercharg = $product->delivery_and_installation_fees;
        }
        // \Log::channel('cart_log')->info('updateCartItemVisibility method - Cart Detail:',
        // [
        //     'cartItemTotal' => $cartItemTotal,
        //     'product gst' => $product->gst,
        //     'new gst' => $productGST,
        // ]);

        if ($request->is_visible) {
            if ($ProductAttribute->stock < $cartItem->quantity) {
                return response()->json(['success' => false, 'message' => 'You cant add these items to cart because product is out of stock!']);
            }
            $newSubTotal = $cart->sub_total + $cartItemTotal;
            $newTotalGST = $cart->total_gst + $productGST;
            $newdeliverchg=$cart->total_delivery_charges + $productdelivercharg;
            $ProductNewStock = $ProductAttribute->stock - $cartItem->quantity;
        } else {
            $newSubTotal = $cart->sub_total - $cartItemTotal;
            $newTotalGST = $cart->total_gst - $productGST;
            $newdeliverchg=$cart->total_delivery_charges - $productdelivercharg;
            $ProductNewStock = $ProductAttribute->stock + $cartItem->quantity;
        }
        if(isset($coupon) && !empty($coupon)) {
            if ($coupon->type === 'percentage') {
                // $couponAmount = ($newSubTotal * $coupon->value) / 100;
                if( $coupon->complete_off_on=='delivery'){
                $couponAmount = ($newdeliverchg * $coupon->value) / 100;
                }else if($coupon->complete_off_on=='gst'){
                $couponAmount = ($newTotalGST * $coupon->value) / 100;
                }else{
                $couponAmount = ( $newSubTotal * $coupon->value) / 100;
                }
                if($coupon->up_to_off>0){
                if($couponAmount > $coupon->up_to_off){
                    $couponAmount = $coupon->up_to_off;
                }
            }
            } else {
                $couponAmount = $coupon->value;
            }
            if ($cart->discount_offer_amount >= $newSubTotal) {
                $cart->discount_offer_amount = 0;
                $cart->discount_offer_id = null;
            } else {
                $cart->discount_offer_amount = $couponAmount;
                $cart->discount_offer_id = $coupon->id;
            }
        }
        $cart->total_delivery_charges = $newdeliverchg;
        $cart->sub_total = $newSubTotal;
        $cart->total_gst = $newTotalGST;
        $cart->save();
        $cartItem->save();

        $ProductAttribute->stock = $ProductNewStock;
        // $ProductAttribute->save();

        $session_id = session()->get('cart_id');
        $customer = Auth::user();
        $cartProducts = Cart::with(['cartProducts.product', 'offer'])->where(function ($query) use ($customer, $session_id) {
            if ($customer) {
                $query->where('user_id', $customer->id);
            }
            $query->orWhere('session_id', $session_id);
        })->get();

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

        // Handle GST and delivery charges based on item type
        if (isset($cartItem->is_rental) && $cartItem->is_rental) {
            // For rental items, use the stored GST and delivery fees
            $productGST = $cartItem->gst_amount;
            $productDel = $cartItem->delivery_fees;
        } else {
            // For buy items, calculate from product
            $product = Product::where('id', $cartItem->product_id)->first();
            $productGST = ($cartItem->price * $product->gst) / 100;
            $productDel = $product->delivery_and_installation_fees;
        }
        // $newGST = $cart->total_gst - $productGST;
        // $cart->total_gst = $newGST;
        \Log::channel('cart_log')->info('updateCartItemQuantity method - Cart Detail:',
        [
            'cartItem->price' => $cartItem->price,
            'product gst' => $productGST,
        ]);

        $ProductAttribute = ProductAttribute::where('product_id', $cartItem->product_id)->first();
        // Update the quantity based on the action
        if ($request->action === 'plus') {
            if ($ProductAttribute->stock == 0) {
                return response()->json(['success' => false, 'message' => 'Product is out of stocks!']);
            }
            $cartItem->quantity++;
            $newSubTotal = $cart->sub_total + $cartItem->price;
            $newTotalGST = $cart->total_gst + $productGST;
            $newTotalDel=$cart->total_delivery_charges+$productDel;
            $cart->update(['sub_total' => $newSubTotal, 'total_gst' => $newTotalGST,'total_delivery_charges'=> $newTotalDel]);
            $ProductNewStock = $ProductAttribute->stock - 1;
        } elseif ($request->action === 'minus') {
            if ($cartItem->quantity > 1) { // Prevent quantity going below 1
                $cartItem->quantity--;
                $newSubTotal = $cart->sub_total - $cartItem->price;
                $newTotalGST = $cart->total_gst - $productGST;
                 $newTotalDel=$cart->total_delivery_charges - $productDel;
            $cart->update(['sub_total' => $newSubTotal, 'total_gst' => $newTotalGST,'total_delivery_charges'=> $newTotalDel]);
                $ProductNewStock = $ProductAttribute->stock + 1;
            }
        }
        $ProductAttribute->stock = $ProductNewStock;
        // $ProductAttribute->save();
        $cartItem->save();

        $session_id = session()->get('cart_id');
        $customer = Auth::user();
        $cartProducts = Cart::with(['cartProducts.product', 'offer'])->where(function ($query) use ($customer, $session_id) {
            if ($customer) {
                $query->where('user_id', $customer->id);
            }
            $query->orWhere('session_id', $session_id);
        })->get();

        $total = 0;
        $gst = 0;
        $offer = 0;

        $orderSummaryHtml = view('front.common.cart.order-summary', compact('cartProducts', 'total', 'gst', 'offer'))->render();
        // $orderSummaryHtml = '<h1> order summary</h1>';
        return response()->json(['success' => true, 'total' => $total, 'newQuantity' => $cartItem->quantity, 'orderSummaryResponse' => $orderSummaryHtml, 'message' => 'Quantity updated successfully']);
    }


    public function applyCoupon(Request $request)
    {
        // Validate input
        // $request->validate([
        //     'cartId' => 'required|integer|exists:carts,id',
        //     'couponCode' => 'required|string'
        // ]);

        $cart = Cart::find($request->cartId);
        $coupon = OfferAndDiscount::where('code', $request->couponCode)
            ->where(function($query) {
            $query->whereNull('end_date')
                  ->orWhere('end_date', '>=', now());
            })
            ->first();

        if (!$cart) {
            return response()->json(['success' => false, 'message' => 'Invalid cart or Add products to cart']);
        }
        if (!empty($cart->discount_offer_amount) && !empty($cart->discount_offer_id)) {
            return response()->json(['success' => false, 'message' => 'Already offer/coupon applied, please remove it, try again']);
        }
       if ($coupon->usage_limit !== null && $coupon->usage_limit <= 0) {
         return response()->json(['success' => false, 'message' => 'Coupon usage limit exceeded']);
  }
        if (!$cart || !$coupon) {
            return response()->json(['success' => false, 'message' => 'Invalid coupon']);
        }


        // Apply discount based on coupon type
        if ($coupon) {
            if ($coupon->type === 'percentage') {
               if( $coupon->complete_off_on=='delivery'){
                $couponAmount = ($cart->total_delivery_charges * $coupon->value) / 100;
                }else if($coupon->complete_off_on=='gst'){
                $couponAmount = ($cart->total_gst * $coupon->value) / 100;
                }else{
                $couponAmount = ($cart->sub_total * $coupon->value) / 100;
                }
                if($coupon->up_to_off>0){
                if($couponAmount > $coupon->up_to_off){
                    $couponAmount = $coupon->up_to_off;
                }
            }
            } else {
                // Direct discount amount
                $couponAmount = $coupon->value;
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

        $session_id = session()->get('cart_id');
        $customer = Auth::user();
        $cartProducts = Cart::with(['cartProducts.product', 'offer'])->where(function ($query) use ($customer, $session_id) {
            if ($customer) {
                $query->where('user_id', $customer->id);
            }
            $query->orWhere('session_id', $session_id);
        })->get();

        $total = 0;
        $gst = 0;
        $offer = 0;

        $couponHtml = view('front.common.offer-success', compact('couponAmount', 'coupon'))->render();
        $orderSummaryHtml = view('front.common.cart.order-summary', compact('cartProducts', 'total', 'gst', 'offer'))->render();
        return response()->json(['success' => true, 'cart' => $cartProducts, 'code' => $request->couponCode, 'total' => $total, 'orderSummaryResponse' => $orderSummaryHtml, 'couponHtml' => $couponHtml, 'message' => 'Coupon applied successfully']);
    }

    public function applyCouponCode(Request $request)
    {
        $couponCode = $request->input('couponCode');


        // Validate the coupon code
        if (!$couponCode) {
            return response()->json(['success' => false, 'message' => 'Coupon code is required.']);
        }
        $coupon = OfferAndDiscount::where('code', $request->couponCode)
            ->where(function($query) {
            $query->whereNull('end_date')
                  ->orWhere('end_date', '>=', now());
            })
            ->first();

        $cart = Cart::find($request->cartId);
        if (!$cart) {
            return response()->json(['success' => false, 'message' => 'Invalid cart or Add products to cart']);
        }
        if (!empty($cart->discount_offer_amount) && !empty($cart->discount_offer_id)) {
            return response()->json(['success' => false, 'message' => 'Already offer/coupon applied, please remove it, try again']);
        }
        if ($coupon->usage_limit !== null && $coupon->usage_limit <= 0) {
         return response()->json(['success' => false, 'message' => 'Coupon usage limit exceeded']);
  }

        if (!$cart || !$coupon) {
            return response()->json(['success' => false, 'message' => 'Invalid coupon']);
        }


        // Apply discount based on coupon type
        if ($coupon) {
            if ($coupon->type === 'percentage') {
                if( $coupon->complete_off_on=='delivery'){
                $couponAmount = ($cart->total_delivery_charges * $coupon->value) / 100;
                }else if($coupon->complete_off_on=='gst'){
                $couponAmount = ($cart->total_gst * $coupon->value) / 100;
                }else{
                $couponAmount = ($cart->sub_total * $coupon->value) / 100;
                }
                if($coupon->up_to_off>0){
                if($couponAmount > $coupon->up_to_off){
                    $couponAmount = $coupon->up_to_off;
                }
            }
            } else {
                // Direct discount amount
                $couponAmount = $coupon->value;
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

        $session_id = session()->get('cart_id');
        $customer = Auth::user();
        $cartProducts = Cart::with(['cartProducts.product', 'offer'])->where(function ($query) use ($customer, $session_id) {
            if ($customer) {
                $query->where('user_id', $customer->id);
            }
            $query->orWhere('session_id', $session_id);
        })->get();

        $total = 0;
        $gst = 0;
        $offer = 0;

        $couponHtml = view('front.common.offer-success', compact('couponAmount', 'coupon'))->render();
        $orderSummaryHtml = view('front.common.cart.order-summary', compact('cartProducts', 'total', 'gst', 'offer'))->render();
        return response()->json(['success' => true, 'cart' => $cartProducts, 'code' => $request->couponCode, 'total' => $total, 'orderSummaryResponse' => $orderSummaryHtml, 'couponHtml' => $couponHtml, 'message' => 'Coupon applied successfully']);

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
       $coupon = OfferAndDiscount::where('code', $request->couponCode)
            ->where(function($query) {
            $query->whereNull('end_date')
                  ->orWhere('end_date', '>=', now());
            })
            ->first();

        if (!$cart) {
            return response()->json(['success' => false, 'message' => 'Invalid cart']);
        }

        if (!$coupon) {
            return response()->json(['success' => false, 'message' => 'Invalid Coupon or not found']);
        }

        if ($coupon) {
            // Restore the original subtotal based on the coupon type
            if ($coupon->type === 'percentage') {
                // Calculate the original subtotal before the coupon was applied
                $originalSubtotal = $cart->sub_total +$cart->discount_offer_amount;
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

        $session_id = session()->get('cart_id');
        $customer = Auth::user();
        $cartProducts = Cart::with(['cartProducts.product', 'offer'])->where(function ($query) use ($customer, $session_id) {
            if ($customer) {
                $query->where('user_id', $customer->id);
            }
            $query->orWhere('session_id', $session_id);
        })->get();

        $total = 0;
        $gst = 0;
        $offer = 0;

        $orderSummaryHtml = view('front.common.cart.order-summary', compact('cartProducts', 'total', 'gst', 'offer'))->render();
        return response()->json(['success' => true, 'code' => $request->couponCode, 'total' => $total, 'orderSummaryResponse' => $orderSummaryHtml, 'message' => 'Coupon removed successfully']);
    }

    public function getCoupons()
    {
        $session_id = session('cart_id');
        \Log::channel('cart_log')->info('Index method - Session ID:', ['session_id' => $session_id]);
        $customer = Auth::user();
        $cartProducts = Cart::with(['cartProducts.product', 'offer'])->where(function ($query) use ($customer, $session_id) {
            if ($customer) {
                $query->where('user_id', $customer->id);
            }
            $query->orWhere('session_id', $session_id);
        })->get();
        $offers = OfferAndDiscount::where('show_on_site', true)->get();
        return view('front.common.more-offer', compact('offers', 'cartProducts'))->render();
    }
    public function addRentalToCart(Request $request, $productId)
    {
        try {
            $product = Product::with('productAttributes')->where('id', $productId)->first();
            if($product->productAttributes->stock < 1){
                return response()->json(['success' => false, 'message' => 'Product is out of stock!']);
            }

            $customer = Auth::user();
            $session_id = session()->get('cart_id');

            if (!$session_id) {
                $session_id = uniqid('cart_', true);
                session()->put('cart_id', $session_id);
            }

            // Validate rental data
            $request->validate([
                'tenure' => 'required|string',
                'base_amount' => 'required|numeric',
                'gst_amount' => 'required|numeric',
                'delivery_fees' => 'required|numeric',
                'total_amount' => 'required|numeric',
            ]);

            // Calculate last rental date
            $lastRentalDate = now()->addMonths($request->tenure);

            // Check if a cart exists for this user/session
            $cart = Cart::where(function($query) use ($customer, $session_id) {
                if ($customer) {
                    $query->where('user_id', $customer->id);
                }
                $query->orWhere('session_id', $session_id);
            })->first();

            // Check if this rental product already exists in cart products
            $existingRentalProduct = CartProduct::where('cart_id', $cart ? $cart->id : 0)
                ->where('product_id', $productId)
                ->where('is_rental', true)
                ->first();

            if ($existingRentalProduct) {
                return response()->json([
                    'success' => false, 
                    'message' => 'This rental product is already in your cart!'
                ]);
            }

            if (!$cart) {
                // Create new cart
                $cart = new Cart([
                    'user_id' => $customer ? $customer->id : null,
                    'product_id' => $product->id,
                    'session_id' => $session_id,
                    'sub_total' => $request->total_amount,
                    'total_gst' => $request->gst_amount,
                    'price' => $request->base_amount,
                    'total_delivery_charges' => $request->delivery_fees,
                ]);
                $cart->save();
            } else {
                // Update existing cart totals
                $cart->sub_total += $request->total_amount;
                $cart->total_gst += $request->gst_amount;
                $cart->price += $request->base_amount;
                $cart->total_delivery_charges += $request->delivery_fees;
                $cart->save();
            }

            // Add rental product to cart products
            $cartProduct = new CartProduct([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'price' => $request->total_amount,
                'quantity' => 1,
                'total_price' => $request->total_amount,
                'is_rental' => true,
                'tenure' => $request->tenure,
                'base_amount' => $request->base_amount,
                'gst_amount' => $request->gst_amount,
                'delivery_fees' => $request->delivery_fees,
                'last_rental_date' => $lastRentalDate,
            ]);
            $cartProduct->save();

            return response()->json([
                'success' => true,
                'message' => 'Rental product added to cart successfully!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to add rental product to cart: ' . $e->getMessage()
            ]);
        }
    }

    public function updateRentalTenure(Request $request)
    {
        try {
            $request->validate([
                'cart_item_id' => 'required|exists:cart_products,id',
                'tenure' => 'required'
            ]);

            $cartItem = CartProduct::find($request->cart_item_id);
            
            if (!$cartItem || !$cartItem->is_rental) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid cart item or not a rental item'
                ]);
            }

            // Get the product to calculate new rental prices
            $product = Product::find($cartItem->product_id);
            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found'
                ]);
            }
        // Split tenure and percentage strings into arrays
$tenureOptions = explode('|', $product->rent_tenur); // ['3', '6', '9']
$percentageOptions = explode('|', $product->renting_presentag); // ['30', '48', '68']

// Find index of selected tenure
$selectedTenure = (int) $request->tenure;
$tenureIndex = array_search($selectedTenure, $tenureOptions);

if ($tenureIndex === false) {
    return response()->json(['error' => 'Invalid tenure selected'], 422);
}

// Get corresponding percentage
$percentage = (float) $percentageOptions[$tenureIndex]; // e.g., 48

// Calculate amounts
$baseAmount = ($product->our_price * $percentage) / 100;
$gstAmount = ($baseAmount * 0.18) ;
$deliveryFees = $product->delivery_and_installation_fees ?? 0;
$totalAmount = $baseAmount + $gstAmount + $deliveryFees;

// Round if needed
$totalAmount = round($totalAmount, 2);

// Return or use totalAmount

            // Update cart item
            $cartItem->update([
                'tenure' => $request->tenure,
                'base_amount' => $baseAmount,
                'gst_amount' => $gstAmount,
                'delivery_fees' => $deliveryFees,
                'price' => $totalAmount,
                'total_price' => $totalAmount,
                'last_rental_date' => now()->addMonths($request->tenure)
            ]);

            // Update cart totals
            $cart = $cartItem->cart;
            $this->recalculateCartTotals($cart);
           $cartItemsHtml=$this->refreshCartItems();
           $session_id = session()->get('cart_id');
        $customer = Auth::user();
        $cartProducts = Cart::with(['cartProducts.product.category', 'offer'])
            ->where(function ($query) use ($customer, $session_id) {
                if ($customer) {
                    $query->where('user_id', $customer->id);
                }
                $query->orWhere('session_id', $session_id);
            })->get();

        $orderSummaryHtml=view('front.common.cart.order-summary', compact('cartProducts'))->render();
            return response()->json([
                'success' => true,
                'new_price' => $totalAmount,
                'message' => 'Rental tenure updated successfully',
                'cartItemsHtml' => $cartItemsHtml,
                'orderSummaryHtml' => $orderSummaryHtml
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update rental tenure: ' . $e->getMessage()
            ]);
        }
    }

    public function refreshOrderSummary()
    {
        $session_id = session()->get('cart_id');
        $customer = Auth::user();
        $cartProducts = Cart::with(['cartProducts.product.category', 'offer'])
            ->where(function ($query) use ($customer, $session_id) {
                if ($customer) {
                    $query->where('user_id', $customer->id);
                }
                $query->orWhere('session_id', $session_id);
            })->get();

        return view('front.common.cart.order-summary', compact('cartProducts'));
    }

    private function recalculateCartTotals($cart)
    {
        $subTotal = 0;
        $totalGST = 0;
        $totalDelivery = 0;

        foreach ($cart->cartProducts as $cartItem) {
            if ($cartItem->is_visible) {
                if ($cartItem->is_rental) {
                    $subTotal += $cartItem->total_price;
                    $totalGST += $cartItem->gst_amount;
                    $totalDelivery += $cartItem->delivery_fees;
                } else {
                    $subTotal += $cartItem->total_price;
                    $product = Product::find($cartItem->product_id);
                    if ($product) {
                        $totalGST += ($cartItem->total_price * $product->gst) / 100;
                        $totalDelivery += $product->delivery_and_installation_fees;
                    }
                }
            }
        }

        $cart->update([
            'sub_total' => $subTotal,
            'total_gst' => $totalGST,
            'total_delivery_charges' => $totalDelivery
        ]);
    }
    public function refreshCartItems()
    {
        $session_id = session()->get('cart_id');
        $customer = Auth::user();
        $cartProducts = Cart::with(['cartProducts.product.category', 'offer'])
            ->where(function ($query) use ($customer, $session_id) {
                if ($customer) {
                    $query->where('user_id', $customer->id);
                }
                $query->orWhere('session_id', $session_id);
            })->get();
        return view('front.common.cart.items', compact('cartProducts'))->render();
    }
}

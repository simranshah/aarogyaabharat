<div class="orderSummery">
    <h4>Order Summary</h4>
    <ul>
        @php
        $total = 0;
        $delivery = 0;
        $gst = 0;
        // print_r($cartProducts[0]->cartProducts);
        // die;
    @endphp
        @if (isset($cartProducts) && !empty($cartProducts[0]) && !empty($cartProducts[0]->cartProducts))
        
            @foreach ($cartProducts[0]->cartProducts as $cartItem)
                @if (isset($cartItem->is_visible) && $cartItem->is_visible == 1)
                    <li id="product-detail-{{ $cartItem->product->id }}">
                        <p>{{ $cartItem->product->name }}</p>
                        <strong>₹  {{$cartItem->product->our_price * $cartItem->quantity}}</strong>
                        @php
                            $total += $cartItem->product->our_price * $cartItem->quantity;
                            $delivery += $cartItem->product->delivery_and_installation_fees;
                            $gst += ($cartItem->product->our_price * $cartItem->quantity * $cartItem->product->gst) / 100;
                        @endphp
                    </li>
                @endif
            @endforeach
            <li>
                <p>Total GST(18%)</p>
                <strong>₹ {{ $gst}}</strong>
            </li>
            <li >
                @php
                    $offer = $cartProducts[0]->discount_offer_amount ? $cartProducts[0]->discount_offer_amount : 0;
                @endphp
                <p>Offer Discount</p>
                <strong>₹ {{ $cartProducts[0]->discount_offer_amount }}</strong>
            </li>
            <li >
                <p>Delivery & Installation</p>
                <strong>₹ {{ $delivery}}</strong>
            </li>
            <li class="payable">
                <p>Total Payable</p>
                <strong> <span id="total-display" style="font-weight: bold;">₹  {{round($total - $offer + $gst + $delivery,2)}} </span></strong>
                <input type="hidden" id="total-hidden" value="{{ $total }}">
            </li>
        @endif
    </ul>
    
</div>

    <div class="term-cons-cart" style="font-size: 12px"> 
        <span >By placing your order, you agree to our <a href="{{url('/terms-and-conditions')}}">Terms and Conditions</a>.</span>
        </div>

<script>
    $(document).ready(function() {
        document.getElementById('buyAmount').innerHTML = " ₹ " + (parseFloat(document.getElementById('total-hidden').value) - parseFloat({{ $offer }}) + parseFloat({{ $gst }}) + parseFloat({{ $delivery }})).toFixed(2);
        document.getElementById('total-display').innerHTML = " ₹ " + (parseFloat(document.getElementById('total-hidden').value) - parseFloat({{ $offer }}) + parseFloat({{ $gst }}) + parseFloat({{ $delivery }})).toFixed(2);
        // console.log(document.getElementById('total-display').innerHTML);
    });
</script>

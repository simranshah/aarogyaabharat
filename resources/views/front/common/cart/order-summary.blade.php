@php
$buyTotal = 0;
$rentalTotal = 0;
$buyGST = 0;
$rentalGST = 0;
$buyDelivery = 0;
$rentalDelivery = 0;
$buyDeposit = 0;
$rentalDeposit = 0;

// Separate calculations for buy and rental items
if (isset($cartProducts) && !empty($cartProducts[0]) && !empty($cartProducts[0]->cartProducts)) {
    foreach ($cartProducts[0]->cartProducts as $cartItem) {
        if (isset($cartItem->is_visible) && $cartItem->is_visible == 1) {
            if (isset($cartItem->is_rental) && $cartItem->is_rental == 1) {
                // Rental item calculations
                $rentalTotal += ($cartItem->base_amount * $cartItem->quantity)/$cartItem->tenure;
                $rentalGST += (((($cartItem->base_amount * $cartItem->quantity)/$cartItem->tenure) * $cartItem->product->gst) / 100); // 18% GST
                $rentalDelivery += $cartItem->product->delivery_and_installation_fees;
                $rentalDeposit += ($cartItem->product->our_price * 0.25) * $cartItem->quantity; // 25% deposit
            } else {
                // Buy item calculations
                $buyTotal += $cartItem->product->our_price * $cartItem->quantity;
                $buyGST += ($cartItem->product->our_price * $cartItem->quantity * $cartItem->product->gst) / 100;
                $buyDelivery += $cartItem->product->delivery_and_installation_fees;
            }
        }
    }
}

$totalGST = $buyGST + $rentalGST;
$totalDelivery = $buyDelivery + $rentalDelivery;
$totalDeposit = $rentalDeposit;
$finalTotal = $buyTotal + $rentalTotal + $totalGST + $totalDelivery + $totalDeposit - $cartProducts[0]->discount_offer_amount;
@endphp
<div class="orderSummery cost-breakup-card">
    <div class="cost-breakup-header">
        <div class="header-content">
            <h4 class="cost-breakup-title">Order Summary</h4>
            @if($rentalTotal!=0)
            <div class="breakup-subtitle">Showing Rent Breakup ({{ $cartProducts[0]->cartProducts->where('is_visible', 1)->where('is_rental', 1)->count() }} Items)</div>
            @else
            <div class="breakup-subtitle">Showing Rent Breakup ({{ $cartProducts[0]->cartProducts->where('is_visible', 1)->count() }} Items)</div>
            @endif
        </div>

        <div class="rent-buy-toggle">
            @if($rentalTotal > 0)
                <button class="toggle-btn active" data-type="rent">Rent</button>
            @endif
            @if($buyTotal > 0)
                <button class="toggle-btn {{ $rentalTotal == 0 ? 'active' : '' }}" data-type="buy">Buy</button>
            @endif
        </div>
        
    </div>
    
    <div class="cost-breakup-content">
        <ul class="breakup-list">
    
        
        {{-- Rent View Items --}}
        @if($totalDeposit > 0 || $rentalTotal > 0)
        <div class="rent-view">
            {{-- Refundable Deposit --}}
            
            
            {{-- Monthly Rental Amount --}}
            @if($rentalTotal > 0)
            <li class="breakup-item">
                <div class="item-label">Rental (+)</div>
                <div class="item-amount">₹ {{ number_format($rentalTotal, 2) }}/mo</div>
            </li>
            @endif
            
            {{-- Monthly GST --}}
            @if($rentalGST > 0)
            <li class="breakup-item">
                <div class="item-label">Total GST (+)</div>
                <div class="item-amount">₹ {{ number_format($rentalGST, 2) }}/mo</div>
            </li>
            @endif
            
            {{-- Total Monthly Rental --}}
            @if($rentalTotal > 0)
            <li class="breakup-item total-monthly">
                <div class="item-label">Total Monthly Rental</div>
                <div class="item-amount">₹ {{ number_format($rentalTotal + $rentalGST, 2) }}/mo</div>
            </li>
            @endif
            @if($totalDeposit > 0)
            <li class="breakup-item">
                <div class="item-label">Refundable Deposit ({{ $cartProducts[0]->cartProducts->where('is_visible', 1)->where('is_rental', 1)->count() }} Items) - Payable Now</div>
                <div class="item-amount">₹ {{ number_format($totalDeposit, 2) }}</div>
            </li>
            @endif
        </div>
        @endif

        {{-- Buy View Items --}}
       
        @if($buyTotal > 0)
        <div class="buy-view" style="display:  {{ $rentalTotal == 0 ? 'block' : 'none' }}">
            {{-- Buy Items Subtotal --}}
            @if($buyTotal > 0)
            <li class="breakup-item">
                <div class="item-label">Buy Items Subtotal</div>
                <div class="item-amount">₹ {{ number_format($buyTotal, 2) }}</div>
            </li>
            @endif
            
            {{-- Buy GST --}}
            @if($buyGST > 0)
            <li class="breakup-item">
                <div class="item-label">Total GST (18%)</div>
                <div class="item-amount">₹ {{ number_format($buyGST, 2) }}</div>
            </li>
            @endif
        </div>
        @endif
        
        {{-- Offer Discount --}}
      
        
        {{-- Rent View Delivery and Total --}}
        @if($totalDeposit > 0 || $rentalTotal > 0)
        <div class="rent-view">
            {{-- Delivery and Convenience --}}
            @if($rentalDelivery > 0)
            <li class="breakup-item delivery-item">
                <div class="item-label">Delivery and Convenience</div>
                <div class="item-amount">₹ {{ number_format($rentalDelivery, 2) }}</div>
            </li>
            @endif
            
            {{-- Rent Cart Total --}}
            {{-- @if($totalDeposit > 0)
            <li class="breakup-item rent-cart-total">
                <div class="item-label">Rent Cart Total (Deposit)</div>
                <div class="item-amount">₹{{ number_format($totalDeposit, 2) }}</div>
            </li>
            @endif --}}
            @if($totalDeposit > 0)
            <li class="breakup-item rent-cart-total">
                <div class="item-label">Rent Cart Total</div>
                <div class="item-amount">₹ {{ number_format($rentalTotal + $rentalGST + $rentalDelivery + $totalDeposit, 2) }}</div>
            </li>
            @endif
            
        </div>
        @endif

        {{-- Buy View Delivery and Total --}}
        @if($buyTotal > 0)
        <div class="buy-view" style="display:  {{ $rentalTotal == 0 ? 'block' : 'none' }}">
            {{-- Delivery and Convenience for Buy --}}
            @if($buyDelivery > 0)
            <li class="breakup-item delivery-item">
                <div class="item-label">Delivery and Convenience</div>
                <div class="item-amount">₹ {{ number_format($buyDelivery, 2) }}</div>
            </li>
            @endif
            
            {{-- Buy Cart Total --}}
            @if($buyTotal > 0)
            <li class="breakup-item buy-cart-total">
                <div class="item-label">Buy Cart Total</div>
                <div class="item-amount">₹ {{ number_format($buyTotal + $buyGST + $buyDelivery, 2) }}</div>
            </li>
            @endif
        </div>
        @endif

        {{-- Offer Discount --}}
        @if($cartProducts[0]->discount_offer_amount > 0)
        <li class="breakup-item rent-cart-total">
            <div class="item-label">Offer Discount</div>
            <div class="item-amount" style="color: #03a685;">-₹ {{ number_format($cartProducts[0]->discount_offer_amount, 2) }}</div>
        </li>
        @endif
    </ul>
    
    <div class="breakup-divider"></div>
    
    {{-- Total Payable --}}
    @if($finalTotal > 0)
    <div class="total-payable">
        <div class="total-label">Total Payable Now</div>
        <div class="total-amount" id="total-display">₹{{ number_format($finalTotal, 2) }}</div>
        {{-- <div class="total-note rent-note">Inclusive of both buy and security deposit</div> --}}
        {{-- <div class="total-note buy-note" style="display: none;">Inclusive of buy items and delivery</div> --}}
        <button class="pay-btn" id="checkoutAllButton" data-cartid="{{ $cartProducts[0]->id }}" onclick="checkoutAllItems()">Proceed to pay</button>
    </div>
    @endif
    
    <input type="hidden" id="total-hidden" value="{{ $finalTotal }}">
    <input type="hidden" id="buy-total" value="{{ $buyTotal }}">
    <input type="hidden" id="rental-total" value="{{ $rentalTotal }}">
    <input type="hidden" id="total-gst" value="{{ $totalGST }}">
    <input type="hidden" id="total-delivery" value="{{ $totalDelivery }}">
    <input type="hidden" id="total-deposit" value="{{ $totalDeposit }}">
</div>
</div>

    <div class="term-cons-cart" style="font-size: 12px"> 
        <span >By placing your order, you agree to our <a href="{{url('/terms-and-conditions')}}">Terms and Conditions</a>.</span>
        </div>

<script>
    $(document).ready(function() {
        updateCheckoutAllAmount();
    });
</script>
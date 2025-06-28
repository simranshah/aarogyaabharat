@if(isset($offers) && count($offers) > 0)
    @foreach($offers as $offer)
      <div class="promo-card">
                <div class="header">
                    <div class="left-section">
                        <div class="radio-circle"> <img src="{{ asset('front/images/discount-icon.png') }}" alt="Discount Icon" style="width: 100%;height:100%"></div>
                        <div class="discount-text">{{ $offer->code }}</div>
                    </div>
                    <div class="right-section">
                        <div class="terms">T&c Apply*</div>
                         @if(!empty($cartProducts) && !empty($cartProducts[0]) && $cartProducts[0]->discount_offer_id != $offer->id)
                        <button data-cart-id="{{ !empty($cartProducts) && !empty($cartProducts[0]) ?  $cartProducts[0]->id : 0 }}" data-coupon-code="{{ $offer->code }}" id="apply-{{ $offer->code }}" onclick="applyOffer(this)"  class="apply-btn-card">Apply Now</button>
                        @else
                          <button data-cart-id="{{ !empty($cartProducts) && !empty($cartProducts[0]) ?  $cartProducts[0]->id : 0 }}" data-coupon-code="{{ $offer->code }}" id="remove-{{ $offer->code }}" onclick="removeOffer(this)" class="remove-btn-card">Remove</button>
                        @endif
                    </div>
                </div>


                <div class="offer-section">
                    <div class="offer-title">{{ $offer->title }}</div>
                    <div class="offer-description">
                        {{ $offer->description }}      </div>
                </div>
            </div>
    @endforeach
@else
    <p>No offers available.</p>
@endif

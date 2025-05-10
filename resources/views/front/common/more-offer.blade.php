@if(isset($offers) && count($offers) > 0)
    @foreach($offers as $offer)
        <div class="flatOffer">
            <img src="{{ asset('front/images/flat_offer.svg') }}" alt="flat_offer" />
            <div class="flatCon">
                <strong>{{ $offer->title }}</strong>
                <p>{{ $offer->description }}</p>
            </div>
            <div class="linkPart" id="linkPart-{{ $offer->code }}">
                <span>*T&C apply</span>
                @if(!empty($cartProducts) && !empty($cartProducts[0]) && $cartProducts[0]->discount_offer_id != $offer->id)
                    <a href="javascript:void(0)" data-cart-id="{{ !empty($cartProducts) && !empty($cartProducts[0]) ?  $cartProducts[0]->id : 0 }}" data-coupon-code="{{ $offer->code }}" id="apply-{{ $offer->code }}" onclick="applyOffer(this)">Apply Now</a>
                @endif
            </div>
            @if(!empty($cartProducts) && !empty($cartProducts[0]) && $cartProducts[0]->discount_offer_id == $offer->id)
            <div class="removeDiscount"   id="removeDiscount-{{ $offer->code }}" style="display:block;">
                <a href="javascript:void(0)" data-cart-id="{{ !empty($cartProducts) && !empty($cartProducts[0]) ?  $cartProducts[0]->id : 0 }}" data-coupon-code="{{ $offer->code }}" id="remove-{{ $offer->code }}" onclick="removeOffer(this)">Remove</a>
            </div>
            @else
            <div class="removeDiscount"   id="removeDiscount-{{ $offer->code }}" style="display:none;">
                <a href="javascript:void(0)" data-cart-id="{{ !empty($cartProducts) && !empty($cartProducts[0]) ?  $cartProducts[0]->id : 0 }}" data-coupon-code="{{ $offer->code }}" id="remove-{{ $offer->code }}" onclick="removeOffer(this)">Remove</a>
            </div>
            @endif
        </div>
    @endforeach
@else
    <p>No offers available.</p>
@endif

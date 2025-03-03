<div class="flatDicountPop winScrollStop">
    <div class="flatDicountPopInner">
        <a onClick="closeOfferSuccessPopup()"><img src="{{ asset('front/images/cross.svg')}}" alt="" /> </a>
        <img src="{{ asset('front/images/Offer-applied-sucessfully.svg') }}" alt="Offer-applied-sucessfully" />
        <span class="flatLine1"><strong>@if(isset($coupon))“{{ $coupon->title }}“ @endif</strong> Applied Successfully !</span>
        <span class="flatLine2">You Save <strong>₹ {{$couponAmount ?? 0}}</strong> from this order</span>
        <p>@if(isset($coupon)) {{$coupon ? $coupon->description : ''}}. @endif</p>
    </div>
</div>
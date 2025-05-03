<div class="">
                    <div class="title1">
                        <strong>Delivery Address</strong>
                        <a href="#;"><img src="{{asset('front/images/edit_pen.svg')}}" alt="" /> </a>
                    </div>
                    <div class="deliveryAddressInner">
                        @if(isset($customerAndAddresses) && !empty($customerAndAddresses))
                        <label class="deliveryAddress1">
                            <input type="radio" name="addressRadio" checked />
                            <span></span>
                            <div>
                                <strong> {{ $customerAndAddresses[0]->full_name }}Hardick Vermani</strong>
                                <p>B2-105, Waterbay Society, Opp. police station, Wadgaonsheri, Pune - 411036, Maharashtra</p>
                            </div>
                        </label>
                        @endif
                        <div class="addDelAddress1">
                            <a href="#;">Add New Address <img src="{{asset('front/images/jam_plus.svg')}}" alt="" /> </a>
                        </div>
                    </div>
                </div>
<!-- <div class="deliveryAddress">
    <div class="title1">
        <strong>Delivery Address</strong>
        <a href="#;"><img src="images/edit_pen.svg" alt="" /></a>
    </div>
    @if ($customerAndAddresses->isNotEmpty())
        @foreach ($customerAndAddresses as $address)
            <div class="deliveryAddressInner">
                <label class="deliveryAddress1">
                    <input type="radio" name="addressRadio" {{ $address->is_delivery_address ? 'checked' : '' }} />
                    <span></span>
                    <div>
                        <strong>{{ $address->full_name }}</strong>
                        <p>{{ $address->house_number }}, {{ $address->society }}, {{ $address->locality }}, {{ $address->landmark }}, {{ $address->pincode }}, {{ $address->city }}</p>
                    </div>
                </label>
            </div>
        @endforeach
    @else
        <div class="deliveryAddressInner">
            <p>No addresses available. <a href="#;">Add New Address</a></p>
        </div>
    @endif
    <div class="addDelAddress1">
        <a href="#;">Add New Address <img src="{{ asset('front/images/jam_plus.svg') }}" alt="" /></a>
    </div>
</div> -->


@php
    $isMobile = request()->header('User-Agent') && preg_match('/mobile|android|iphone|ipad|phone/i', request()->header('User-Agent'));
@endphp
@if($customerAndAddresses && $customerAndAddresses->isNotEmpty())
                        <div class="deliveryAddress123">
                            {{-- <div class="title1">
                                <strong>Delivery Address</strong>
                                <a href="javascript:void(0)" onclick="editDeliveryAddress({{$customerAndAddresses[0]->id}})"><img src="{{asset('front/images/edit_pen.svg')}}" alt="" /></a>
                            </div> --}}
                            @foreach($customerAndAddresses as $address)
                            @php 
                            $fullAddress = 
                                ($address->house_number ? $address->house_number . ', ' : '') .
                                ($address->society_name ? $address->society_name . ', ' : '') .
                                ($address->locality ? $address->locality . ', ' : '') .
                                ($address->landmark ? $address->landmark . ', ' : '') .
                                ($address->pincode ? $address->pincode . ', ' : '') .
                                ($address->city ? $address->city . ', ' : '') .
                                ($address->state ? $address->state : '');

                                  // Optionally remove trailing comma and space
                                 $fullAddress = rtrim($fullAddress, ', ');                                
                            @endphp
                       
                                <div class="delivery-box">
                                    <div class="delivery-left">
                                        <img src="/front/images/pin.svg" alt="Location Icon">
                                      <div class="delivery-text">
                                        <small>Deliver to:</small><br>
                                        <span class="delivery-address"> @if($isMobile)
                                            {{ Str::limit($fullAddress, 25)}}
                                        @else
                                        {{ Str::limit($fullAddress,62)}}
                                    @endif
                                    </span>
                                      </div>
                                    </div>
                                    <div class="change-btn" onclick="editDeliveryAddress({{$customerAndAddresses[0]->id}})">Change</div>
                                  </div>
                            @endforeach
                            {{-- <div class="addDelAddress1">
                                <a href="javascript:void(0)" onclick="addNewDeliveryAddress()">Add New Address <img src="{{asset('front/images/jam_plus.svg')}}" alt="" /></a>
                            </div> --}}
                        </div>
                    @else
                        <div class="addAddress" onclick="addNewDeliveryAddress1();">
                            <div class="addressNote">
                                <img src="{{asset('front/images/info-circle.svg')}}" alt="" />
                                <p>Please add your delivery address</p>
                            </div>
                            <div class="addressNoteError">
                                <img src="{{asset('front/images/alert_svgrepo.svg')}}" alt="" />
                                <p>Please add your delivery address</p>
                            </div>
                            <button>Add Delivery Address <img src="{{asset('front/images/jam_plus.svg')}}" alt="" /></button>
                        </div>
                    @endif
                    <script>
                
                    </script>
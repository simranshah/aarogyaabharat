@php
$isMobile =
    request()->header('User-Agent') &&
    preg_match('/mobile|android|iphone|ipad|phone/i', request()->header('User-Agent'));

// Separate rent and buy items
$rentalItems = [];
$buyItems = [];

if(isset($cartProducts) && !empty($cartProducts[0]) && !empty($cartProducts[0]->cartProducts)) {
    foreach ($cartProducts[0]->cartProducts as $cartItem) {
        if (isset($cartItem->is_rental) && $cartItem->is_rental == 1) {
            $rentalItems[] = $cartItem;
        } else {
            $buyItems[] = $cartItem;
        }
    }
}
@endphp

{{-- Rental Items Section --}}
@if(!empty($rentalItems))
<div class="rental-section" >
    <h3 style="color: #333; padding: 10px;margin-bottom: 15px;">
        <img src="{{ asset('front/images/rent_icon.svg') }}" alt="Rent" style="width: 50px; height: 50px; margin-right: 8px; vertical-align: middle;" />Rental Items
    </h3>
    @foreach($rentalItems as $cartItem)
        <div class="cartProductblock1">
            <div class="iconPart">
                <label>
                    <input type="checkbox" class="product-checkbox" id="checkbox-{{ $cartItem->id }}"
                        onChange="cartItemChange(event, '{{ $cartItem->id }}', {{ $cartProducts[0] }})"
                        {{ $cartItem->is_visible ? 'checked' : ' ' }} />
                    <i></i>
                </label>
                <a href="javascript:void(0);" onclick="deleteCartItem('{{ $cartItem->id }}')">
                    <img src="{{ asset('front/images/delete_icon.svg') }}" alt="Delete" />
                </a>
                <a href="#;"><img src="{{ asset('front/images/Share.svg') }}" alt="Share" /></a>
            </div>
            <div class="prodImg">
                <a href="{{ route('products.sub.category.wise', ['slug' => $cartItem->product->category->slug,'subSlug'=>$cartItem->product->slug]) }}">
                <img src="{{ asset('storage/' . $cartItem->product->image) }}" alt="{{ $cartItem->product->name }}" />
                </a>
            </div>
            <div class="content">
                <p><a href="{{ route('products.sub.category.wise', ['slug' => $cartItem->product->category->slug,'subSlug'=>$cartItem->product->slug]) }}">
                    @if($isMobile)
                    {{ Str::limit($cartItem->product->name, 22) }}
                    @else
                    {{ $cartItem->product->name }}
                    @endif
                </a></p>
                <div style=" align-items: center; justify-content: space-between;">
                <strong>₹ {{round(($cartItem->base_amount * $cartItem->quantity)/$cartItem->tenure,2)}}/mo</strong>
                @if(isset($cartItem->tenure))
                    <div class="tenure-selector">
                        <label>Change Tenure:</label>
                        <div class="flex-container">
                            <select class="tenure-select" data-cart-item-id="{{ $cartItem->id }}">
                                @if($cartItem->product->rent_tenur)
                                    @php
                                        $tenures = explode('|', $cartItem->product->rent_tenur);
                                    @endphp
                                    @foreach($tenures as $tenure)
                                        <option value="{{ trim($tenure) }}" {{ $cartItem->tenure == trim($tenure) ? 'selected' : '' }}>{{ trim($tenure) }} Months</option>
                                    @endforeach
                                @else     
                                <option value="1" {{ $cartItem->tenure == 1 ? 'selected' : '' }}>1 Month</option>
                                <option value="3" {{ $cartItem->tenure == 3 ? 'selected' : '' }}>3 Months</option>
                                <option value="6" {{ $cartItem->tenure == 6 ? 'selected' : '' }}>6 Months</option>
                                <option value="9" {{ $cartItem->tenure == 9 ? 'selected' : '' }}>9 Months</option>
                                <option value="12" {{ $cartItem->tenure == 12 ? 'selected' : '' }}>12 Months</option>
                                @endif
                            </select>
                            {{-- <button class="update-tenure-btn" data-cart-item-id="{{ $cartItem->id }}">Update</button> --}}
                        </div>
                    </div>
                @endif
                </div>
                <div class="errormsg" style="color: red; font-size: 12px;" id="msg-for-otp-send{{ $loop->index }}"></div>
                {{-- <div class="countProduct">
                    <a href="javascript:void(0);" class="countMinus" data-id="{{ $cartItem->id }}" data-sign="minus"
                        onclick="deleteCartItem('{{ $cartItem->id }}')">
                        <img src="{{ asset('front/images/jam_minus.svg') }}" alt="Minus" />
                    </a>
                    <span id="quantity-{{ $cartItem->id }}">{{ $cartItem->quantity }}</span>
                    <a href="javascript:void(0);" class="countPlus" data-id="{{ $cartItem->id }}" data-sign="plus"
                        onclick="document.getElementById('msg-for-otp-send{{ $loop->index }}').innerHTML='You cannot order more than 1 item(s) for this product.'; setTimeout(function(){ document.getElementById('msg-for-otp-send{{ $loop->index }}').innerHTML=''; }, 10000);">
                        <img src="{{ asset('front/images/jam_plus.svg') }}" alt="Plus" />
                    </a>
                </div> --}}
            </div>
        </div>
    @endforeach
</div>
@endif
{{-- Buy Items Section --}}
@if(!empty($buyItems))
<div class="buy-section" style="margin-top: 20px; ">
    <h3 style="color: #333; margin-bottom: 15px; padding: 10px; ">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-right: 8px; vertical-align: middle;">
            <path d="M9 22C9.55228 22 10 21.5523 10 21C10 20.4477 9.55228 20 9 20C8.44772 20 8 20.4477 8 21C8 21.5523 8.44772 22 9 22Z" stroke="#333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M20 22C20.5523 22 21 21.5523 21 21C21 20.4477 20.5523 20 20 20C19.4477 20 19 20.4477 19 21C19 21.5523 19.4477 22 20 22Z" stroke="#333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M1 1H5L7.68 14.39C7.77144 14.8504 8.02191 15.264 8.38755 15.5583C8.75318 15.8526 9.2107 16.009 9.68 16H19.4C19.8693 16.009 20.3268 15.8526 20.6925 15.5583C21.0581 15.264 21.3086 14.8504 21.4 14.39L23 6H6" stroke="#333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>Buy Items
    </h3>
    @foreach($buyItems as $cartItem)
        <div class="cartProductblock1" >
            <div class="iconPart">
                <label>
                    <input type="checkbox" class="product-checkbox" id="checkbox-{{ $cartItem->id }}"
                        onChange="cartItemChange(event, '{{ $cartItem->id }}', {{ $cartProducts[0] }})"
                        {{ $cartItem->is_visible ? 'checked' : ' ' }} />
                    <i></i>
                </label>
                <a href="javascript:void(0);" onclick="deleteCartItem('{{ $cartItem->id }}')">
                    <img src="{{ asset('front/images/delete_icon.svg') }}" alt="Delete" />
                </a>
                <a href="#;"><img src="{{ asset('front/images/Share.svg') }}" alt="Share" /></a>
            </div>
            <div class="prodImg">
                <a href="{{ route('products.sub.category.wise', ['slug' => $cartItem->product->category->slug,'subSlug'=>$cartItem->product->slug]) }}">
                <img src="{{ asset('storage/' . $cartItem->product->image) }}" alt="{{ $cartItem->product->name }}" />
                </a>
            </div>
            <div class="content">
                <p><a href="{{ route('products.sub.category.wise', ['slug' => $cartItem->product->category->slug,'subSlug'=>$cartItem->product->slug]) }}">
                    @if($isMobile)
                    {{ Str::limit($cartItem->product->name, 22) }}
                    @else
                    {{ $cartItem->product->name }}
                    @endif
                </a></p>
                <strong>₹ {{$cartItem->price}}</strong>
                <div class="errormsg" style="color: red; font-size: 12px;" id="msg-for-otp-send{{ $loop->index }}"></div>
                <div class="countProduct">
                    <a href="javascript:void(0);" class="countMinus" data-id="{{ $cartItem->id }}" data-sign="minus"
                        onclick="deleteCartItem('{{ $cartItem->id }}')">
                        <img src="{{ asset('front/images/jam_minus.svg') }}" alt="Minus" />
                    </a>
                    <span id="quantity-{{ $cartItem->id }}">{{ $cartItem->quantity }}</span>
                    <a href="javascript:void(0);" class="countPlus" data-id="{{ $cartItem->id }}" data-sign="plus"
                        onclick="document.getElementById('msg-for-otp-send{{ $loop->index }}').innerHTML='You cannot order more than 1 item(s) for this product.'; setTimeout(function(){ document.getElementById('msg-for-otp-send{{ $loop->index }}').innerHTML=''; }, 10000);">
                        <img src="{{ asset('front/images/jam_plus.svg') }}" alt="Plus" />
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endif

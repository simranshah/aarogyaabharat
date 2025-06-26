@extends('front.layouts.layout')
@section('content')
    {{-- @include('front.common.welcome-message') --}}
    <div class="breadcrumbs">
        <div class="container">
            <ul>
                <li><a href="{{ route('home') }}">Home</a> </li>
                <li><a href="{{ route('cart') }}">Cart</a> </li>
            </ul>
        </div>
    </div>

    <section class="cartSec">
        <div class="container">
            {{-- @if (session('success'))
                <script>
                    toastr.success('{{ session('success') }}');
                </script>
            @endif

            @if (session('error'))
                <script>
                    toastr.error('{{ session('error') }}');
                </script>
            @endif --}}
            @php
                $customer = Auth::user();
                $session_id = session()->get('cart_id');

                // Only count cart items if a session ID or user exists
                if ($customer || $session_id) {
                    $cartProductCount1 = App\Models\Front\Cart::where(function ($query) use ($customer, $session_id) {
                        if ($customer) {
                            $query->where('user_id', $customer->id);
                        }
                        if ($session_id) {
                            // Only check session_id if it's not null
            $query->orWhere('session_id', $session_id);
        }
    })
        ->withCount('cartProducts')
        ->get()
        ->sum('cart_products_count');
} else {
    $cartProductCount1 = 0; // No cart items if no session or user
}

\Log::channel('cart_log')->info('Header - Session ID:', [
    'session_id' => $session_id,
    'cartProductCount1' => $cartProductCount1,
                ]);
            @endphp
            @if ($cartProductCount1 == 0)
                <div class="empty-cart-container">
                    <div class="empty-cart-empty">
                        <img src="{{ asset('front/images/empty_cart.png') }}" alt="Empty Cart" class="empty-cart-img" />
                        <p class="empty-cart-message">Let’s equip your care kit, your cart’s looking a bit empty.</p>
                        <a href="{{ route('products.flash.sale') }}"><button class="empty-cart-shop-btn">Continue
                                Shopping</button></a>
                    </div>

                    <div class="empty-cart-best-selling">
                        <h2>Best Selling Products</h2>
                        <div class="empty-cart-product-list">
                            <!-- Product cards -->
                            @foreach ($flashSaleProducts as $product)
                                @if ($loop->index >= 6)
                                    @break
                                @endif
                                <a
                                    href="{{ route('products.sub.category.wise', ['slug' => $product->category->slug, 'subSlug' => $product->slug]) }}">
                                    <div class="empty-cart-product-card">
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" />
                                        <div class="empty-cart-product-info">
                                            <p>{{ $product->name }}</p>
                                            <strong>₹ @indianCurrency($product->our_price)</strong>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @else
                <div class="cartTitle">
                    <img src="{{ asset('front/images/cart.svg') }}" alt="cart" />
                    <div>
                        @php
                            $total = 0;
                            $gst = 0;
                            $offer = 0;

                            if (
                                isset($cartProducts) &&
                                !empty($cartProducts[0]) &&
                                !empty($cartProducts[0]->cartProducts)
                            ) {
                                foreach ($cartProducts[0]->cartProducts as $cartItem) {
                                    if (isset($cartItem->is_visible) && $cartItem->is_visible == 1) {
                                        $productPrice = $cartItem->product->our_price * $cartItem->quantity;
                                        $total += $productPrice;
                                        $gst += ($productPrice * $cartItem->product->gst) / 100;
                                    }
                                }

                                $offer = $cartProducts[0]->discount_offer_amount ?? 0;
                                $totalPayable = round($total - $offer + $gst, 2);
                            }
                        @endphp


                        <h4>
                            @if($cartProductCount1 > 1)
                            {{ $cartProductCount1 ?? 0 }} Items in your cart
                            @else
                            {{ $cartProductCount1 ?? 0 }} Item in your cart
                            @endif
                        </h4>
                    </div>
                </div>
                @if (isset($cartProducts[0]) && !empty($cartProducts[0]))
                    <div class="row18">
                        <div class="cart50">
                            <div id="delivery-address">
                                @include('front.common.delivery-address')
                            </div>
                            <div class="cartProductpart1" id="cart-items">
                                @include('front.common.cart.items')
                            </div>
                            <div class="offer-box">
                                <div class="offer-left">
                                    <img src="{{ asset('front/images/discount-icon.png') }}" alt="Discount Icon">
                                    <div class="offer-text">
                                        <strong>Offers & Discounts</strong><br>
                                        <small>*T&C apply</small>
                                    </div>
                                </div>
                                <div class="apply-btn" onclick="getMoreOffers()">Apply Now</div>
                            </div>

                        </div>
                        <div class="cart50">
                            {{-- <div class="flatOffer">
                            <img src="{{ asset('front/images/flat_offer.svg/') }}" alt="" />
                            <div class="flatCon">
                                <strong>{{ $offerOrDiscount->title }}</strong>
                                <p>{{ $offerOrDiscount->description }}</p>
                            </div>
                            <div class="linkPart">
                                <span>*T&C apply</span>
                                <a id="applyCoupon" data-cart-id="{{ $cartProducts[0]->id }}"
                                    data-coupon-code="{{ $offerOrDiscount->code }}" onclick="applyOffer(this, true)">Apply
                                    Now</a>

                            </div>
                            @if (isset($cartProducts[0]->discount_offer_id) && $cartProducts[0]->offer && $offerOrDiscount->id == $cartProducts[0]->discount_offer_id)
                                <div class="removeDiscount" style="display: block;"
                                    id="removeDiscount-{{ $cartProducts[0]->offer->code }}" style="color: red;">
                                    <a id="removeCoupon" data-cart-id="{{ $cartProducts[0]->id }}"
                                        data-coupon-code="{{ $cartProducts[0]->offer->code }}"
                                        onclick="removeOffer(this, true)" style="color: red;">
                                        Remove
                                    </a>
                                </div>
                            @else
                                <div class="removeDiscount" id="removeDiscount-{{ $offerOrDiscount->code }}">
                                    <a id="removeCoupon" data-cart-id="{{ $cartProducts[0]->id }}"
                                        data-coupon-code="{{ $offerOrDiscount->code }}"
                                        onclick="removeOffer(this, true)">Remove</a>
                                </div>
                            @endif
                        </div>
                        <div class="offerLink1">
                            <a id="getMoreOffers" onclick="getMoreOffers()">View More Offers</a>
                        </div> --}}
                            <div id="buyOption" class="option-box active">
                                <div class="header">
                                    <label>
                                        <input type="radio" name="mode" value="buy" checked>
                                        <span style="font-weight: bold;">Buy Now</span>
                                    </label>
                                    <div class="amount">Total Payable<span id="buyAmount" style="font-weight: bold;"> &nbsp;
                                            ₹ {{ $totalPayable }}</span></div>
                                </div>
                                <button class="pay-btn" id="proceedButton" data-cartid="{{ $cartProducts[0]->id }}">Proceed
                                    to Pay</button>
                            </div>

                            <div id="rentOption" class="option-box" onclick="showopopunderDev();">
                                <div class="header">
                                    <label>
                                        <input type="radio" name="mode" value="rent" disabled>
                                        <span style="font-weight: bold;"> Rent Now</span>
                                    </label>
                                    <div class="amount">Total Payable<span id="rentAmount" style="font-weight: bold;"> ₹
                                            00</span></div>
                                </div>
                                <div class="slider-container">
                                    <div class="slider-label">
                                        <input type="range" min="1" max="5" value="1" class="slider"
                                            id="rentSlider" disabled>
                                    </div>
                                    <div class="rent-options">
                                        <label>1 Month</label>
                                        <label>3 Month</label>
                                        <label>6 Month</label>
                                        <label>9 Month</label>
                                        <label>12 Month</label>
                                    </div>

                                </div>
                                <button class="pay-btn">Proceed to Pay</button>
                            </div>
                            @php
                                $total = 0;
                                $totalONRent = 0;
                                $subTotal = 0;
                                $gst = 0;
                                $cartId = 0;
                                $couponId = 0;
                                if (isset($cartProducts) && isset($cartProducts[0])) {
                                    $cartId = $cartProducts[0]->id;
                                }
                                if (isset($offerOrDiscount)) {
                                    $couponId = $offerOrDiscount->id;
                                }
                            @endphp
                            <div id="orderSummery">
                                @include('front.common.cart.order-summary')
                            </div>
                            {{-- <div id="delivery-address">
                            @include('front.common.delivery-address')
                        </div>

                        <div class="proceedBtn">
                            <button id="proceedButton" data-cartid="{{ $cartProducts[0]->id }}">Proceed to Pay</button>

                            <!-- <form id="razorpay-form" action="{{ route('order.create') }}" method="POST">
                                    <input type="hidden" id="total-hidden" value="{{ $total }}" name="total" />
                                    <input type="hidden" value="{{ $subTotal }}" name="subTotal" />
                                    <input type="hidden" value="{{ $cartId }}" name="cartId" />
                                    @csrf
                                    <script id="razorpay-script" src="https://checkout.razorpay.com/v1/checkout.js" data-key="{{ env('RAZORPAY_KEY') }}"
                                        data-amount="{{ $total * 100 }}" data-buttontext="Proceed to Pay" data-name="Arogyabharat"
                                        data-description="Arogya bharat" data-image="{{ asset('/front/images/arogya_bharat.svg') }}"
                                        data-prefill.name="test" data-prefill.email="test@test.com" data-theme.color="#ff7529"></script>
                                </form> -->
                        </div> --}}
                        </div>
                    </div>
                @endif
            @endIf
        </div>

        <div class="addressFormPop winScrollStop" style="display: none;">
            @include('front.common.change-delivery-adress')
        </div>
        {{-- <div class="addressFormPop1 winScrollStop">
            @include('front.common.add-adress')
        </div> --}}
        <div class="offer-apply-success" style="display:none;">
            <div id="offer-html">
                @include('front.common.offer-success')
            </div>
        </div>
        <div class="offerPop winScrollStop" id="offerModal" style="display:none;">
            <div class="offerPopMiddle">
                <div class="offerPopInner">
                    <a href="#;"><img src="{{ asset('front/images/cross.svg') }}" alt="cross" /> </a>
                    <h4>Offer & Benefits</h4>
                    <div class="couponInput">
                        <input type="text" id="couponCode" placeholder="Enter coupon code" />
                        <button id="applyCouponButton">Apply</button>
                         <div id="errormsgoffer" style="color:red;"></div>
                    </div>
                    <div class="orLine">
                        <span>OR</span>
                    </div>
                    <div class="offers-grid" id="offers-container">
                        @include('front.common.more-offer')
                    </div>
                </div>
            </div>
        </div>
        <div class="log-out">
            <div class="popup-overlay" id="logoutPopup1" style="display: none;">
                <div class="popup">
                    <button class="close-btn" onclick="closePopupadress()">&times;</button>
                    <img src="{{ asset('front/images/grandpa_delete.svg') }}" alt="Logout" class="popup-image1" />
                    {{-- <h2 class="popup-title">Come back soon!</h2> --}}
                    <p class="popup-text">Are you sure you want to Delete?</p>
                    <div class="popup-buttons">
                        <button class="btn yes-btn" id="delete_Adress">Yes</button>
                        <button class="btn cancel-btn" onclick="closePopupadress()">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="log-out">
<div class="popup-overlay" id="logoutPopup4" style="display: none;">
    <div class="popup">
      <button class="close-btn" onclick="document.getElementById('logoutPopup4').style.display='none';">&times;</button>
      <img src="{{asset('front/images/under_construction.svg')}}" alt="Logout" class="popup-image1" />
      {{-- <h2 class="popup-title">Come back soon!</h2> --}}
      <p class="popup-text">Temporarily unavailable.Please try again later</p>
      <div class="popup-buttons">
        <a href="{{route('raise.query')}}"><button class="btn yes-btn" style="padding: 10px 1px;" >Raise Query</button></a>
        <button class="btn cancel-btn" onclick="document.getElementById('logoutPopup4').style.display='none';">Cancel</button>
      </div>
    </div>
  </div>
 </div>
  <div class="add-adress-popup-overlay" id="add-adress-popup-overlay">
        <div class="add-adress-popup-container">
            <button class="add-adress-close-btn" onclick="closePopup5()">&times;</button>

            <div class="add-adress-popup-header">
                <h2 class="add-adress-popup-title" id="add-adress-popup-title">Edit Address</h2>
                <p class="add-adress-popup-subtitle">Enter pincode to get accurate delivery info</p>
            </div>

            <form id="addressForm5" onsubmit=" updateAddress(event)">
                <div class="add-adress-form-row">
                    <div class="add-adress-form-group">
                        <label for="fullName">Full Name<span class="add-adress-required">*</span></label>
                        <div class="add-adress-input-wrapper valid">
                            <input type="text" id="fullName" name="name" placeholder="Enter Your Full Name" value="" required>
                            <div class="errormsg"></div>
                        </div>
                    </div>
                    <div class="add-adress-form-group">
                        <label for="mobile">Mobile Number<span class="add-adress-required">*</span></label>
                        <div class="add-adress-input-wrapper valid">
                            <input type="tel" id="mobile" name="mobile" placeholder="Enter Mobile Number" required>
                            <div class="errormsg"></div>
                        </div>
                    </div>
                </div>

                <div class="add-adress-form-row">
                    <div class="add-adress-form-group">
                        <label for="pincode">Pincode<span class="add-adress-required">*</span></label>
                        <input type="text" id="pincode" name="pincode"  onblur="chekPincodeAvil(this.value);" placeholder="Enter 6-digit pincode" maxlength="6" required>
                        <div id="error-message_pin"></div>
                    </div>
                    <div class="add-adress-form-group">
                        <label for="pincode">House Number<span class="add-adress-required">*</span></label>
                        <div class="add-adress-input-wrapper valid">
                            <input type="text" id="house_number" name="house_number" placeholder="Flat, House no, Building, Apartment">
                            <div class="errormsg"></div>
                        </div>
                    </div>
                </div>

                <div class="add-adress-form-row">
                    <div class="add-adress-form-group">
                        <label for="pincode">Society Name<span class="add-adress-required">*</span></label>
                        <div class="add-adress-input-wrapper valid">
                            <input type="text" id="society_name" name="society_name" placeholder="Area, Street, Sector, Village, Town">
                            <div class="errormsg"></div>
                        </div>
                    </div>
                    <div class="add-adress-form-group">
                        <label for="landmark">Landmark (optional)</label>
                        <div class="add-adress-input-wrapper valid">
                            <input type="text" id="landmark" name="landmark" placeholder="Enter nearby landmark">
                            <div class="errormsg"></div>
                        </div>
                    </div>
                </div>

                <div class="add-adress-form-row">
                    <div class="add-adress-form-group">
                        <label for="city">City</label>
                        <div class="add-adress-input-wrapper valid">
                            <input type="text" id="city" name="city" placeholder="Enter Your City" readonly>
                            <div class="errormsg"></div>
                        </div>
                    </div>
                    <div class="add-adress-form-group">
                        <label for="state">State</label>
                        <div class="add-adress-input-wrapper valid">
                            <input type="text" id="state" name="state" placeholder="Enter Your State" readonly>
                            <div class="errormsg"></div>
                        </div>
                    </div>
                </div>

                <div class="add-adress-checkbox-container">
                    <div class="add-adress-checkbox-group">
                        <input type="checkbox" id="defaultAddress" name="delivery">
                        <label for="defaultAddress">Mark as Default Address</label>
                    </div>
                </div>

                <button type="submit" class="add-adress-submit-btn">Submit</button>
            </form>
        </div>
    </div>

        <script src="{{ asset('front/js/jquery.min.js') }}"></script>
        <script src="{{ asset('front/js/slick.js') }}"></script>
        <script src="{{ asset('front/js/script.js') }}"></script>
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
        <script>
        function closePopup5() {
            document.querySelector('.add-adress-popup-overlay').style.display = 'none';
        }

        // Form validation
        const form = document.getElementById('addressForm');
        const inputs = form.querySelectorAll('input[type="text"], input[type="tel"]');

        inputs.forEach(input => {
            input.addEventListener('input', function() {
                validateField(this);
            });

            input.addEventListener('blur', function() {
                validateField(this);
            });
        });

        function validateField(field) {
            const wrapper = field.closest('.input-wrapper');
            if (!wrapper) return;

            const isValid = field.value.trim() !== '';

            if (field.type === 'tel') {
                const phoneRegex = /^[6-9]\d{9}$/;
                if (isValid && !phoneRegex.test(field.value)) {
                    wrapper.classList.remove('valid');
                    return;
                }
            }

            if (field.name === 'pincode') {
                const pincodeRegex = /^\d{6}$/;
                if (isValid && !pincodeRegex.test(field.value)) {
                    wrapper.classList.remove('valid');
                    return;
                }
            }

            // if (isValid) {
            //     wrapper.classList.add('valid');
            // } else {
            //     wrapper.classList.remove('valid');
            // }
        }

        // Pincode auto-fill city and state
        document.getElementById('pincode').addEventListener('input', function() {
            const pincode = this.value;
            if (pincode.length === 6) {
                // This is a mock implementation - in real apps, you'd call an API
                setTimeout(() => {
                    validateField(document.getElementById('city'));
                    validateField(document.getElementById('state'));
                }, 500);
            }
        });
        // Close popup when clicking outside
        document.querySelector('.add-adress-popup-overlay').addEventListener('click', function(e) {
            if (e.target === this) {
                closePopup5();
            }
        });

        // Close popup with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closePopup5();
            }
        });
    </script>

        <script>
            const buyBox = document.getElementById('buyOption');
            const rentBox = document.getElementById('rentOption');
            const radioButtons = document.querySelectorAll('input[name="mode"]');
            const slider = document.getElementById('rentSlider');
            const rentAmount = document.getElementById('rentAmount');

            radioButtons.forEach(radio => {
                radio.addEventListener('change', () => {
                    if (radio.value === 'buy') {
                        buyBox.classList.add('active');
                        rentBox.classList.remove('active');
                    } else {
                        rentBox.classList.add('active');
                        buyBox.classList.remove('active');
                    }
                });
            });

            slider.addEventListener('input', () => {
                const values = {
                    1: " ₹ 1746.00",
                    2: " ₹ 1746.00",
                    3: " ₹ 1746.00",
                    4: " ₹ 1746.00",
                    5: " ₹ 1746.00"
                };
                //   rentAmount.textContent = values[slider.value];

                const percentage = (slider.value - 1) / 4 * 100;
                slider.style.background =
                    `linear-gradient(to right, #2d4a91 0%, #2d4a91 ${percentage}%, #ddd ${percentage}%, #ddd 100%)`;
            });

            function showopopunderDev() {
                // Show the popunder
                document.getElementById('logoutPopup4').style.display='flex';
            }
            // Initialize background on load
            slider.dispatchEvent(new Event('input'));
        </script>
        <script>
            $(document).ready(function() {

                $("#addressForm .submitBTN").click(function(e) {
                    e.preventDefault(); // Prevent the form from submitting normally
                    if (!$('#DA').prop('checked')) {
                        $('#DA').val('0');
                    } else {
                        // If checked, ensure the value is 1 (it should already be by default)
                        $('#DA').val('1');
                    }
                    // Collect form data
                    var formData = {
                        house_number: $("#addressForm input[name='house_number']").val(),
                        society_name: $("#addressForm input[name='society_name']").val(),
                        locality: $("#addressForm input[name='locality']").val(),
                        landmark: $("#addressForm input[name='landmark']").val(),
                        pincode: $("#addressForm input[name='pincode']").val(),
                        city: $("#addressForm input[name='city']").val(),
                        state: $("#addressForm input[name='state']").val(),
                        delivery: $("#addressForm input[name='delivery']").val(),
                        mobile: $("#addressForm input[name='mobile']").val(),
                        name: $("#addressForm input[name='name']").val(),
                        uuid: $("#addressForm input[name='uuid']").val(),
                    };

                    $(".errormsg").hide();

                    // AJAX call
                    $.ajax({
                        url: '/customer/save-address',
                        type: 'GET',
                        data: formData,
                        success: function(response) {
                            if (response.success) {
                                // Address saved successfully, handle the UI changes
                                $('#addressForm')[0].reset();
                                $('.addressFormPop').hide();
                                $('.addAddress').hide();
                                $('.deliveryAddress').show();
                                $('body').css('overflow-y', 'auto');
                                $('#delivery-address').html(response.adressHtml);
                                location.reload();
                            } else {
                                // Show error messages
                                if (response.status == 401) {
                                    document.getElementById('logoutPopup3').style.display='flex';
                                    // toastr.error(response.message);
                                } else {

                                    $.each(response.errors, function(key, value) {
                                        $("#addressForm input[name='" + key + "']").next(
                                            '.errormsg').text(value).show();
                                    });
                                }
                            }
                        },
                        error: function(xhr, status, error) {
                            // Handle any unexpected errors
                             document.getElementById('logoutPopup3').style.display='flex';
                            // toastr.error('Something went wrong. Please try again later.');
                        }
                    });
                });

                $("#proceedButton").click(function(e) {
                    e.preventDefault(); // Prevent the form from submitting normally

                    // Get cart ID from the button data attribute
                    var cartId = $(this).data('cartid');

                    // Prepare data for the AJAX request
                    var paymentData = {
                        cart_id: cartId,
                        _token: '{{ csrf_token() }}' // CSRF token for Laravel
                    };

                    // Clear previous error messages
                    $(".errormsg").hide();

                    // AJAX call for Razorpay payment
                    $.ajax({
                        url: '{{ route('order.create') }}',
                        type: 'POST',
                        data: paymentData,
                        success: function(response) {
                            // console.log('response', response);
                            if (response.success) {
                                // Payment successful, handle UI changes or redirection
                                // Redirect or update UI as needed
                                payAmount(response.amount, response.order_id, response.customer);
                            } else {
                                  document.getElementById('logoutPopup3').style.display='flex';
                                // toastr.error('Payment failed. Please try again.');
                            }
                        },
                        error: function(xhr, status, error) {
                            if (xhr.status == 401) {
                                var response = JSON.parse(xhr.responseText);
                                if(response.message=='Please login to proceed with payment.'){
                                   window.location.href="{{route('login')}}"
                                }else if(response.message=='Please add a delivery address.'){
                            document.getElementById('text-btween-cartpopup').innerHTML='Let’s add your address first.'
                            cartPopup();
                                addNewDeliveryAddress1();
                                }else{
                                    document.getElementById('logoutPopup3').style.display='flex';
                                }
                                // document.getElementById('logoutPopup3').style.display='flex';
                                // toastr.error(response.message);
                            } else if (xhr.status == 404) {
                                var response = JSON.parse(xhr.responseText);
                               if(response.message=='Please login to proceed with payment.'){
                                   window.location.href="{{route('login')}}"
                                }else if(response.message=='Please add a delivery address.'){
                                 document.getElementById('text-btween-cartpopup').innerHTML='Let’s add your address first.'
                                 cartPopup();
                                addNewDeliveryAddress1();
                                }else{
                                    document.getElementById('logoutPopup3').style.display='flex';
                                }
                                // toastr.error(response.message);
                            } else {
                                  document.getElementById('logoutPopup3').style.display='flex';
                                // toastr.error(
                                //     'Something went wrong with the payment. Please try again later.'
                                // );
                            }
                        }
                    });
                });

                //based on tenure
                // Add event listener to tenure radio buttons
                $("input[name='tenure']").change(function() {
                    var selectedTenure = $("input[name='tenure']:checked").val();
                     document.getElementById('logoutPopup3').style.display='flex';
                    // Alert the selected tenure value
                    // toastr.error("Selected tenure: " + selectedTenure);

                    // Hide all list items initially within the `.cart-items` container
                    $(".cart-items li").hide();

                    // Based on tenure, show the respective list items
                    if (selectedTenure === "week_1") {
                        // Show the first list item for 1 week
                        $(".cart-items li").eq(3).show();
                        $(".cart-items #week").show();
                    } else if (selectedTenure === "week_2") {
                        // Show the first two list items for 2 weeks
                        $(".cart-items li").eq(0).show();
                        $(".cart-items li").eq(3).show();
                    } else if (selectedTenure === "week_3") {
                        // Show the first three list items for 3 weeks
                        $(".cart-items li").eq(0).show();
                        $(".cart-items li").eq(1).show();
                        $(".cart-items li").eq(2).show();
                    } else if (selectedTenure === "month_1") {
                        // Show the first list item for 1 month
                        $(".cart-items #month").show();
                    } else if (selectedTenure === "month_3") {
                        // Show the first three list items for 3 months
                        $(".cart-items li").eq(0).show();
                        $(".cart-items li").eq(1).show();
                        $(".cart-items li").eq(2).show();
                    } else if (selectedTenure === "month_6") {
                        // Show the first three list items for 6 months (if you have more than 3)
                        $(".cart-items li").eq(0).show();
                        $(".cart-items li").eq(1).show();
                        $(".cart-items li").eq(2).show();
                    } else if (selectedTenure === "month_9") {
                        // Show the first three list items for 9 months (if available)
                        $(".cart-items li").eq(0).show();
                        $(".cart-items li").eq(1).show();
                        $(".cart-items li").eq(2).show();
                    } else if (selectedTenure === "month_12") {
                        // Show all list items for 12 months
                        $(".cart-items li").show();
                    }
                });


                $('#applyCouponButton').click(function(e) {
                    e.preventDefault();

                    // Get the coupon code entered by the user
                    var couponCode = $('#couponCode').val();

                    if (couponCode === "") {
                       document.getElementById('errormsgoffer').innerHTML="Please enter a coupon code.";
                        return;
                    }

                    // Perform the AJAX POST request to apply the coupon code
                    $.ajax({
                        url: "{{ route('applycouponcode') }}", // The route for applying the coupon
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}", // CSRF token for security
                            @if(isset($cartProducts[0]) && !empty($cartProducts[0]))
                            cartId:"{{ $cartProducts[0]->id }}",
                            @endif
                            couponCode: couponCode // Coupon code entered by the user
                        },
                        success: function(response) {
                        if (response.success) {
                            // toastr.success(response.message);
                            document.getElementById('offerModal').style.display='none';
                            
                                $('#apply-' + couponCode).hide();
                                $('#removeDiscount-' + couponCode).show();
                                $('.offer-apply-success').show();
                            // 
                            $('#orderSummery').html(response.orderSummaryResponse);
                            $('#offer-html').html(response.couponHtml);
                            $('.flatDicountPop').css('display', 'flex');
                        } else {
                            document.getElementById('errormsgoffer').innerHTML=response.message;
                            // toastr.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                         document.getElementById('logoutPopup3').style.display='flex';
                        // toastr.error('Something went wrong. Please try again later.');
                    }
                    });
                });
            });

            $('#searchInput').on('keyup', function() {
                var query = $(this).val(); // Get the input value

                if (query.length >= 3) { // Trigger search when at least 2 characters are entered
                    $.ajax({
                        url: "{{ route('search.products') }}", // Your route to search products
                        type: 'GET',
                        data: {
                            query: query // Send the input as a query parameter
                        },
                        success: function(response) {
                            if (response.success === false) {
                                $('#searchResultList').html('<li>No products found.</li>');
                            } else {
                                $('#searchResultList').html(response); // Render the results
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                            $('#searchResultList').html('<li>Something went wrong.</li>');
                        }
                    });
                } else {
                    $('#searchResultList').empty(); // Clear results if query length is less than 2
                }
            });

            function updateQuantity(cartItemId, cartId, action) {
                $.ajax({
                    url: "{{ route('cart.update-quantity') }}",
                    type: 'POST',
                    data: {
                        cartId: cartId,
                        cartItemId: cartItemId,
                        action: action,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#quantity-' + cartItemId).text(response.newQuantity);
                            $('#orderSummery').html(response.orderSummaryResponse);
                            // toastr.success('Quantity updated succesfully.');
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                         document.getElementById('logoutPopup3').style.display='flex';
                        // toastr.error('Something went wrong. Please try again later.');
                    }
                });
            }

            function deleteCartItem(cartItemId) {
                document.getElementById('logoutPopup1').style.display = '';
                document.getElementById('delete_Adress').onclick = function() {
                    console.log("Button clicked, passing address ID:", cartItemId); // Debug log
                    removecartproduct(cartItemId);
                };
            }

            function removecartproduct(cartItemId) {
                // if (confirm('Are you sure you want to delete this item from the cart?')) {
                $.ajax({
                    url: "{{ route('cart.delete-item', '') }}/" + cartItemId, // Adjust the route as needed
                    type: 'DELETE', // Use DELETE method
                    data: {
                        _token: '{{ csrf_token() }}' // Include CSRF token for Laravel
                    },
                    success: function(response) {
                        if (response.success) {
                            // toastr.success('Item deleted successfully.');
                            $('#cart-items').html(response.cartItmes);
                            $('#orderSummery').html(response.orderSummaryResponse);
                            location.reload();
                        } else {
                           document.getElementById('logoutPopup3').style.display='flex';
                        }
                    },
                    error: function(xhr, status, error) {
                         document.getElementById('logoutPopup3').style.display='flex';
                        // toastr.error('Something went wrong. Please try again later.');
                    }
                });
                // }
            }

            function applyOffer(element, single = false) {
                var cartId = $(element).data('cart-id');
                var couponCode = $(element).data('coupon-code');

                $.ajax({
                    url: "{{ route('applycoupon') }}",
                    type: 'POST',
                    data: {
                        cartId: cartId,
                        couponCode: couponCode,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            // toastr.success(response.message);
                            document.getElementById('offerModal').style.display='none';
                            if (single) {
                                $('.flatOffer .removeDiscount').css('display', 'block');
                                $('#applyCoupon').hide();
                                $('.offer-apply-success').show();
                            } else {
                                $('#apply-' + couponCode).hide();
                                $('#removeDiscount-' + couponCode).show();
                                $('.offer-apply-success').show();
                            }
                            $('#orderSummery').html(response.orderSummaryResponse);
                            $('#offer-html').html(response.couponHtml);
                            $('.flatDicountPop').css('display', 'flex');
                        } else {
                            document.getElementById('errormsgoffer').innerHTML=response.message;
                            // toastr.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                         document.getElementById('logoutPopup3').style.display='flex';
                        // toastr.error('Something went wrong. Please try again later.');
                    }
                });
            }

            function removeOffer(element, single = false) {
                var cartId = $(element).data('cart-id');
                var couponCode = $(element).data('coupon-code');
                $.ajax({
                    url: "{{ route('removecoupon', '') }}",
                    type: 'POST',
                    data: {
                        cartId: cartId,
                        couponCode: couponCode,
                        _token: '{{ csrf_token() }}' // Include CSRF token for Laravel
                    },
                    success: function(response) {
                        if (response.success) {
                            // toastr.success(response.message);
                             document.getElementById('offerModal').style.display='none';
                            if (single) {
                                $('.flatOffer .removeDiscount').css('display', 'none');
                                $('.linkPart #applyCoupon').css('display', 'block');
                            } else {
                                $('#apply-' + couponCode).show();
                                $('#removeDiscount-' + couponCode).hide();
                                $('.offer-apply-success').hide();
                            }
                            $('#orderSummery').html(response.orderSummaryResponse);
                            // $('#apply-' + couponCode).show();
                            // $('#removeDiscount-' + couponCode).hide();
                        } else {
                            // toastr.success(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                         document.getElementById('logoutPopup3').style.display='flex';
                        // toastr.error('Something went wrong. Please try again later.');
                    }
                });
            }

            // Initialize with the total amount from server
            let selectedProductsTotal = parseFloat(document.getElementById('total-hidden').value.replace('₹', '').trim());

            function cartItemChange(event, cartItemId, cartId) {
                const isVisible = event.target.checked ? 1 : 0; // 1 for checked, 0 for unchecked

                $.ajax({
                    url: "{{ route('cart.update-visibility') }}",
                    type: 'POST',
                    data: {
                        cartId: cartId,
                        cartItemId: cartItemId,
                        is_visible: isVisible,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            if (isVisible == 1) {
                                // toastr.success('Item selected successfully.');
                            } else {
                                // toastr.success('Item remove from selected successfully.');
                            }
                            $('#orderSummery').html(response.orderSummaryResponse);
                        } else {
                             document.getElementById('logoutPopup3').style.display='flex';
                            // toastr.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                         document.getElementById('logoutPopup3').style.display='flex';
                        // toastr.error('Something went wrong. Please try again later.');
                    }
                });
            }


            function updateRazorpayAmount(amount) {
                // Update Razorpay or payment gateway amount logic here
                console.log(`Updated Razorpay amount: ₹ ${amount.toFixed(2)}`);
            }


            function updateRazorpayAmount(amount) {
                const razorpayScript = document.getElementById('razorpay-script');
                console.log('razorpayScript', razorpayScript);
                razorpayScript.setAttribute('data-amount', amount * 100);
                console.log('razorpayScript--------------------------', razorpayScript);
                console.log("Updated Razorpay amount to: ₹", amount);
            }

            function getMoreOffers() {
                $.ajax({
                    url: "{{ route('getcoupons') }}",
                    type: 'GET',
                    success: function(response) {
                        console.log(response);
                        $("#offers-container").html(response);
                        $("#offerModal").show();
                    },
                    error: function(xhr, status, error) {
                         document.getElementById('logoutPopup3').style.display='flex';
                        // toastr.error('Something went wrong. Please try again later.');
                    }
                });
            }

            function payAmount(amount, order_id, customer) {
                var options = {
                    "key": "{{ env('RAZORPAY_KEY') }}",
                    "amount": amount,
                    "currency": "INR",
                    "name": "Aarogyaa Bharat",
                    "description": "Test Transaction",
                    "image": "{{ asset('admin/images/arogya_bharat.svg') }}",
                    "order_id": order_id,
                    "callback_url": "{{ route('payment.success') }}",
                    "prefill": {
                        "name": customer.name,
                        "email": customer.email,
                        "contact": customer.mobile
                    },
                    "theme": {
                        "color": "#FFCC5C"
                    }
                };
                var rzp1 = new Razorpay(options);
                rzp1.open();
            }

            function closeOfferSuccessPopup() {
                $('.flatDicountPop').hide();
            }

            function showPaymentSuccessPopup() {
                $('.orderplacedPop').show();
            }

            function addNewDeliveryAddress() {
                $('#addressForm')[0].reset();
                $('.addressFormPop').show();
            }

            function editDeliveryAddress(id) {
                $.ajax({
                    url: '/customer/get-address/' + id, // Make sure to create this route to fetch the address details
                    method: 'GET',
                    success: function(response) {
                        // Populate the form with the existing address details
                        // $('#addressForm input[name="house_number"]').val(response.house_number);
                        // $('#addressForm input[name="society_name"]').val(response.society_name);
                        // $('#addressForm input[name="landmark"]').val(response.landmark);
                        // $('#addressForm input[name="pincode"]').val(response.pincode);
                        // $('#addressForm input[name="city"]').val(response.city);
                        // $('#addressForm input[name="state"]').val(response.state);
                        // $('#addressForm input[name="delivery"]').prop('checked', response.is_delivery_address);
                        // $('#addressForm input[name="uuid"]').val(id);
                        $('.addressFormPop').show();
                    }
                });
            }

            function addNewDeliveryAddress1() {
                 $('.errormsg').text('');
                 $('#addressForm5')[0].reset();
                 document.getElementById('add-adress-popup-title').innerHTML="Add Address";
                 document.getElementById('add-adress-popup-overlay').style.display='flex';
            }

            function closePopupadress() {
                document.getElementById('logoutPopup1').style.display = 'none';
            }
            $('.errormsg').css('color', 'red');
            function chekPincodeAvil(pincode) {
                document.getElementById('error-message_pin').innerHTML = 'Searching...';
                document.getElementById('error-message_pin').style.color = 'black';
                $.ajax({
                    url: "{{ url('/get-city-state') }}/" + pincode, // Change this to your actual endpoint
                    method: 'GET', // Use POST or GET as needed

                    success: function(response) {
                        if (response.success) {
                            document.getElementById('error-message_pin').innerHTML = '';
                            document.getElementById('state').value = response.state;
                            document.getElementById('city').value = response.city;
                        } else {
                            document.getElementById('state').value = '';
                            document.getElementById('city').value = '';
                            document.getElementById('error-message_pin').innerHTML = response.message;
                             document.getElementById('error-message_pin').style.color = 'red';
                        }
                    }
                });
            }

        </script>
    </section>
@endsection('content')

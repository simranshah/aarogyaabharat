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
            @if (session('success'))
                <script>
                    toastr.success('{{ session('success') }}');
                </script>
            @endif

            @if (session('error'))
                <script>
                    toastr.error('{{ session('error') }}');
                </script>
            @endif

            <div class="cartTitle">
                <img src="{{ asset('front/images/cart.svg') }}" alt="cart" />
                <div>
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
                    @php
                    $total = 0;
                    $gst = 0;
                    $offer = 0;
                
                    if (isset($cartProducts) && !empty($cartProducts[0]) && !empty($cartProducts[0]->cartProducts)) {
                        foreach ($cartProducts[0]->cartProducts as $cartItem) {
                            if (isset($cartItem->is_visible) && $cartItem->is_visible == 1) {
                                $productPrice = $cartItem->product->our_price * $cartItem->quantity;
                                $total += $productPrice;
                                $gst += ($productPrice * $cartItem->product->gst) / 100;
                            }
                        }
                
                        $offer = $cartProducts[0]->discount_offer_amount ?? 0;
                        $totalPayable = round($total - $offer + $gst,2);
                    }
                @endphp
                

                    <h4>{{ $cartProductCount1 ?? 0 }} Item in your cart</h4>
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
                            <div class="apply-btn"  onclick="getMoreOffers()">Apply Now</div>
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
                              <div class="amount">Total Payable<span id="buyAmount" style="font-weight: bold;"> &nbsp; ₹ {{$totalPayable}}</span></div>
                            </div>
                            <button class="pay-btn" id="proceedButton" data-cartid="{{ $cartProducts[0]->id }}">Proceed to Pay</button>
                          </div>
                        
                          <div id="rentOption" class="option-box" onclick="showopopunderDev();">
                            <div class="header">
                              <label>
                                <input type="radio" name="mode" value="rent" disabled>
                                <span style="font-weight: bold;"> Rent Now</span>
                              </label>
                              <div class="amount">Total Payable<span id="rentAmount" style="font-weight: bold;"> ₹ 00</span></div>
                            </div>
                            <div class="slider-container">
                            <div class="slider-label">
                              <input type="range" min="1" max="5" value="1" class="slider" id="rentSlider" disabled>
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
        </div>

        <div class="addressFormPop winScrollStop" style="display: none;">
            @include('front.common.change-delivery-adress')
        </div>
        <div class="addressFormPop1 winScrollStop">
            @include('front.common.add-adress')
        </div>
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
                    </div>
                    <div class="orLine">
                        <span>OR</span>
                    </div>
                    <div id="offers-container">
                        @include('front.common.more-offer')
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('front/js/jquery.min.js') }}"></script>
        <script src="{{ asset('front/js/slick.js') }}"></script>
        <script src="{{ asset('front/js/script.js') }}"></script>
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
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
      slider.style.background = `linear-gradient(to right, #2d4a91 0%, #2d4a91 ${percentage}%, #ddd ${percentage}%, #ddd 100%)`;
    });
   function showopopunderDev() {
        // Show the popunder
        toastr.error('This feature is unavailable. Please check back later.');
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
                                    toastr.error(response.message);
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
                            toastr.error('Something went wrong. Please try again later.');
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
                                toastr.error('Payment failed. Please try again.');
                            }
                        },
                        error: function(xhr, status, error) {
                            if (xhr.status == 401) {
                                var response = JSON.parse(xhr.responseText);
                                toastr.error(response.message);
                            } else if (xhr.status == 404) {
                                var response = JSON.parse(xhr.responseText);
                                toastr.error(response.message);
                            } else {
                                toastr.error(
                                    'Something went wrong with the payment. Please try again later.'
                                );
                            }
                        }
                    });
                });

                //based on tenure
                // Add event listener to tenure radio buttons
                $("input[name='tenure']").change(function() {
                    var selectedTenure = $("input[name='tenure']:checked").val();

                    // Alert the selected tenure value
                    toastr.error("Selected tenure: " + selectedTenure);

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
                        toastr.error("Please enter a coupon code.");
                        return;
                    }

                    // Perform the AJAX POST request to apply the coupon code
                    $.ajax({
                        url: "{{ route('applycouponcode') }}", // The route for applying the coupon
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}", // CSRF token for security
                            couponCode: couponCode // Coupon code entered by the user
                        },
                        success: function(response) {
                            if (response.success) {
                                toastr.success(response.message);
                                // Perform additional actions, such as updating the cart or showing a modal
                                // $('#offerModal').hide();
                                $('.flatDicountPop').css('display', 'flex');
                            } else {
                                toastr.error(response.message); // Display error message if any
                            }
                        },
                        error: function(xhr, status, error) {
                            toastr.error('Something went wrong. Please try again later.');
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
                            toastr.success('Quantity updated succesfully.');
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr.error('Something went wrong. Please try again later.');
                    }
                });
            }

            function deleteCartItem(cartItemId) {
                if (confirm('Are you sure you want to delete this item from the cart?')) {
                    $.ajax({
                        url: "{{ route('cart.delete-item', '') }}/" + cartItemId, // Adjust the route as needed
                        type: 'DELETE', // Use DELETE method
                        data: {
                            _token: '{{ csrf_token() }}' // Include CSRF token for Laravel
                        },
                        success: function(response) {
                            if (response.success) {
                                toastr.success('Item deleted successfully.');
                                $('#cart-items').html(response.cartItmes);
                                $('#orderSummery').html(response.orderSummaryResponse);
                                 location.reload();
                            } else {
                                toastr.error(response.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            toastr.error('Something went wrong. Please try again later.');
                        }
                    });
                }
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
                            toastr.success(response.message);
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
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr.error('Something went wrong. Please try again later.');
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
                            toastr.success(response.message);
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
                            toastr.success(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr.error('Something went wrong. Please try again later.');
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
                                toastr.success('Item selected successfully.');
                            } else {
                                toastr.success('Item remove from selected successfully.');
                            }
                            $('#orderSummery').html(response.orderSummaryResponse);
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr.error('Something went wrong. Please try again later.');
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
                        toastr.error('Something went wrong. Please try again later.');
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
            function addNewDeliveryAddress1(){
                            const popup = document.querySelector('.addressFormPop1');
                            if (popup) {
                                popup.style.display = 'block';
                            }
                        }
        </script>
    </section>
@endsection('content')

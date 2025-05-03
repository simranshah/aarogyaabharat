@extends('front.layouts.layout')
@section('content')

<!-- <div class="searchPop winScrollStop">
    <div class="searchPopBlock">
        <strong>Recent Search</strong>
        <p>Our highest rented or buying products.</p>
        <ul id="searchResultList">
            @include('front.common.search-product-result')
        </ul>
    </div>
</div> -->

@include('front.common.welcome-message')
<div class="breadcrumbs">
    <div class="container">
        <ul>
            <li><a href="#;">Home</a> </li>
            <li><a href="#;">Cart</a> </li>
        </ul>
    </div>
</div>

<section class="cartSec">
    <div class="container">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        <div class="cartTitle">
            <img src="{{ asset('front/images/cart.svg') }}" alt="" />
            <div>
                <h4>{{$cartProductCount ?? 0}} Item in your cart</h4>
                <p>Enter your email or mobile to fill your need</p>
            </div>
        </div>
        <div class="row18">
            <div class="cart50">
                <div class="cartProductpart1">

                    @foreach($cartProducts as $cartItem)
                    <div class="cartProductblock1">
                        <div class="iconPart">
                            <label>
                                <!-- <input type="checkbox" onChange="cartItemChange(event, {{$cartItem}})" /> -->
                                <input type="checkbox" class="product-checkbox" id="checkbox-{{ $cartItem->id }}" onChange="cartItemChange(event, '{{ $cartItem->products->id }}', '{{ $cartItem->products->price * $cartItem->quantity }}')" checked />
                                <i></i>
                            </label>
                            <a href="{{ route('cart.delete-item', [$cartItem->id]) }}"><img src="{{ asset('front/images/delete_icon.svg') }}" alt="Delete" /></a>
                            <a href="#;"><img src="{{ asset('front/images/Share.svg') }}" alt="Share" /></a>
                        </div>
                        <div class="prodImg">
                            <img src="{{ asset('storage/' . $cartItem->products->image) }}" alt="{{ $cartItem->products->name }}" />
                        </div>
                        <div class="content">
                            <p>{{ $cartItem->products->name }}</p>
                            <strong>₹ {{ $cartItem->price }}</strong>
                            <div class="countProduct">
                                <a href="{{ route('cart.update-quantity', [$cartItem->id, 'minus']) }}" class="countMinus" data-id="{{ $cartItem->id }}" data-sign="minus">
                                    <img src="{{ asset('front/images/jam_minus.svg') }}" alt="Minus" />
                                </a>
                                <span>{{ $cartItem->quantity }}</span>
                                <a href="{{ route('cart.update-quantity', [$cartItem->id, 'plus']) }}" class="countPlus" data-id="{{ $cartItem->id }}" data-sign="plus">
                                    <img src="{{ asset('front/images/jam_plus.svg') }}" alt="Plus" />
                                </a>
                                <!-- <a href="#" class="countMinus"><img src="{{ asset('front/images/jam_minus.svg') }}" alt="Minus" /></a>
                                <span>{{ $cartItem->quantity }}</span>
                                <a href="#" class="countPlus"><img src="{{ asset('front/images/jam_plus.svg') }}" alt="Plus" /></a> -->
                            </div>
                        </div>
                         @if(isset($cartItem->products->is_rentable) && $cartItem->products->is_rentable == 1)<small> This product only available for rent.</small>@endif
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="cart50">
                <div class="flatOffer">
                    <img src="{{ asset('front/images/flat_offer.svg/') }}" alt="" />
                    <div class="flatCon">
                        <strong>{{ $offerOrDiscount->title }}</strong>
                        <p>{{ $offerOrDiscount->description }}</p>
                        <!-- <strong>Flat 150</strong>
                        <p>Lorem Ipsum placeholder text in any number of characters, words sentences.</p>     -->
                    </div>
                    <div class="linkPart">
                        <span>*T&C apply</span>
                        <a id="applyCoupon" onclick="applyOffer('{{ $offerOrDiscount->code }}')">Apply Now</a>
                    </div>
                    <div class="removeDiscount">
                        <a id="removeCoupon" onclick="removeOffer('{{ $offerOrDiscount->code }}')">Remove</a>
                    </div>
                </div>
                <div class="offerLink1">
                    <a id="getMoreOffers" onclick="getMoreOffers()">View More Offers</a>
                </div>
                <div class="radioBtns1">

                    @if(isset($cartProducts[0]->products->is_rentable) && $cartProducts[0]->products->is_rentable == 1)
                    <label class="radioLable">
                        <input type="radio" name="rentOrBuy" value="Rent_Now" />
                        <div class="radioLableBlock">
                            <span></span>
                            <div>
                                <strong>Rent Now</strong>
                                <i>Rent on tenure selection</i>
                            </div>
                        </div>
                    </label>
                    @endif
                    <label class="radioLable">
                        <input type="radio" name="rentOrBuy" value="Buy_Now" />
                        <div class="radioLableBlock">
                            <span></span>
                            <div>
                                <strong>Buy Now </strong>
                                <i>Basis on product price</i>
                            </div>
                        </div>
                    </label>
                </div>
                <div class="tenurePart">
                    <h4>Select Tenure:</h4>
                    <div class="tanureLine">
                        <label>
                            <input type="radio" name="tenure" checked value="week_1" />
                            <span>
                                <strong>1</strong>
                                <i>Week</i>
                            </span>
                        </label>
                        <label>
                            <input type="radio" name="tenure" value="week_2" />
                            <span>
                                <strong>2</strong>
                                <i>Week</i>
                            </span>
                        </label>
                        <label>
                            <input type="radio" name="tenure" value="week_3" />
                            <span>
                                <strong>3</strong>
                                <i>Week</i>
                            </span>
                        </label>
                        <label>
                            <input type="radio" name="tenure" value="month_1" />
                            <span>
                                <strong>1</strong>
                                <i>Months</i>
                            </span>
                        </label>
                        <label>
                            <input type="radio" name="tenure" value="month_3" />
                            <span>
                                <strong>3</strong>
                                <i>Months</i>
                            </span>
                        </label>
                        <label>
                            <input type="radio" name="tenure" value="month_6" />
                            <span>
                                <strong>6</strong>
                                <i>Months</i>
                            </span>
                        </label>
                        <label>
                            <input type="radio" name="tenure" value="month_9" />
                            <span>
                                <strong>9</strong>
                                <i>Months</i>
                            </span>
                        </label>
                        <label>
                            <input type="radio" name="tenure" value="month_12" />
                            <span>
                                <strong>12</strong>
                                <i>Months</i>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="orderSummery">
                    <h4>Order Summery</h4>
                    @php
                    $total = 0;
                    $totalONRent = 0;
                    $subTotal = 0;
                    $gst = 0;
                    $gst = 0;
                    $cartId = 0;
                    $couponId = 0;
                    if(isset($cartProducts) && isset($cartProducts[0])) {
                    $cartId = $cartProducts[0]->id;
                    }
                    if(isset($offerOrDiscount)) {
                    $couponId = $offerOrDiscount->id;
                    }
                    @endphp
                    <ul>
                        @foreach($cartProducts as $cartItem)
                        <li id="product-detail-{{ $cartItem->products->id }}">
                            <p>{{ $cartItem->products->name }}</p>
                            <strong>₹ {{ $cartItem->products->price  * $cartItem->quantity }}</strong>
                            @php
                            $total += $cartItem->products->price * $cartItem->quantity;
                            @endphp
                        </li>
                        @endforeach
                        <li>
                            <p>Total GST</p>
                            <strong>₹ 96</strong>
                        </li>
                        <li class="discount_1">
                            <p>Offer Discount</p>
                            <strong>- ₹ 150</strong>
                        </li>
                        <li class="freeDel">
                            <p>Delivery & Installation (Free)</p>
                            <strong>₹ 00</strong>
                        </li>
                        <li class="payable">
                            <p>Total Payable</p>
                            <strong> <span id="total-display">₹ {{$total}}</span></strong>
                            <input type="hidden" id="total-hidden" value="{{$total}}">
                        </li>
                    </ul>
                    <!-- @include('front.common.order-summary') -->
                </div>
                @if(!isset($customerAndAddresses) || empty($customerAndAddresses) || is_null($customerAndAddresses))
                <div class="addAddress">
                    <div class="addressNote">
                        <img src="{{asset('front/images/info-circle.svg')}}" alt="" />
                        <p>Please add your delivery address</p>
                    </div>
                    <div class="addressNoteError">
                        <img src="{{asset('front/images/alert_svgrepo.svg')}}" alt="" />
                        <p>Please add your delivery address</p>
                    </div>
                    <button>Add Delivery Address <img src="{{asset('front/images/jam_plus.svg')}}" alt="" /> </button>
                </div>
                @endif
                @if(isset($customerAndAddresses) && !empty($customerAndAddresses))
                <div class="deliveryAddress">
                    <div class="title1">
                        <strong>Delivery Address</strong>
                        <a href="#;"><img src="images/edit_pen.svg" alt="" /> </a>
                    </div>
                    <div class="deliveryAddressInner">
                        <label class="deliveryAddress1">
                            <input type="radio" name="addressRadio" checked />
                            <span></span>
                            <div>
                                <strong>Hardick Vermani</strong>
                                <p>B2-105, Waterbay Society, Opp. police station, Wadgaonsheri, Pune - 411036, Maharashtra</p>
                            </div>
                        </label>
                        <div class="addDelAddress1">
                            <a href="#;">Add New Address <img src="{{asset('front/images/jam_plus.svg')}}" alt="" /> </a>
                        </div>
                    </div>
                </div>
                @endif
                <!-- <div class="">
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
                            <a href="#;">Add New Address <img src="images/jam_plus.svg" alt="" /> </a>
                        </div>
                    </div>
                </div> -->

                <div class="proceedBtn">
                    <button id="proceedButton" disabled>Proceed to Pay</button>
                    <form id="razorpay-form" action="{{ route('razorpay.payment.store') }}" method="POST">
                        <input type="hidden" id="total-hidden" value="{{ $total }}" name="total" />
                        <input type="hidden" value="{{ $subTotal }}" name="subTotal" />
                        <input type="hidden" value="{{ $cartId }}" name="cartId" />
                        @csrf
                        <script id="razorpay-script" src="https://checkout.razorpay.com/v1/checkout.js"
                            data-key="{{ env('RAZORPAY_KEY') }}"
                            data-amount="{{ $total * 100 }}"
                            data-buttontext="Proceed to Pay"
                            data-name="Arogyabharat"
                            data-description="Arogya bharat"
                            data-image="{{ asset('/front/images/arogya_bharat.svg') }}"
                            data-prefill.name="test"
                            data-prefill.email="test@test.com"
                            data-theme.color="#ff7529">
                        </script>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="addressFormPop winScrollStop">
        <div class="addressFormPopMiddle">
            <div class="addressFormPopInner">
                <a href="#;"><img src="{{asset('front/images/cross.svg')}}" alt="" /> </a>
                <h4>Add New Address</h4>
                <p>Please enter pin code to get current location.</p>
                <form id="addressForm">
                    <div class="inputMainBlock fullwidth">
                        <span>House Number</span>
                        <input type="text" name="house_number" class="AnyValueVD" placeholder="004">
                        <div class="errormsg">Please enter House Number</div>
                    </div>
                    <div class="inputMainBlock fullwidth">
                        <span>Society Name</span>
                        <input type="text" name="society_name" class="AnyValueVD" placeholder="XYZ">
                        <div class="errormsg">Please enter Society Name</div>
                    </div>
                    <div class="inputMainBlock fullwidth">
                        <span>Locality</span>
                        <input type="text" name="locality" class="AnyValueVD" placeholder="XYZ">
                        <div class="errormsg">Please enter Locality</div>
                    </div>
                    <div class="inputMainBlock fullwidth">
                        <span>Landmark</span>
                        <input type="text" name="landmark" class="AnyValueVD" placeholder="XYZ">
                        <div class="errormsg">Please enter Landmark</div>
                    </div>
                    <div class="inputMainBlock fullwidth">
                        <span>Pincode</span>
                        <input type="text" name="pincode" class="AnyValueVD" placeholder="000000">
                        <div class="errormsg">Please enter Pincode</div>
                    </div>
                    <div class="inputMainBlock fullwidth">
                        <span>City</span>
                        <input type="text" name="city" class="AnyValueVD" placeholder="XYZ">
                        <div class="errormsg">Please enter City</div>
                    </div>
                    <div class="checkboxPart fullwidth">
                        <button class="submitBTN">Save Address</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="offer-apply-success" style="display:none;">
        @include('front.common.offer-success')
    </div>
    <div class="offerPop winScrollStop" id="offerModal" style="display:none;">
        <div class="offerPopMiddle">
            <div class="offerPopInner">
                <a href="#;"><img src="{{ asset('front/images/cross.svg')}}" alt="" /> </a>
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
    <script>
        $(document).ready(function() {

            $("#addressForm .submitBTN").click(function(e) {
                e.preventDefault(); // Prevent the form from submitting normally

                // Collect form data
                var formData = {
                    house_number: $("#addressForm input[name='house_number']").val(),
                    society_name: $("#addressForm input[name='society_name']").val(),
                    locality: $("#addressForm input[name='locality']").val(),
                    landmark: $("#addressForm input[name='landmark']").val(),
                    pincode: $("#addressForm input[name='pincode']").val(),
                    city: $("#addressForm input[name='city']").val(),
                    _token: '{{ csrf_token() }}' // CSRF token for Laravel
                };

                // Clear previous error messages
                $(".errormsg").hide();

                // AJAX call
                $.ajax({
                    url: '/customer/save-address', // Your endpoint to handle the request
                    type: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            // Address saved successfully, handle the UI changes
                            $('.addressFormPop').hide();
                            $('.addAddress').hide();
                            $('.deliveryAddress').show();
                            $('body').css('overflow-y', 'auto');
                        } else {
                            // Show error messages
                            if (response.status == 401) {
                                alert(response.message);
                            } else {

                                $.each(response.errors, function(key, value) {
                                    $("#addressForm input[name='" + key + "']").next('.errormsg').text(value).show();
                                });
                            }
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle any unexpected errors
                        alert('Something went wrong. Please try again later.');
                    }
                });
            });

            //based on tenure
            // Add event listener to tenure radio buttons
            $("input[name='tenure']").change(function() {
                var selectedTenure = $("input[name='tenure']:checked").val();

                // Alert the selected tenure value
                alert("Selected tenure: " + selectedTenure);

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
                    alert("Please enter a coupon code.");
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
                            alert(response.message);
                            // Perform additional actions, such as updating the cart or showing a modal
                            // $('#offerModal').hide();
                            $('.flatDicountPop').css('display', 'flex');
                        } else {
                            alert(response.message); // Display error message if any
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Something went wrong. Please try again later.');
                    }
                });
            });
        });

        $('#searchInput').on('keyup', function() {
            var query = $(this).val(); // Get the input value

            if (query.length >= 2) { // Trigger search when at least 2 characters are entered
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


        function applyOffer(couponCode) {
            $.ajax({
                url: "{{ route('applycoupon', '') }}/" + couponCode,
                type: 'GET',
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                        $('#apply-' + couponCode).hide();
                        $('#removeDiscount-' + couponCode).show();
                        $('.offer-apply-success').show();
                        $('.flatDicountPop').css('display', 'flex');
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert('Something went wrong. Please try again later.');
                }
            });
        }

        function removeOffer(couponCode) {
            $.ajax({
                url: "{{ route('removecoupon', '') }}/" + couponCode,
                type: 'GET',
                success: function(response) {
                    if (response.success) {
                        $('#apply-' + couponCode).show();
                        $('#removeDiscount-' + couponCode).hide();
                        alert(response.message);
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert('Something went wrong. Please try again later.');
                }
            });
        }

        // Initialize with the total amount from server
        let selectedProductsTotal = parseFloat(document.getElementById('total-hidden').value.replace('₹', '').trim());

        function cartItemChange(event, cartItemId, productPrice) {
            productPrice = parseFloat(productPrice); // Ensure product price is a number
            const isChecked = event.target.checked;
            const productDetailElement = document.getElementById(`product-detail-${cartItemId}`);

            if (isChecked) {
                // If checked, add the product's price to the total
                productDetailElement.style.display = 'list-item';
                selectedProductsTotal += productPrice;
            } else {
                // If unchecked, subtract the product's price from the total
                productDetailElement.style.display = 'none';
                selectedProductsTotal -= productPrice;
            }

            // Update the display and hidden field with the new total
            document.getElementById('total-display').innerText = `₹ ${selectedProductsTotal.toFixed(2)}`;
            document.getElementById('total-hidden').value = selectedProductsTotal;

            // Update Razorpay or other payment handling method with the new amount
            updateRazorpayAmount(selectedProductsTotal);

            // Enable/Disable the proceed button based on the total
            const proceedButton = document.getElementById('proceedButton');
            proceedButton.disabled = selectedProductsTotal <= 0;
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
                    alert('Something went wrong. Please try again later.');
                }
            });
        }
    </script>
</section>
@endsection('content')
@extends('front.layouts.layout')
@section('content')

    <div class="breadcrumbs">
        <div class="container">
            <ul>
                <li><a href="{{ route('home') }}">Home</a> </li>
                <li><a href="">Category</a> </li>
                <li><a href="#;">Product Details</a> </li>
            </ul>
        </div>
    </div>

    <section class="product_details">
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
            <div class="product_details_box">
                <div class="product_details_slide slide_product">
                    @if ($productDetails->images->isNotEmpty())
                        @foreach ($productDetails->images as $image)
                            @if (!empty($image->path))
                                <div class="prod_slide">
                                    <img src="{{ asset('storage/' . $image->path) }}" alt="Product Image" />
                                </div>
                            @endif
                        @endforeach
                    @else
                        <div class="prod_slide"><img src="{{ asset('storage/' . $productDetails->image) }}"
                                alt="{{ $productDetails->slug }}" /></div>
                    @endif
                    <!--<div class="prod_slide"><img src="{{ asset('front/images/wheelchair_2.png') }}" alt="" /></div>
                                                    <div class="prod_slide"><img src="{{ asset('front/images/wheelchair_2.png') }}" alt="" /></div> -->
                </div>
                <div class="product_details_data">
                    <!-- <div class="rentorpurchase"><img src="images/info-circle_svg.svg" alt="" /><p>Rent or Purchase this product now.!</p></div> -->
                    <div class="product_name_details">
                        <div class="product_details">
                            <div class="nameshare">
                                <h1>{{ $productDetails->title }}</h1>
                                <a target="_blank"
                                    href="https://wa.me/?text={{ urlencode('Check out this product: ' . $productDetails->title . ' ' . route('products.sub.category.wise', ['slug' => $productDetails->category->slug, 'subSlug' => $productDetails->slug])) }}">
                                    <img src="{{ asset('front/images/Share.svg') }}" alt="Share on WhatsApp">
                                </a>
                            </div>
                            <div class="product_description">
                                <p>{{ $productDetails->description }}</p>
                            </div>
                            <div class="productprice">
                                <h2>
                                    ₹ @indianCurrency($productDetails->our_price)
                                    <del class="original-price" style="font-size: 13px;">₹ @indianCurrency($productDetails->original_price)</del>
                                    <span class="discount"
                                        style="color: green; font-size:16px; display: inline-flex; align-items: center; gap: 5px;">(@indianCurrency($productDetails->discount_percentage)%
                                        OFF)

                                    </span>
                                </h2>

                            </div>
                            @if ($productDetails->features_specification != '')
                                <div class="features_specification">
                                    <h2>Features & Specification</h2>
                                    <ul>
                                        {!! html_entity_decode($productDetails->features_specification) !!}
                                    </ul>
                                </div>
                            @endif
                            @if ($productDetails->about_item != '')
                                <div class="features_specification">
                                    <h2>About this item</h2>
                                    <ul>
                                        {!! html_entity_decode($productDetails->about_item) !!}
                                    </ul>
                                </div>
                            @endif
                            @if ($productDetails->measurements != '')
                                <div class="features_specification">
                                    <h2>Measurements</h2>
                                    <ul>
                                        {!! html_entity_decode($productDetails->measurements) !!}
                                    </ul>
                                </div>
                            @endif
                            @if ($productDetails->usage_instructions != '')
                                <div class="features_specification">
                                    <h2>Usage instructions</h2>
                                    <ul>
                                        {!! html_entity_decode($productDetails->usage_instructions) !!}
                                    </ul>
                                </div>
                            @endif
                            @if ($productDetails->why_choose_this_product != '')
                                <div class="features_specification">
                                    <h2>Why Choose This Product</h2>
                                    <ul>
                                        {!! html_entity_decode($productDetails->why_choose_this_product) !!}
                                    </ul>
                                </div>
                            @endif
                            {{-- <div class="details">

                            </div> --}}
                        </div>
                        <div class="more_details">
                            {{-- <a href="#;">
                                <p>More Details</p><img src="images/downArrow.svg" alt="" />
                            </a> --}}
                        </div>
                        <div class="cart_buy">
                            @if (!isset($productDetails->productAttributes) || $productDetails->productAttributes->stock == 0)
                                {{-- <span style="color: red; font-weight: bold;">Out of Stock</span> --}}
                                {{-- <button type="submit" class="addtocart" onclick="toastr.error(
                                                'Product is out of stock!'
                                                );">Add to Cart</button> --}}
                                <a href="#;" class="addtocart disabled"
                                    style="background-color: #d7d7d7 !importent;color: red;">Sold out</a>
                            @else
                               <button type="button" class="addtocart" data-id="{{ $productDetails->id }}">Add to Cart</button>
                                <a href="#;" class="btn_buynow" id="buy-now-button"
                                    data-productid="{{ $productDetails->id }}">Buy Now</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <input type="hidden" id="razorpay-key" value="{{ env('RAZORPAY_KEY') }}">
    <section class="get_service_benefits">
        <div class="container">
            <div class="titlePart">
                <h4>Get Service Benefits</h4>
                <p>We prioritize our clients, understanding their unique needs and preferences.</p>
            </div>
            <div class="get_service_benefits_allbox">
                <div class="benefits_box">
                    <img src="{{ asset('front/images/Quick_delivery.svg') }}" alt="Quick_delivery" />
                    <p>Quick Delivery</p>
                </div>
                <div class="benefits_box">
                    <img src="{{ asset('front/images/getitwith.svg') }}" alt="getitwith" />
                    <p>Get it Within 5 hrs</p>
                </div>
                <div class="benefits_box">
                    <img src="{{ asset('front/images/freeinstolation.svg') }}" alt="freeinstolation" />
                    <p>Free Installation</p>
                </div>
                <div class="benefits_box">
                    <img src="{{ asset('front/images/24hours.svg') }}" alt="24hours" />
                    <p>24hrs Emergency Help</p>
                </div>
            </div>
        </div>
    </section>
    @if (isset($offerAndDiscounts) && $offerAndDiscounts->isNotEmpty())
        <section class="offer_Part">
            <div class="container">
                <div class="titlePart">
                    <h4>Offer & Discount</h4>
                    <a href="#;">View All <img src="{{ asset('front/images/orange_arrow.svg') }}" alt="orange_arrow">
                    </a>
                </div>
                <div class="rowMob">
                    <div class="offer_slider getprogressWidth arrowOnProgress">
                        @include('front.common.offer-discounts')
                    </div>
                    <div class="progressBar"></div>
                </div>
            </div>
        </section>
    @endif
    @include('front.common.recentview')

    <section class="customer_part">
        @include('front.common.happy-customer')
    </section>


    @include('front.common.faq-section')
    <script src="{{ asset('front/js/jquery.min.js') }}"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script type="application/ld+json">
        {
        "@context": "https://schema.org/",
        "@type": "Product",
        "name": "{{$productDetails->name}}",
        "image": [
          "{{url('/')}}{{ asset('storage/' . $productDetails->image) }}"
          ],
       "description": "{{$productDetails->description}}",
      "offers": {
      "@type": "Offer",
    "url": "{{ url()->current() }}",
     "priceCurrency": "INR",
     "price": "{{$productDetails->our_price}}",
     "priceValidUntil": "2027-12-31",
     "itemCondition": "https://schema.org/NewCondition",
     "availability": "https://schema.org/InStock",
     "seller": {
      "@type": "Organization",
      "name": "Aarogyaa Bharat"
    }
  }
},

        </script>
        <script>
$(document).ready(function () {
    $('.addtocart').on('click', function () {
        var productId = $(this).data('id');
        var $btn = $(this);
        $btn.prop('disabled', true).addClass('disabled');
        $.ajax({
            url: "{{ route('cart.add', ['productId' => '__ID__']) }}".replace('__ID__', productId),
            method: 'POST',
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function (response) {
                // ✅ Handle success (e.g., update cart count, show toast, etc.)
                if(response.success){
                document.getElementById('cartproductcount').innerHTML=response.cartproductcount;
                document.getElementById('text-btween-cartpopup').innerHTML=response.message;
                document.getElementById('text-btween-cartpopup').style.color='#2d5a2d';
                cartPopup();
                }else{
                document.getElementById('text-btween-cartpopup').innerHTML=response.message;
                document.getElementById('text-btween-cartpopup').style.color='red';
                cartPopup();
                }
                $btn.prop('disabled', false).removeClass('disabled');
            },
            error: function (xhr) {
                // ❌ Handle error
                $btn.prop('disabled', false).removeClass('disabled');
                document.getElementById('logoutPopup3').style.display='flex';
            }
        });
    });
});
</script>

    <script>
        $(document).ready(function() {
            $('#buy-now-button').on('click', function(e) {
                e.preventDefault();

                var productId = $(this).data('productid');
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                var razorpayKey = $('#razorpay-key').val();

                $.ajax({
                    url: `/create-order/${productId}`,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    data: {
                        amount: 50000 * 100 // Convert INR to paise
                    },
                    success: function(data) {
                        if (data.error) {
                            // if(data.error=='')
                            document.getElementById('logoutPopup3').style.display = 'flex';
                            // toastr.error(data.error);
                            return;
                        }

                        var options = {
                            "key": razorpayKey,
                            "amount": data.amount,
                            "currency": "INR",
                            "name": "Aarogyaa Bharat",
                            "description": "Purchase product {{ $productDetails->name }}: " +
                                data.amount,
                            "order_id": data.id,
                            "handler": function(response) {
                                $.ajax({
                                    url: '/verify-payment',
                                    type: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': csrfToken
                                    },
                                    data: {
                                        razorpay_payment_id: response
                                            .razorpay_payment_id,
                                        razorpay_order_id: response
                                            .razorpay_order_id,
                                        razorpay_signature: response
                                            .razorpay_signature
                                    },
                                    success: function(response) {
                                        if (response.message ===
                                            'Payment Verified') {
                                            // toastr.success(
                                            //     'Payment successful!');
                                            var form = $('<form>', {
                                                'action': "{{ route('thanks') }}",
                                                'method': 'GET'
                                            });
                                            form.append($('<input>', {
                                                'type': 'hidden',
                                                'name': 'order_id',
                                                'value': response
                                                    .order_id
                                            }));
                                            $('body').append(form);
                                            form.submit();
                                            // window.location.href = "{{ route('thanks') }}?order_id=" + response.order_id;
                                        } else {
                                            // toastr.error(
                                            //     'Payment verification failed!'
                                            //     );
                                            document.getElementById(
                                                    'logoutPopup3').style
                                                .display = 'flex';
                                        }
                                    },
                                    error: function(xhr) {
                                        // toastr.error(
                                        //     'Payment verification error: ' +
                                        //     xhr.responseJSON.error);
                                        document.getElementById(
                                                'logoutPopup3').style
                                            .display = 'flex';
                                    }
                                });
                            },
                            "prefill": {
                                "name": data.customer.name,
                                "email": data.customer.email,
                                "contact": data.customer.mobile
                            },
                            "theme": {
                                "color": "#F37254"
                            }
                        };

                        var rzp1 = new Razorpay(options);
                        rzp1.open();
                    },
                    error: function(xhr) {
                        //   document.getElementById('logoutPopup3').style.display='flex';
                        // toastr.error(xhr.responseJSON.error|| xhr.responseJSON.message || 'An error occurred.');
                        if (xhr.responseJSON.message ==
                            'Please add an address to proceed with payment.') {
                            document.getElementById('text-btween-cartpopup').innerHTML =
                                'Let’s add your address first.'
                            cartPopup();
                            localStorage.setItem('address_required', '1');
                            window.location.href = "{{ route('customers.profile') }}";


                        } else if (xhr.responseJSON.message ==
                            'Please login to proceed with payment.') {
                            window.location.href = "{{ route('login') }}"
                        } else {
                            document.getElementById('logoutPopup3').style.display = 'flex';
                        }
                    }
                });
            });
        });



        function changeTab(categoryId) {
            $('.faq_box').hide();
            $('#category_' + categoryId).show();
        }
        var faqIcons = {
            plus: "{{ asset('front/images/jam_plus.svg') }}",
            minus: "{{ asset('front/images/jam_minus.svg') }}"
        };
    </script>
@endsection('content')

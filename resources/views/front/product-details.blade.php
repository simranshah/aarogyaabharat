@extends('front.layouts.layout')
@section('content')

    <div class="breadcrumbs">
        <div class="container">
            <ul>
                <li><a href="{{ route('home') }}">Home</a> </li>
                <li><a href="{{ route('products.category') }}">Category</a> </li>
                <li><a href="#;">Product Details</a> </li>
            </ul>
        </div>
    </div>

    <section class="product_details">
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
                                alt="{{$productDetails->slug}}" /></div>
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
                                <a target="_blank" href="https://wa.me/?text={{ urlencode('Check out this product: ' .$productDetails->title . ' ' .route('products.sub.category.wise', ['slug' => $productDetails->category->slug,'subSlug'=>$productDetails->slug])) }}">
                                    <img src="{{ asset('front/images/Share.svg') }}" alt="Share on WhatsApp" >
                                </a>
                            </div>
                            <div class="product_description">
                                <p>{{ $productDetails->description }}</p>
                            </div>
                            <div class="productprice">
                                <h2>
                                    ₹ @indianCurrency($productDetails->our_price)
                                    <del class="original-price" style="font-size: 13px;">₹ @indianCurrency($productDetails->original_price)</del>
                                    <span class="discount" style="color: green; font-size:16px; display: inline-flex; align-items: center; gap: 5px;">(@indianCurrency($productDetails->discount_percentage)% OFF)
                                        
                                    </span>
                                </h2>
                                
                            </div>
                            @if($productDetails->features_specification!="")
                            <div class="features_specification">
                                <h2>Features & Specification</h2>
                                <ul>
                                    {!! html_entity_decode($productDetails->features_specification) !!}
                                </ul>
                            </div>
                            @endif
                            @if($productDetails->about_item!="")
                            <div class="features_specification">
                                <h2>About this item</h2>
                                <ul>
                                    {!! html_entity_decode($productDetails->about_item) !!}
                                </ul>
                            </div>
                            @endif
                            @if($productDetails->measurements!="")
                            <div class="features_specification">
                                <h2>Measurements</h2>
                                <ul>
                                    {!! html_entity_decode($productDetails->measurements) !!}
                                </ul>
                            </div>
                            @endif
                            @if($productDetails->usage_instructions!="")
                            <div class="features_specification">
                                <h2>Usage instructions</h2>
                                <ul>
                                    {!! html_entity_decode($productDetails->usage_instructions) !!}
                                </ul>
                            </div>
                            @endif
                            @if($productDetails->why_choose_this_product!="")
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
                                    <button type="submit" class="addtocart" onclick="toastr.error(
                                                'Product is out of stock!'
                                                );">Add to Cart</button>
                                <a href="#;" class="addtocart disabled" id="buy-now-button" style="background-color: #d7d7d7 !importent;color: red;"
                                    data-productid="{{ $productDetails->id }}">Sold out</a>
                            @else
                                <form action="{{ route('cart.add', ['productId' => $productDetails->id]) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    <button type="submit" class="addtocart">Add to Cart</button>
                                </form>
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
                <a href="#;">View All <img src="{{ asset('front/images/orange_arrow.svg') }}" alt="orange_arrow"> </a>
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
          "@context": "https://schema.org",
          "@type": "BreadcrumbList",
          "itemListElement": [
            {
              "@type": "ListItem",
              "position": 1,
              "name": "Home",
              "item": "{{ url('/') }}"
            },
            {
              "@type": "ListItem",
              "position": 2,
              "name": "{{$productDetails->category->name }}",
              "item": "{{ url('/categories/' .$productDetails->category->slug) }}"
            },
            {
              "@type": "ListItem",
              "position": 3,
              "name": "{{ $productDetails->name }}",
              "item": "{{ url()->current() }}"
            }
          ]
        }
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
                            toastr.error(data.error);
                            return;
                        }

                        var options = {
                            "key": razorpayKey,
                            "amount": data.amount,
                            "currency": "INR",
                            "name": "My Shop",
                            "description": "Purchase Description",
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
                                            toastr.success(
                                                'Payment successful!');
                                                window.location.href = "{{ route('thanks') }}";
                                        } else {
                                            toastr.error(
                                                'Payment verification failed!'
                                                );
                                        }
                                    },
                                    error: function(xhr) {
                                        toastr.error(
                                            'Payment verification error: ' +
                                            xhr.responseJSON.error);
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

                        toastr.error(xhr.responseJSON.error|| xhr.responseJSON.message || 'An error occurred.');
                        if( xhr.responseJSON.message=='Please add an address to proceed with payment.') {
                            setTimeout(() => {
                                window.location.href = "{{ route('customers.profile') }}";
                            }, 2000);
                            
                        }else if(xhr.responseJSON.message=='Please login to proceed with payment.') {
                            $('.LoginPop').show();
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

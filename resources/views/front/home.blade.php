@extends('front.layouts.layout')
@section('content')

<!-- @include('front.common.welcome-message') -->
@php
    $isMobile = request()->header('User-Agent') && preg_match('/mobile|android|iphone|ipad|phone/i', request()->header('User-Agent'));
@endphp

<section class="bannerPArt" style="margin-top: 8px">
    <div class="container">
        <div class="bannerSlider getprogressWidth arrowOnProgress">
            @if($isMobile)
                @foreach($mobileBannerImages as $banner)
                    <div class="bannerBlock">
                        <a href="{{ $banner->link }}" target="_blank">
                            <img class="bannerImage"
                                 src="{{ asset('storage/' . $banner->image) }}" 
                                 data-mobile="{{ asset('storage/' . $banner->image) }}"
                                 data-desktop="{{ asset('storage/' . ($banner->desktop_image ?? $banner->image)) }}"
                                 alt="Mobile Banner">
                        </a>    
                    </div>
                @endforeach
            @else
                @foreach($bannerImages as $banner)
                    <div class="bannerBlock">
                        <a href="{{ $banner->link }}" target="_blank">
                            <img class="bannerImage"
                                 src="{{ asset('storage/' . $banner->image) }}" 
                                 data-mobile="{{ asset('storage/' . ($banner->mobile_image ?? $banner->image)) }}"
                                 data-desktop="{{ asset('storage/' . $banner->image) }}"
                                 alt="Desktop Banner">
                        </a>    
                    </div>
                @endforeach
            @endif
        </div> 
        <div class="progressBar"></div>
    </div>
</section>

{{-- <section class="bannerPArt">
    <div class="container">
        <div class="bannerSlider getprogressWidth arrowOnProgress">
            @if(isset($bannerImages))
            @foreach($bannerImages as $banner)
                    <div class="bannerBlock">
                    <a href="{{$banner->link}}" target="_blank">
                        <img src="{{ asset('storage/' . $banner->image) }}" alt="Banner Image">
                    </a>    
                    </div>
            @endforeach
            @endif
        </div> 
        <div class="progressBar"></div>
    </div>
</section> --}}
<!-- caterory part  -->
<section class="category_part">
    <div class="container">
       <div class="titlePart">
            <h4>Category</h4>
            <a href="{{route('products.category')}}">View All <img src="{{ asset('front/images/orange_arrow.svg')}}" alt="orange_arrow"> </a>
        </div>
        <div class="category_all_box catgory_slider getprogressWidth arrowOnProgress">
            @foreach ($categories as $category)
                <div class="category_box">
                <a href="{{ route('products.category.wise', ['slug' => $category->slug]) }}" style="text-decoration: none;"> 
                    <div class="category_icon">
                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" />

                    </div>
                    <p style="color: black;">{{ $category->name }}</p>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="progressBar"></div>
        </div>
    </div>
</section>
@include('front.home-products.flash-sale')

@include('front.home-products.top-deals-products')

@include('front.home-products.top-pick for-you')

@include('front.home-products.newly-added')
@include('front.home-products.best-selling-products')
@include('front.home-products.product-for-you')

@include('front.home-products.sports-healthcare-more')
@if(isset($offerAndDiscounts)&& $offerAndDiscounts->isNotEmpty())
 <section class="offer_Part part-offer" id="offer_Part">
    <div class="container">
        <div class="titlePart">
            <h4>Special Offers & Discounts</h4>
            <!-- <a href="{{route('products')}}">View All <img src="{{ asset('front/images/orange_arrow.svg')}}" alt=""> </a> -->
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

<!-- product part  -->



<!-- <section class="product_Part">
    <div class="container">
        <div class="titlePart">
            <h4>Newly Product</h4>
            <a href="#;">View All <img src="images/orange_arrow.svg" alt=""> </a>
        </div>
        <div class="rowMob">
            <div class="product_slider getprogressWidth">
                <div class="product_slider_padd">
                    <div class="product_slider_block">
                        <div class="imagePart">
                            <img src="images/wheelchair_1.png" alt="" >
                        </div>
                        <h5>Wheelchair</h5>
                        <p>Dummy text for offer of product goes here just for placeholder..</p>
                        <strong>₹ 1200</strong><i>/ Per week</i>
                        <a href="#;">View Details <img src="images/orange_arrow.svg" alt=""> </a>
                    </div>
                </div>
                <div class="product_slider_padd">
                    <div class="product_slider_block">
                        <div class="imagePart">
                            <img src="images/wheelchair_1.png" alt="" >
                        </div>
                        <h5>Wheelchair</h5>
                        <p>Dummy text for offer of product goes here just for placeholder..</p>
                        <strong>₹ 1200</strong><i>/ Per week</i>
                        <a href="#;">View Details <img src="images/orange_arrow.svg" alt=""> </a>
                    </div>
                </div>
                <div class="product_slider_padd">
                    <div class="product_slider_block">
                        <div class="imagePart">
                            <img src="images/wheelchair_1.png" alt="" >
                        </div>
                        <h5>Wheelchair</h5>
                        <p>Dummy text for offer of product goes here just for placeholder..</p>
                        <strong>₹ 1200</strong><i>/ Per week</i>
                        <a href="#;">View Details <img src="images/orange_arrow.svg" alt=""> </a>
                    </div>
                </div>
                <div class="product_slider_padd">
                    <div class="product_slider_block">
                        <div class="imagePart">
                            <img src="images/wheelchair_1.png" alt="" >
                        </div>
                        <h5>Wheelchair</h5>
                        <p>Dummy text for offer of product goes here just for placeholder..</p>
                        <strong>₹ 1200</strong><i>/ Per week</i>
                        <a href="#;">View Details <img src="images/orange_arrow.svg" alt=""> </a>
                    </div>
                </div>
                <div class="product_slider_padd">
                    <div class="product_slider_block">
                        <div class="imagePart">
                            <img src="images/wheelchair_1.png" alt="" >
                        </div>
                        <h5>Wheelchair</h5>
                        <p>Dummy text for offer of product goes here just for placeholder..</p>
                        <strong>₹ 1200</strong><i>/ Per week</i>
                        <a href="#;">View Details <img src="images/orange_arrow.svg" alt=""> </a>
                    </div>
                </div>
                <div class="product_slider_padd">
                    <div class="product_slider_block">
                        <div class="imagePart">
                            <img src="images/wheelchair_1.png" alt="" >
                        </div>
                        <h5>Wheelchair</h5>
                        <p>Dummy text for offer of product goes here just for placeholder..</p>
                        <strong>₹ 1200</strong><i>/ Per week</i>
                        <a href="#;">View Details <img src="images/orange_arrow.svg" alt=""> </a>
                    </div>
                </div>
            </div>
            <div class="progressBar"></div>
        </div>
    </div>
</section> -->

<section class="raise_query">
    <div class="container">
    <a href="{{ route('raise.query')}}">
        <div class="raise_query_box">
            <div class="rise_text_box">
                 <img src="{{ asset('front/images/raise.png')}}" alt="raise" />
                <div class="rise_text_line">
                    <h4>Raise Query</h4>
                    <p>You can request anything by single click.</p>
                </div>
            </div>
        </div>
    </a>   
    </div>
</section>
<section class="why_arogya_bharat">
    <div class="container">
       <div class="titlePart">
            <h4>Why Aarogyaa Bharat?</h4>
            <p>We prioritize our clients, understanding their unique needs and preferences.</p>
        </div>
        <div class="why_arogya_bharat_all_box">
            <div class="why_arogya_bharat_box">
                <div class="arogya_icon"><img src="{{asset('front/images/Client_Centric_Approach.svg')}}" alt="Client_Centric_Approach" /></div>
                <div class="why_arogya_bharat_text">
                    <h3>Client-Centric Approach</h3>
                    <p>We prioritize our clients, understanding their unique needs and preferences. </p>
                </div>
            </div>
            <div class="why_arogya_bharat_box">
                <div class="arogya_icon"><img src="{{asset('front/images/well_equipped.svg')}}" alt="well_equipped" /></div>
                <div class="why_arogya_bharat_text">
                    <h3>Well-Equipped Infrastructural Setup</h3>
                    <p>We prioritize our clients, understanding their unique needs and preferences. </p>
                </div>
            </div>
            <div class="why_arogya_bharat_box">
                <div class="arogya_icon"><img src="{{asset('front/images/skilled_team.svg')}}" alt="skilled_team" /></div>
                <div class="why_arogya_bharat_text">
                    <h3>Skilled Team of Professionals</h3>
                    <p>Our success is attributed to a team of skilled and dedicated professionals </p>
                </div>
            </div>
            <div class="why_arogya_bharat_box">
                <div class="arogya_icon"><img src="{{asset('front/images/wide_distribution_network.svg')}}" alt="wide_distribution_network" /></div>
                <div class="why_arogya_bharat_text">
                    <h3>Wide Distribution Network</h3>
                    <p>With a wide-reaching distribution network, we are capable of delivering our products </p>
                </div>
            </div>
            <div class="why_arogya_bharat_box">
                <div class="arogya_icon"><img src="{{asset('front/images/Work-Ethics.svg')}}" alt="Work-Ethics" /></div>
                <div class="why_arogya_bharat_text">
                    <h3>Ethical Business Practices</h3>
                    <p>Integrity and ethics are at the core of our business operations. </p>
                </div>
            </div>
            <div class="why_arogya_bharat_box">
                <div class="arogya_icon"><img src="{{asset('front/images/delivery-van.svg')}}" alt="delivery-van" /></div>
                <div class="why_arogya_bharat_text">
                    <h3>Timely Delivery</h3>
                    <p>We understand the importance of timely deliveries in the healthcare industry.</p>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="customer_part">
    @include('front.common.happy-customer')
</section>

<!-- blog part  -->
@if(!$isMobile)
<section class="our_blog">
    <div class="container">
       <div class="titlePart2">
            <h4>Our Blogs</h4> 
        </div>
        <div class="our_blog_all_box">
            <div class="row18">
                @foreach ($blogs as $blog)
                    <div class="our_blog_box">
                        <div class="blog_image">
                        <a href="{{ route('blog.details', ['slug' => $blog->slug]) }}">
                            <img src="{{ asset('storage/' . $blog->images->first()->path) }}" alt="{{ $blog->images->first()->alt }}" />
                        </a>   
                        </div>
                        <div class="blog_text" style="height: 128px;">
                            <div class="text_one">
                            <a href="{{ route('blog.details', ['slug' => $blog->slug]) }}">
                                <h2>{{ $blog->title }}</h2>
                            </a>    
                                <p>{{ Str::limit($blog->description, 102) }}</p>
                                {{-- <p>{{ $blog->description }}</p> --}}
                            </div>
                            <div class="blog_tag_name">
                                <ul>
                                    <li class="tagBox"><p>{{ $blog->tagname  }}</p></li>
                                    <li class="blogdate">
                                        <img src="{{ asset('front/images/calendar.svg') }}" alt="calendar" />
                                        <p>{{ $blog->created_at->format('d/m/Y') }}</p>
                                    </li>
                                    <li class="blogview">
                                        <img src="{{ asset('front/images/carbon_view.svg') }}" alt="carbon_view" />
                                        <p>{{ $blog->views}}</p>
                                    </li>
                                    <li><a href="https://wa.me/?text={{ urlencode('Check out this blog: ' . $blog->title . ' ' . route('blog.details', $blog->slug)) }}"><img src="{{ asset('front/images/ri_share-line.svg') }}" alt="{{$blog->title}}"></a></li>
                                </ul>
                                <a href="{{ route('blog.details', ['slug' => $blog->slug]) }}" class="blogreadnow">Read Now</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="read_more_blogs">
            <a href="{{ route('blogs')}}">
                <p>Read More Blogs</p>
                <img src="{{ asset('front/images/downArrow.svg') }}" alt="downArrow" />
            </a>
        </div>
        </div>
    </div>
</section>
@endif
<!-- <section class="our_blog">
    <div class="container">
       <div class="titlePart2">
            <h4>Our Blogs</h4> 
        </div>
        <div class="our_blog_all_box">
            <div class="row18">
                <div class="our_blog_box">
                    <div class="blog_image"><img src="images/bed.png" alt="" /></div>
                    <div class="blog_text">
                        <div class="text_one"><h2>Medical Bed</h2><p>Kros samuktig neturen, herer of it isherer ann uppaskae. Mikok coko invertering hemissade Fredrik Åkesson...</p></div>
                        <div class="blog_tag_name">
                            <ul>
                                <li class="tagBox"><p>Tagename</p></li>
                                <li class="blogdate"><img src="images/calendar.svg" alt="" /><p>04/02/24</p></li>
                                <li class="blogview"><img src="images/carbon_view.svg" alt="" /><p>424</p></li>
                                <li><a href="#;"><img src="images/ri_share-line.svg" alt="" /></a></li>
                            </ul>
                            <a href="#;" class="blogreadnow">Read Now</a>
                        </div>
                    </div>
                </div>
                <div class="our_blog_box">
                    <div class="blog_image"><img src="images/bed.png" alt="" /></div>
                    <div class="blog_text">
                        <div class="text_one"><h2>Medical Bed</h2><p>Kros samuktig neturen, herer of it isherer ann uppaskae. Mikok coko invertering hemissade Fredrik Åkesson...</p></div>
                        <div class="blog_tag_name">
                            <ul>
                                <li class="tagBox"><p>Tagename</p></li>
                                <li class="blogdate"><img src="images/calendar.svg" alt="" /><p>04/02/24</p></li>
                                <li class="blogview"><img src="images/carbon_view.svg" alt="" /><p>424</p></li>
                                <li><a href="#;"><img src="images/ri_share-line.svg" alt="" /></a></li>
                            </ul>
                            <a href="#;" class="blogreadnow">Read Now</a>
                        </div>
                    </div>
                </div>
                <div class="our_blog_box">
                    <div class="blog_image"><img src="images/bed.png" alt="" /></div>
                    <div class="blog_text">
                        <div class="text_one"><h2>Medical Bed</h2><p>Kros samuktig neturen, herer of it isherer ann uppaskae. Mikok coko invertering hemissade Fredrik Åkesson...</p></div>
                        <div class="blog_tag_name">
                            <ul>
                                <li class="tagBox"><p>Tagename</p></li>
                                <li class="blogdate"><img src="images/calendar.svg" alt="" /><p>04/02/24</p></li>
                                <li class="blogview"><img src="images/carbon_view.svg" alt="" /><p>424</p></li>
                                <li><a href="#;"><img src="images/ri_share-line.svg" alt="" /></a></li>
                            </ul>
                            <a href="#;" class="blogreadnow">Read Now</a>
                        </div>
                    </div>
                </div>
                <div class="our_blog_box">
                    <div class="blog_image"><img src="images/bed.png" alt="" /></div>
                    <div class="blog_text">
                        <div class="text_one"><h2>Medical Bed</h2><p>Kros samuktig neturen, herer of it isherer ann uppaskae. Mikok coko invertering hemissade Fredrik Åkesson...</p></div>
                        <div class="blog_tag_name">
                            <ul>
                                <li class="tagBox"><p>Tagename</p></li>
                                <li class="blogdate"><img src="images/calendar.svg" alt="" /><p>04/02/24</p></li>
                                <li class="blogview"><img src="images/carbon_view.svg" alt="" /><p>424</p></li>
                                <li><a href="#;"><img src="images/ri_share-line.svg" alt="" /></a></li>
                            </ul>
                            <a href="#;" class="blogreadnow">Read Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="read_more_blogs"><a href="#;"><p>Read More Blogs</p><img src="images/downArrow.svg" alt="" /></a></div>
    </div>
</section> -->

@if(isset($partners))
<section class="partners_we_work_with">
    <!-- <div class="container">
       <div class="titlePart">
            <h4>Partners - we work with</h4>
            <p>A wheelchair is a chair fitted with wheels. The device comes in variations allowing either manual propulsion by the seated occupant turning the rear wheels by hand or electric propulsion by motors electric propulsion by motors.</p>
        </div>
        <div class="partners_we_work_logo">
            <img src="{{asset('front/images/Frame_1.png')}}" alt="" />
            <img src="{{asset('front/images/Frame_2.png')}}" alt="" />
            <img src="{{asset('front/images/Frame_3.png')}}" alt="" />
            <img src="{{asset('front/images/Frame_4.png')}}" alt="" />
            <img src="{{asset('front/images/Frame_5.png')}}" alt="" />
            <img src="{{asset('front/images/Frame_6.png')}}" alt="" />
        </div>
    </div> -->
    <div class="container">
       <div class="titlePart">
            <h4>{{ $partners->cms->title ?? 'Partners - We Work With'}}</h4>
            <p>{!! strip_tags($partners->cms->content) ?? 'Ensuring quality healthcare access, we work with renowned medical institutions to provide trusted and seamless medical equipment solutions across India' !!}</p>
        </div>
        <div class="partners_we_work_logo">
        @foreach($partners->cms->images as $img)
            <img src="{{ asset('storage/' . $img->path) }}" alt="image"/>
        @endforeach
            <!-- <img src="{{asset('front/images/Frame_1.png')}}" alt="" />
            <img src="{{asset('front/images/Frame_2.png')}}" alt="" />
            <img src="{{asset('front/images/Frame_3.png')}}" alt="" />
            <img src="{{asset('front/images/Frame_4.png')}}" alt="" />
            <img src="{{asset('front/images/Frame_5.png')}}" alt="" />
            <img src="{{asset('front/images/Frame_6.png')}}" alt="" /> -->
        </div>
    </div>
</section>
@endif
@if (isset($aboutAarogyaBharat)  && !empty($aboutAarogyaBharat) && isset($aboutAarogyaBharat->cms) && !empty($aboutAarogyaBharat->cms))
    
<section class="about_aarogya_bharat">
    <div class="container">
        {{-- <div class="about_aarogya_title"><h2>About Aarogya Bharat</h2></div> --}}
        <div class="about_aarogya_title"><h1>{{ $aboutAarogyaBharat->cms->title }}</h1></div>
        <div class="about_aarogya_bharat_text">
            <div id="content" class="short-content">
                {!! $aboutAarogyaBharat->cms->content !!}
            </div>
            <a id="toggleButton" class="readmore-aarogyaabharat">Read More..</a>
            {{-- <p>A wheelchair is a chair fitted with wheels. The device comes in variations allowing either manual propulsion by the seated occupant turning the rear wheels by hand or electric propulsion by motors.A wheelchair is a chair fitted with wheels. The device comes in variations allowing either manual propulsion by the seated occupant turning the rear wheels by hand or electric propulsion by motors.</p>
            <p>A wheelchair is a chair fitted with wheels. The device comes in variations allowing either manual propulsion by the seated occupant turning the rear wheels by hand or electric propulsion by motors. A wheelchair is a chair fitted with wheels. The device comes in variations allowing either manual propulsion by the seated occupant turning the rear wheels by hand or electric propulsion by motors <a href="#;">Read More..</a></p> --}}
        </div>
    </div>
</section>
@endif
<script src="{{ asset('front/js/jquery.min.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const copyButtons = document.querySelectorAll('.copy-code');
        copyButtons.forEach(button => {
            button.addEventListener('click', function () {
                const code = this.getAttribute('data-code');
                const tempInput = document.createElement('input');
                document.body.appendChild(tempInput);
                tempInput.value = code;
                tempInput.select();
                tempInput.setSelectionRange(0, 99999);
                document.execCommand('copy');
                document.body.removeChild(tempInput);
                toastr.success('Offer code copied');
            });
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
        let content = document.getElementById("content");
        let button = document.getElementById("toggleButton");

        // Store original content
        let fullContent = content.innerHTML;
        let shortContent = fullContent.substring(0, 500) + '...'; // Adjust the length as needed

        // Initially show only a short version
        content.innerHTML = shortContent;
        let expanded = false;

        button.addEventListener("click", function () {
            if (expanded) {
                content.innerHTML = shortContent;
                button.innerText = "Read More";
            } else {
                content.innerHTML = fullContent;
                button.innerText = "Read Less";
            }
            expanded = !expanded;
        });
    });
</script>
@endsection('content')

@extends('front.layouts.layout')
@section('content')

<div class="breadcrumbs">
    <div class="container">
        <ul>
            <li><a href="{{ route('home') }}">Home</a> </li>
            <li><a href="">Product Cateogry</a> </li>
        </ul>
    </div>    
</div>


<section class="productSlidePart">
    <div class="container">
        @foreach ($categoriesAndProducts as $category)
            <div class="titlePart2">
                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->slug}}" />
                <h4>{{ $category->name }}</h4>
                <a href="{{route('products')}}">View All <img src="{{asset('front/images/orange_arrow.svg')}}" alt="orange_arrow"> </a>
            </div>
            <div class="rowMob">
                <div class="product_slider2 getprogressWidth arrowOnProgress"> 
                    @foreach ($category->products as $product)
                        <div class="product_slider2padd">
                            <div class="product_slider2block">
                                <div class="product_inner">
                                    <a href="{{ route('products.sub.category.wise', ['slug' => $category->slug,'subSlug'=>$product->slug]) }}">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" />
                                    </a>
                                </div>
                                <p>
                                    <a href="{{ route('products.sub.category.wise', ['slug' => $category->slug,'subSlug'=>$product->slug]) }}">{{ $product->name }}</a> 
                                </p>
                                <strong>
                                    ₹ @indianCurrency($product->our_price) 
                                     <del class="original-price">₹ @indianCurrency($product->original_price)</del> 
                                     <span class="discount"> @indianCurrency($product->discount_percentage)% OFF</span>
                                </strong>
                            </div> 
                        </div>
                    @endforeach
                </div>
                <div class="progressBar"></div>
            </div>
        @endforeach
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

@endsection
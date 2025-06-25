@extends('front.layouts.layout')
@section('content')
@php
    $isMobile = request()->header('User-Agent') && preg_match('/mobile|android|iphone|ipad|phone/i', request()->header('User-Agent'));
@endphp
<div class="breadcrumbs">
    <div class="container">
        <ul>
            <li><a href="{{ route('home') }}">Home</a> </li>
            <li><a href="">Product Cateogry</a> </li>
        </ul>
    </div>    
</div>

<section class="category_part">
    <div class="container">
       <div class="titlePart">
            <h4>Category</h4>
            <a href="">View All <img src="{{ asset('front/images/orange_arrow.svg')}}" alt="orange_arrow"> </a>
        </div>
        <div class="category_all_box catgory_slider getprogressWidth">
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
<section class="productSlidePart">
    <div class="container">
        @foreach ($categoriesAndProducts as $category)
            <div class="titlePart2">
                <img src="{{ asset('storage/' . $category->image) }}" alt="" />
                <h1>{{ $category->name }}</h1>
                <a href="{{route('products')}}">View All <img src="{{asset('front/images/orange_arrow.svg')}}" alt=""> </a>
            </div>
            <div class="rowMob">
                <div class="product_slider3  "> 
                    @foreach ($category->products as $product)
                        <div class="product_slider3padd">
                            <div class="product_slider3block">
                                <div class="product_inner" style="height: 60%;">
                                    <a href="{{ route('products.sub.category.wise', ['slug' => $category->slug,'subSlug'=>$product->slug]) }}">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" />
                                    </a>
                                </div>
                                <p style="height: 20%;">
                                    <a href="{{ route('products.sub.category.wise', ['slug' => $category->slug,'subSlug'=>$product->slug]) }}">
                                        @if($isMobile)
                                            {{ Str::limit($product->name,22 ) }}
                                        @endif
                                        @if(!$isMobile)
                                            {{ Str::limit($product->name, 60) }}
                                        @endif
                                    </a> 
                                </p>
                                <strong style="height: 20%;">
                                    ₹ @indianCurrency($product->our_price) 
                                     <del class="original-price">₹ @indianCurrency($product->original_price)</del> 
                                     <span class="discount"> @indianCurrency($product->discount_percentage)% OFF</span>
                                     <div  style="color: #F2A602;he
                                     margin-top: 5px;">                       
                                     <a href="{{ route('products.sub.category.wise', ['slug' => $category->slug,'subSlug'=>$product->slug]) }}" style="ofloat: right; font-size: 16px;font-family: 'Nunito-Bold';  color: #F2A602; margin-top: 5px;;" >View Details</a> 
                                 </div>
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
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "CollectionPage",
  "name": "{{ $category->name }}",
  "url": "{{ url()->current() }}",
  "mainEntity": [
    @foreach ($category->products as $index => $product)
    {
      "@type": "Product",
      "name": "{{ $product->name }}",
      "image": "{{ url('/') }}{{ asset('storage/' . $product->image) }}",
      "url": "{{ route('products.sub.category.wise', ['slug' => $category->slug, 'subSlug' => $product->slug]) }}",
      "offers": {
        "@type": "Offer",
        "priceCurrency": "INR",
        "price": "{{ $product->our_price }}",
        "availability": "https://schema.org/InStock"
      }
    }@if(!$loop->last),@endif
    @endforeach
  ]
}
</script>

@endsection
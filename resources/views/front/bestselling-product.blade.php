@extends('front.layouts.layout')
@section('content')
@php
    $isMobile = request()->header('User-Agent') && preg_match('/mobile|android|iphone|ipad|phone/i', request()->header('User-Agent'));
@endphp
<div class="breadcrumbs">
    <div class="container">
        <ul>
            <li><a href="{{ route('home') }}">Home</a> </li>
            <li><a href="{{ route('products.category') }}">Best Selling Products</a> </li>
        </ul>
    </div>    
</div>
<section class="productSlidePart">
    <div class="container">
            <div class="titlePart2">
                <img src="{{ asset('front/images/best-sell-product.png')}}" alt="best-sell-product" />
                <h1>Best Selling Products</h1> 
            </div>
            <div class="rowMob">
                <div class="product_slider3  "> 
                    @foreach ($products as $product)
                        <div class="product_slider3padd">
                            <div class="product_slider3block">
                                <div class="product_inner" style="height: 65%;">
                                    <a href="{{ route('products.sub.category.wise', ['slug' =>$product->category->slug,'subSlug'=>$product->slug]) }}">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" />
                                    </a>
                                </div>
                                <p style="height: 14%;">
                                    <a href="{{ route('products.sub.category.wise', ['slug' => $product->category->slug,'subSlug'=>$product->slug]) }}">
                                        @if($isMobile)
                                            {{ Str::limit($product->name,20 ) }}
                                        @endif
                                        @if(!$isMobile)
                                            {{ Str::limit($product->name, 60) }}
                                        @endif
                                    </a> 
                                </p>
                                <strong style="height: 21%;">
                                    ₹ @indianCurrency($product->our_price) 
                                     <del class="original-price" style="font-size: 13px;">₹ @indianCurrency($product->original_price)</del> 
                                     <span class="discount" style="color: green;"> @indianCurrency($product->discount_percentage)% OFF</span>
                                     <div  style="color: #F2A602;he
                                     margin-top: 5px;">                       
                                     <a href="{{ route('products.sub.category.wise', ['slug' => $product->category->slug,'subSlug'=>$product->slug]) }}" style="ofloat: right; font-size: 16px;font-family: 'Nunito-Bold';  color: #F2A602; margin-top: 5px;;" >View Details</a> 
                                 </div>
                                </strong>
                               
                            </div> 
                        </div>
                    @endforeach
                </div>
                <div class="progressBar"></div>
            </div>
    </div>
</section>


<section class="customer_part">
@include('front.common.happy-customer') 
</section>

@endsection
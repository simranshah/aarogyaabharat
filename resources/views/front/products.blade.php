@extends('front.layouts.layout')
@section('content')
    <div class="breadcrumbs">
        <div class="container">
            <ul>
                <li><a href="{{ route('home') }}">Home</a> </li>
                <li><a href="{{ route('products.category') }}">Cateogry</a> </li>
                <li><a href="{{ route('products') }}">Product Listing</a> </li>
            </ul>
        </div>
    </div>

    <div class="tabSec">
        <div class="container">
            <div class="row18">
                @foreach ($categoriesAndProducts as $category)
                    <div class="tabPadd">
                        <a href="#" data-category-id="{{ $category->id }}" class="{{ $loop->first ? 'active' : '' }}">
                            <div>
                                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->alt }}" />
                            </div>
                            <p>{{ $category->name }}</p>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="progressBar2">
                <div></div>
            </div>
        </div>
    </div>
    <section class="product_Part">
        <div class="container">
            <div class="row18">
                <div id="productList" class="productList1">
                    @foreach ($categoriesAndProducts as $category)
                        <div class="category-{{ $category->id }}" style="display: none;">
                            @foreach ($category->products as $product)
                                <div class="product_slider_padd">
                                    <div class="product_slider_block">
                                        <div class="imagePart">
                                            <a href="{{ route('products.sub.category.wise', ['slug' => $category->slug,'subSlug'=>$product->slug]) }}">
                                                <img src="{{ asset('storage/' . $product->image) }}"
                                                    alt="{{ $product->name }}">
                                            </a>
                                        </div>
                                        <h5>
                                            <span> <a href="{{ route('products.sub.category.wise', ['slug' => $category->slug,'subSlug'=>$product->slug]) }}">{{ $product->name }}</a> </span> 
                                            {{-- <a target="_blank" href="https://wa.me/?text={{ urlencode('Check out this product: ' . $product->title . ' ' . route('products.detail', $product->slug)) }}">
                                                <img src="{{ asset('front/images/Share.svg') }}" alt="Share on WhatsApp">
                                            </a> --}}
                                        </h5>
                                        <p>{{ $product->description }}</p>
                                        <div class="discounted-product-price">
                                            @if (isset($product->discount_percentage) && $product->discount_percentage > 0)
                                                <del class="original-price">₹  @indianCurrency($product->price) </del>
                                                {{-- Original price with strikethrough --}}
                                                <strong class="discounted-price">₹
                                                     @indianCurrency($product->price - ($product->price * $product->discount_percentage) / 100) </strong>
                                                {{-- Discounted price --}}
                                                <span
                                                    class="discount-percentage">( @indianCurrency($product->discount_percentage)%OFF)</span> {{-- Discount percentage --}}
                                            @else
                                                <strong class="discounted-price">₹
                                                    @indianCurrency($product->price)</strong> {{-- Price without discount --}}
                                            @endif

                                            <div class="view-details">
                                                <a href="{{ route('products.sub.category.wise', ['slug' => $category->slug,'subSlug'=>$product->slug]) }}"
                                                    class="view-details-link">View Details</a>
                                                    <a style="margin-left: 193px;" target="_blank" href="https://wa.me/?text={{ urlencode('Check out this product: ' . $product->title . ' ' . route('products.sub.category.wise', ['slug' => $category->slug,'subSlug'=>$product->slug])) }}">
                                                        <img src="{{ asset('front/images/Share.svg') }}" alt="Share on WhatsApp" style="height: 22px;">
                                                    </a>
                                            </div>
                                        </div>
                                        {{-- <strong>₹ {{ $product->price }}</strong> --}}
                                        {{-- <a href="{{ route('products.detail', ['slug' => $product->slug]) }}">View Details <img src="{{ asset('front/images/orange_arrow.svg') }}" alt=""> </a> --}}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="customer_part">
        @include('front.common.happy-customer')
    </section>


    <!-- <section class="customer_part">
        <div class="container">
            <div class="titlePart">
                <h4>Happy Customers..!</h4>
                <a href="#;">View All <img src="{{ asset('front/images/orange_arrow.svg') }}" alt=""> </a>
            </div>
            <div class="rowMob">
                <div class="customerSlider getprogressWidth arrowOnProgress">
                    <div class="customerSlider_padd">
                        <div class="customerSlider_block">
                            <p>Kros samuktig och neturen, heteropaskade. Mikok höraniv eller mus i fuvåfar. Faliga mälig astronde. Bens </p>
                            <strong>Piyush Gohil</strong>
                            <ul>
                                <li><a href="#;"><img src="images/fill_star.svg" alt="" /> </a> </li>
                                <li><a href="#;"><img src="images/fill_star.svg" alt="" /> </a> </li>
                                <li><a href="#;"><img src="images/fill_star.svg" alt="" /> </a> </li>
                                <li><a href="#;"><img src="images/fill_star.svg" alt="" /> </a> </li>
                                <li><a href="#;"><img src="images/empty_star.svg" alt="" /> </a> </li>
                            </ul>
                            <i>4.5</i>
                        </div>
                    </div>
                    <div class="customerSlider_padd">
                        <div class="customerSlider_block">
                            <p>Kros samuktig och neturen, heteropaskade. Mikok höraniv eller mus i fuvåfar. Faliga mälig astronde. Bens </p>
                            <strong>Piyush Gohil</strong>
                            <ul>
                                <li><a href="#;"><img src="images/fill_star.svg" alt="" /> </a> </li>
                                <li><a href="#;"><img src="images/fill_star.svg" alt="" /> </a> </li>
                                <li><a href="#;"><img src="images/fill_star.svg" alt="" /> </a> </li>
                                <li><a href="#;"><img src="images/fill_star.svg" alt="" /> </a> </li>
                                <li><a href="#;"><img src="images/empty_star.svg" alt="" /> </a> </li>
                            </ul>
                            <i>4.5</i>
                        </div>
                    </div>
                    <div class="customerSlider_padd">
                        <div class="customerSlider_block">
                            <p>Kros samuktig och neturen, heteropaskade. Mikok höraniv eller mus i fuvåfar. Faliga mälig astronde. Bens </p>
                            <strong>Piyush Gohil</strong>
                            <ul>
                                <li><a href="#;"><img src="images/fill_star.svg" alt="" /> </a> </li>
                                <li><a href="#;"><img src="images/fill_star.svg" alt="" /> </a> </li>
                                <li><a href="#;"><img src="images/fill_star.svg" alt="" /> </a> </li>
                                <li><a href="#;"><img src="images/fill_star.svg" alt="" /> </a> </li>
                                <li><a href="#;"><img src="images/empty_star.svg" alt="" /> </a> </li>
                            </ul>
                            <i>4.5</i>
                        </div>
                    </div>
                    <div class="customerSlider_padd">
                        <div class="customerSlider_block">
                            <p>Kros samuktig och neturen, heteropaskade. Mikok höraniv eller mus i fuvåfar. Faliga mälig astronde. Bens </p>
                            <strong>Piyush Gohil</strong>
                            <ul>
                                <li><a href="#;"><img src="images/fill_star.svg" alt="" /> </a> </li>
                                <li><a href="#;"><img src="images/fill_star.svg" alt="" /> </a> </li>
                                <li><a href="#;"><img src="images/fill_star.svg" alt="" /> </a> </li>
                                <li><a href="#;"><img src="images/fill_star.svg" alt="" /> </a> </li>
                                <li><a href="#;"><img src="images/empty_star.svg" alt="" /> </a> </li>
                            </ul>
                            <i>4.5</i>
                        </div>
                    </div>
                    <div class="customerSlider_padd">
                        <div class="customerSlider_block">
                            <p>Kros samuktig och neturen, heteropaskade. Mikok höraniv eller mus i fuvåfar. Faliga mälig astronde. Bens </p>
                            <strong>Piyush Gohil</strong>
                            <ul>
                                <li><a href="#;"><img src="images/fill_star.svg" alt="" /> </a> </li>
                                <li><a href="#;"><img src="images/fill_star.svg" alt="" /> </a> </li>
                                <li><a href="#;"><img src="images/fill_star.svg" alt="" /> </a> </li>
                                <li><a href="#;"><img src="images/fill_star.svg" alt="" /> </a> </li>
                                <li><a href="#;"><img src="images/empty_star.svg" alt="" /> </a> </li>
                            </ul>
                            <i>4.5</i>
                        </div>
                    </div>
                    <div class="customerSlider_padd">
                        <div class="customerSlider_block">
                            <p>Kros samuktig och neturen, heteropaskade. Mikok höraniv eller mus i fuvåfar. Faliga mälig astronde. Bens </p>
                            <strong>Piyush Gohil</strong>
                            <ul>
                                <li><a href="#;"><img src="images/fill_star.svg" alt="" /> </a> </li>
                                <li><a href="#;"><img src="images/fill_star.svg" alt="" /> </a> </li>
                                <li><a href="#;"><img src="images/fill_star.svg" alt="" /> </a> </li>
                                <li><a href="#;"><img src="images/fill_star.svg" alt="" /> </a> </li>
                                <li><a href="#;"><img src="images/empty_star.svg" alt="" /> </a> </li>
                            </ul>
                            <i>4.5</i>
                        </div>
                    </div>
                </div>
                <div class="progressBar"></div>
            </div>
        </div>
    </section> -->

    @include('front.common.recentview')
    <!-- <section class="productSlidePart">
        <div class="container">
            <div class="titlePart2">
                <h4>Recent Viewed</h4>
            </div>
            <div class="rowMob">
                <div class="product_slider2 getprogressWidth arrowOnProgress">
                    @foreach ($recentViewedProducts as $product)
    <div class="product_slider2padd">
                            <div class="product_slider2block">
                                <div class="product_inner">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" />
                                </div>
                                <p>{{ $product->name }}</p>
                                <strong>₹ {{ $product->price }}</strong>
                            </div>
                        </div>
    @endforeach
                </div>
                <div class="progressBar"></div>
            </div>
        </div>
    </section> -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.tabPadd a');
            const productLists = document.querySelectorAll('#productList > div');

            tabs.forEach(tab => {
                tab.addEventListener('click', function(e) {
                    e.preventDefault();

                    tabs.forEach(t => t.classList.remove('active'));
                    productLists.forEach(pl => pl.style.display = 'none');

                    this.classList.add('active');
                    const categoryId = this.getAttribute('data-category-id');
                    document.querySelector(`.category-${categoryId}`).style.display = 'block';
                });
            });

            // Show the first category's products by default
            document.querySelector('.tabPadd a.active').click();
        });
    </script>
    <script>
    function formatIndianCurrency(number) {
        if (number === null || number === undefined) return '';
        number = number.toString().replace(/[^0-9]/g, ''); // Ensure it's numeric
    
        let lastThree = number.substring(number.length - 3);
        let otherNumbers = number.substring(0, number.length - 3);
        if (otherNumbers !== '') {
            lastThree = ',' + lastThree;
        }
    
        return otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ',') + lastThree;
    }
    </script>
@endsection('content')

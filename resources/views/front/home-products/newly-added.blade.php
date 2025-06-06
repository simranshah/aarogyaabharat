<section class="product_Part">
    <div class="container">
        <div class="titlePart">
            <h4>Newly Added Products</h4>
            <a href="{{ route('products.new.arrivals')}}">View All <img src="{{ asset('front/images/orange_arrow.svg') }}" alt="View All"> </a>
        </div>
        <div class="rowMob">
            <div class="product_slider getprogressWidth arrowOnProgress">
                @foreach ($products as $product)
                    <div class="product_slider_padd">
                        <div class="product_slider_block">
                            <div class="imagePart">
                                <a href="{{ route('products.sub.category.wise', ['slug' => $product->category->slug,'subSlug'=>$product->slug]) }}">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                </a>   
                            </div>
                            <h5>
                                <span> <a href="{{ route('products.sub.category.wise', ['slug' => $product->category->slug,'subSlug'=>$product->slug]) }}">{{ $product->name }}</a> </span> 
                            </h5>
                            {{-- <p>{{ $product->description }}</p> --}}
                            <div class="discounted-product-price">
                                @if (isset($product->discount_percentage) && $product->discount_percentage > 0)
                                    <del class="original-price">₹  @indianCurrency($product->original_price) </del>
                                    {{-- Original price with strikethrough --}}
                                    <strong class="discounted-price">₹
                                         @indianCurrency($product->our_price) </strong>
                                    {{-- Discounted price --}}
                                    <span class="discount-percentage">( @indianCurrency($product->discount_percentage)%OFF)</span> {{-- Discount percentage --}}
                                @else
                                    <strong class="discounted-price">₹
                                        @indianCurrency($product->price)</strong> {{-- Price without discount --}}
                                @endif

                                <div class="view-details">
                                    {{-- <img src="{{ asset('front/images/orange_arrow.svg') }}" alt=""> --}}
                                    <a href="{{ route('products.sub.category.wise', ['slug' => $product->category->slug,'subSlug'=>$product->slug]) }}"
                                        class="view-details-link">View Details</a>
                                    {{-- </img> --}}
                                </div>
                            </div>
                            {{-- <strong>₹ {{ number_format($product->price, 0) }}</strong>
                            <i>/ Per week</i>
                            <a href="{{ route('products.detail', ['slug' => $product->slug]) }}">View Details <img src="{{ asset('front/images/orange_arrow.svg') }}" alt=""> </a> --}}
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="progressBar"></div>
        </div>
    </div>
</section>
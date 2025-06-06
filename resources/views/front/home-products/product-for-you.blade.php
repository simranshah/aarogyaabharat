@if(isset($productForYou) && !empty($productForYou))
<section class="product_Part">
    <div class="container">
        <div class="titlePart">
            <h4>Products For You</h4>
            <a href="{{ route('products.for.you')}}">View All <img src="{{ asset('front/images/orange_arrow.svg') }}" alt="View All"> </a>
        </div>
        <div class="rowMob">
            <div class="product_slider getprogressWidth arrowOnProgress">
                @foreach ($productForYou as $product)
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
                            <div class="discounted-product-price">
                                @if (isset($product->discount_percentage) && $product->discount_percentage > 0)
                                    <del class="original-price">₹  @indianCurrency($product->original_price) </del>
                                    <strong class="discounted-price">₹
                                         @indianCurrency($product->our_price) </strong>
                                    <span class="discount-percentage">( @indianCurrency($product->discount_percentage)%OFF)</span> 
                                @else
                                    <strong class="discounted-price">₹
                                        @indianCurrency($product->price)</strong> 
                                @endif

                                <div class="view-details">
                                    <a href="{{ route('products.sub.category.wise', ['slug' => $product->category->slug,'subSlug'=>$product->slug]) }}"
                                        class="view-details-link">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="progressBar"></div>
        </div>
    </div>
</section>
@endif
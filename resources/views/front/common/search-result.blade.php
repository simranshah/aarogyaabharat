@if ($products->count() > 0)
                    @foreach ($products as $product)
                    <a href="{{ route('products.sub.category.wise', ['slug' => $product->category->slug,'subSlug'=>$product->slug]) }}">
                        <div class="product_box" style="">
                            <div class="product_img">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" />
                            </div>
                            <div class="productbox_text" >
                                
                                 <a href="{{ route('products.sub.category.wise', ['slug' => $product->category->slug,'subSlug'=>$product->slug]) }}">
                                    <h2>{{ $product->name }}</h2>
                                 </a>
                                 {{-- <p>{{ $product->description }}</p> --}}
                                <div class="priceshare">
                                    <h3>₹ @indianCurrency($product->our_price)</h3>
                                    {{-- <a target="_blank"
                                        href="https://wa.me/?text={{ urlencode('Check out this product: ' . $product->title . ' ' . route('products.sub.category.wise', ['slug' => $product->category->slug,'subSlug'=>$product->slug])) }}">
                                        <img src="{{ asset('front/images/Share.svg') }}" alt="Share on WhatsApp">
                                        {{-- <img src="{{ asset('front/images/ri_share-line.svg') }}" alt="" /> --}}
                                    {{-- </a> --}}
                                </div>
                            
                            </div>
                        </div>
                    </a>
                    @endforeach
                @else
                    <p>No products found.</p>
                @endif
                <div class="read_more_blogs" onclick="getmoreSearchResult('{{$query}}','{{$offset}}');"><a href="#;">
                        <p>Load More</p><img src="{{ asset('front/images/radix-icons_reload.svg') }}" alt="icons_reload">
                    </a></div>
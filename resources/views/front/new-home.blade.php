@extends('front.layouts2.layout2')
@section('content')
    @php
        $isMobile =
            request()->header('User-Agent') &&
            preg_match('/mobile|android|iphone|ipad|phone/i', request()->header('User-Agent'));
    @endphp
          <div class="frame-8">
          @if(!$isMobile)

            <div style="align-self: stretch; padding-top: 70px; padding-left: 50px; padding-right: 50px; justify-content: flex-start; align-items: flex-start; gap: 18px; display: inline-flex">
            @else

              <div style="align-self: stretch; padding-top: 50px;  justify-content: flex-start; align-items: flex-start; gap: 18px; display: inline-flex">

            @endif
            @if(!$isMobile)

                <div class="list-container">
                      @foreach ($categories as $category)
                      
                  <div class="list-item category-hover-wrapper" style="position: relative;">
                    <div class="avatar-container">
                      <a onclick="dataLayer.push({ event: 'category_click', category_name: '{{ $category->name }}' });" href="{{ route('products.category.wise', ['slug' => $category->slug]) }}" style="text-decoration: none;">  <img class="avatar1" src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}"  /></a>
                    </div>
                    <div class="content">
                      <a onclick="dataLayer.push({ event: 'category_click', category_name: '{{ $category->name }}' });" href="{{ route('products.category.wise', ['slug' => $category->slug]) }}" style="text-decoration: none;">  <div class="text">{{ $category->name }}</div></a>
                    </div>
                  
                    @if($category->subcategories && $category->subcategories->count())
                      {{-- <div class="subcategory-popup">
                        <div class="row" style="display: flex; flex-wrap: nowrap;">
                          @php
                            $subs = $category->subcategories->take(6)->values();
                            $col1 = $subs->slice(0, 2);
                            $col2 = $subs->slice(2, 2);
                            $col3 = $subs->slice(4, 2);
                          @endphp
                          <div class="col-md-4" style="flex: 0 0 33%; padding: 0 15px; margin-bottom: 20px;">
                            @foreach($col1 as $sub)
                              <div style="font-weight: bold; margin-bottom: 8px;">
                                <a href="{{ route('products.category.wise', ['slug' => $category->slug]) }}?subcategory={{ $sub->slug }}">
                                  {{ Str::limit($sub->name, 20) }}
                                </a>
                              </div>
                              <ul style="padding-left: 18px;">
                                @foreach($sub->products->take(3) as $product)
                                  <li>
                                    <a href="{{ route('products.sub.category.wise', ['slug' => $category->slug, 'subSlug' => $product->slug]) }}">
                                      {{ Str::limit($product->name, 30) }}
                                    </a>
                                      </li>
                                    @endforeach
                              </ul>
                            @endforeach
                          </div>
                          <div class="col-md-4" style="flex: 0 0 33%; padding: 0 15px; margin-bottom: 20px;">
                            @foreach($col2 as $sub)
                              <div style="font-weight: bold; margin-bottom: 8px;">
                                <a href="{{ route('products.category.wise', ['slug' => $category->slug]) }}?subcategory={{ $sub->slug }}">
                                  {{ Str::limit($sub->name, 20) }}
                                </a>
                              </div>
                              <ul style="padding-left: 18px;">
                                @foreach($sub->products->take(3) as $product)
                                  <li>
                                    <a href="{{ route('products.sub.category.wise', ['slug' => $category->slug, 'subSlug' => $product->slug]) }}">
                                      {{ Str::limit($product->name, 30) }}
                                    </a>
                                  </li>
                                @endforeach
                              </ul>
                            @endforeach
                          </div>
                          <div class="col-md-4" style="flex: 0 0 33%; padding: 0 15px; margin-bottom: 20px;">
                            @foreach($col3 as $sub)
                              <div style="font-weight: bold; margin-bottom: 8px;">
                                <a href="{{ route('products.category.wise', ['slug' => $category->slug]) }}?subcategory={{ $sub->slug }}">
                                  {{ Str::limit($sub->name, 20) }}
                                </a>
                              </div>
                              <ul style="padding-left: 18px;">
                                @foreach($sub->products->take(3) as $product)
                                  <li>
                                    <a href="{{ route('products.sub.category.wise', ['slug' => $category->slug, 'subSlug' => $product->slug]) }}">
                                      {{ Str::limit($product->name, 30) }}
                                    </a>
                                  </li>
                                @endforeach
                              </ul>
                            @endforeach
                          </div>
                        </div>
                      </div> --}}
                    @endif
                  </div>
                @endforeach
                </div>
@endif

                <div class="banner-container" id="bannerpart">
  @if ($isMobile)
                    @foreach ($mobileBannerImages as $banner)
                        @if ($loop->first)

                  <div class="bannerBlock">
                    <a href="{{ $banner->link }}" target="_blank">
                      <img width="100%" class="bannerImage" src="{{ asset('storage/' . $banner->image) }}"
                                        alt="Mobile Banner" loading="lazy">
                      </a>
                    </div>
                        @endif
                    @endforeach
                @else
                    @foreach ($bannerImages as $banner)
                        @if ($loop->first)

                    <div class="bannerBlock">
                      <a href="{{ $banner->link }}" target="_blank">
                        <img width="100%" class="bannerImage" src="{{ asset('storage/' . $banner->image) }}"
                                        alt="Desktop Banner" loading="lazy">
                        </a>
                      </div>
                        @endif
                    @endforeach
                    @endif
                    </div>
                  </div>
                  <div class="div-2">
                    <div class="frame-9" style="justify-content: space-between;">
                      <div class="text-wrapper-5">Shop By Category</div>
                      <a href="{{ url('/products-list') }}">
                      <div class="frame-10">
                        <div class="text-wrapper-6">View All</div>
                        <img src="/front/images/orange_arrow.svg" alt="orange_arrow">
                      </div>
                    </a>
                    </div>
                    <div class="frame-11 categories">
             @foreach ($subCategoriess as $subCategoriess)

                      <div class="category-hover-wrapper" style="position: relative; display: inline-block;">
                        <a href="{{ route('products.category.wise', ['slug' => $subCategoriess->category->slug]) }}?subcategory={{ $subCategoriess->name }}" style="text-decoration: none;">
                          <div class="frame-12">
                            <div class="image-wrapper">
                              <img class="image" src="{{ asset('storage/' . $subCategoriess->image) }}" alt="{{ $subCategoriess->name }}" />
                            </div>
                            {{-- <div class="text-wrapper-7">{{ $subCategoriess->name }}</div> --}}
                          </div>
                        </a>
                      
                      </div>
            @endforeach
       
                    </div>
                  </div>
                  <div class="div-2">
                    <div class="frame-14">
                      <div class="text-wrapper-8">New Arrivals</div>
                      <a href="{{ url('/products-list?tag=is_new') }}">
                      <div class="frame-10">
                        <div class="text-wrapper-6">View All</div>
                        <img src="/front/images/orange_arrow.svg" alt="orange_arrow">
                      </div>
                    </a>
                    </div>
                    <div class="frame-15 products">
             @foreach ($products as $product)

                      <div class="frame-16">
                        <div class="overlap-group-wrapper">
                          <div class="overlap">
                            <a onclick="dataLayer.push({
                              event: 'product_card_click',
                              product_name: '{{ $product->name }}',
                              category_name: '{{ $product->category->name }}'
                            });" href="{{ route('products.sub.category.wise', ['slug' => $product->category->slug,'subSlug'=>$product->slug]) }}">
                              <a onclick="dataLayer.push({
                                event: 'product_card_click',
                                product_name: '{{ $product->name }}',
                                category_name: '{{ $product->category->name }}'
                              });" href="{{ route('products.sub.category.wise', ['slug' => $product->category->slug,'subSlug'=>$product->slug]) }}">
                                <div class="rectangle">
                                  <img style="height: 90%;width: 90%;" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" />
                                </div>
                              </a>
                            </a>
                            @if($product->best_selling_products)
                            <div class="group-2">
                              <div class="overlap-group">
                                <div class="text-wrapper-9">Best Seller</div>
                              </div>
                            </div>
                            @elseif($product->top_deals)
                            <div class="group-2">
                              <div class="overlap-group top-deals-bg">
                                <div class="text-wrapper-9">Top Deals</div>
                              </div>
                            </div>
                            @endif
                          </div>
                        </div>
                        <div class="frame-17">
                          <div class="frame-wrapper">
                            <div class="wheel-chair-hashtag-wrapper">
                              <a onclick="dataLayer.push({
                                event: 'product_card_click',
                                product_name: '{{ $product->name }}',
                                category_name: '{{ $product->category->name }}'
                              });" href="{{ route('products.sub.category.wise', ['slug' => $product->category->slug,'subSlug'=>$product->slug]) }}">
                                <p class="wheel-chair-hashtag">
                      @if($isMobile)
                      {{ Str::limit($product->name, 40) }}
                      @else
                      {{ Str::limit($product->name,50) }}
                      @endif
                    </p>
                              </a>
                            </div>
                          </div>
                          <div class="frame-18">
                            <div class="frame-19">
                              <div class="frame-20">
                                <div class="frame-21">
                                  <div class="text-wrapper-11">₹ @indianCurrency($product->our_price)</div>
                                  <div class="text-wrapper-12">₹ @indianCurrency($product->original_price)</div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="frame-9">
                            <div class="frame-22">
                              <div class="text-wrapper-13">@indianCurrency($product->discount_percentage) % OFF</div>
                            </div>
                            <div class="frame-23">
                              <div class="frame-24">
                                @if (
                                  $product->productAttributes->stock > 0)
                                <svg
                                  xmlns="http://www.w3.org/2000/svg" width="10" height="14" viewBox="0 0 10 14" fill="none">
                                  <path d="M8.94377 7.02453L5.64575 5.11307L7.30837 1.12293C7.36639 1.00442 7.39339 0.873133 7.38686 0.741345C7.38032 0.609557 7.34046 0.481581 7.27101 0.369392C7.20155 0.257203 7.10476 0.164468 6.98971 0.0998659C6.87466 0.0352635 6.7451 0.000904968 6.61315 5.51437e-06C6.43776 -0.000654732 6.2673 0.0579921 6.12945 0.166423L6.07501 0.213082L0.242625 5.73441C0.154947 5.81767 0.0878507 5.9202 0.046644 6.03388C0.00543737 6.14756 -0.0087485 6.26926 0.00520861 6.38937C0.0191657 6.50947 0.0608829 6.62469 0.127059 6.72588C0.193236 6.82708 0.282055 6.91149 0.38649 6.97243L3.68529 8.88545L2.00323 12.9215C1.93385 13.0861 1.92333 13.2696 1.97344 13.4411C2.02355 13.6126 2.13123 13.7615 2.27835 13.8629C2.42546 13.9643 2.60301 14.0118 2.78109 13.9976C2.95917 13.9833 3.1269 13.9081 3.25602 13.7847L9.08841 8.26178C9.1759 8.17845 9.24282 8.07593 9.28387 7.9623C9.32493 7.84867 9.33899 7.72705 9.32496 7.60705C9.31094 7.48704 9.26919 7.37195 9.20304 7.27085C9.13688 7.16976 9.04812 7.08543 8.94377 7.02453Z" fill="#F24F67"/>
                                </svg>
                                <div class="text-wrapper-14">
                                  Get it {{ \Carbon\Carbon::now()->addDays(7)->format('M d') }}
                              </div>
                              @else
                              <div class="text-wrapper-14" style="color: red;">
                                Sold out
                            </div>
                              @endif
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="frame-25">
                          <div class="frame-26">
                            <div class="text-wrapper-15 addtocart" onclick="dataLayer.push({
       event: 'add_to_cart_click',
       product_name: '{{ $product->name }}',
       product_id: '{{ $product->id }}',
       value: '{{ $product->our_price }}',
       category_name: '{{ $product->category->name }}'
     });" data-id="{{ $product->id }}">Add to cart</div>
                          </div>
                        </div>
                      </div>
            @endforeach

                    </div>
                  </div>
                  @if (isset($offerAndDiscounts) && $offerAndDiscounts->isNotEmpty())
                  <div class="div-3">
                    <div class="frame-27">
                      <div class="text-wrapper-5">Everyone Buying This</div>
                      <div class="frame-10">
                        <div class="text-wrapper-6">View All</div>
                        <img src="/front/images/orange_arrow.svg" alt="orange_arrow">
                      </div>
                    </div>
                    <div class="frame-9 everyonebuying" data-count="{{ $offerAndDiscounts->count() }}">
                      @foreach($offerAndDiscounts as $offer)
                      <div class="frame-28">
                        <img class="offer-image-home"
                        src="{{ Storage::url($offer->image) }}" alt="offer">
                        </div>
                        @endforeach
                        
                            </div>
                            </div>
                        @endif
        {{--
                        <div class="div-4">
                          <div class="frame-9">
                            <div class="text-wrapper-8">Offer &amp; Discount</div>
                            <div class="frame-10">
                              <div class="text-wrapper-6">View All</div>
                              <svg
                                xmlns="http://www.w3.org/2000/svg" width="23" height="12" viewBox="0 0 23 12" fill="none">
                                <path d="M22.3564 4.93504L17.8577 0.440593C17.5754 0.158486 17.1924 0 16.793 0C16.3937 0 16.0107 0.158486 15.7284 0.440593C15.446 0.7227 15.2873 1.10532 15.2873 1.50428C15.2873 1.90324 15.446 2.28586 15.7284 2.56796L17.6778 4.50057H1.49957C1.10186 4.50057 0.720436 4.65841 0.439213 4.93937C0.15799 5.22033 0 5.60139 0 5.99872C0 6.39606 0.15799 6.77712 0.439213 7.05807C0.720436 7.33903 1.10186 7.49687 1.49957 7.49687H17.6778L15.7284 9.42948C15.5878 9.56875 15.4762 9.73445 15.4001 9.91701C15.324 10.0996 15.2848 10.2954 15.2848 10.4932C15.2848 10.6909 15.324 10.8868 15.4001 11.0693C15.4762 11.2519 15.5878 11.4176 15.7284 11.5569C15.8678 11.6973 16.0336 11.8087 16.2163 11.8848C16.3991 11.9608 16.5951 12 16.793 12C16.991 12 17.187 11.9608 17.3697 11.8848C17.5525 11.8087 17.7183 11.6973 17.8577 11.5569L22.3564 7.06241C22.497 6.92314 22.6085 6.75744 22.6847 6.57488C22.7608 6.39231 22.8 6.1965 22.8 5.99872C22.8 5.80095 22.7608 5.60513 22.6847 5.42257C22.6085 5.24001 22.497 5.07431 22.3564 4.93504Z" fill="#F2A602"/>
                              </svg>
                            </div>
                          </div>
                          <div class="frame-38">
                            <img src="{{ asset('front/images/Discount_section.png') }}" alt="">
                            </div>
                          </div> --}}
                          @if (isset($homecareproducts) && $homecareproducts->isNotEmpty())
                          <div class="div-3" style="gap:0px">
                            <div class="frame-27">
                              <div class="text-wrapper-26">Home Care</div>
                              <a href="{{ url('/categories/home-care') }}">
                              <div class="frame-10">
                                <div class="text-wrapper-6">View All</div>
                                <img src="/front/images/orange_arrow.svg" alt="orange_arrow">
                              </div>
                            </a>
                            </div>
                            <div class="frame-43">
                              <div class="frame-44 home-care-products">
                @foreach ($homecareproducts as $product)
                {{-- @foreach ($item->products as $product) --}}

                                <div class="frame-45">
                                  <div class="frame-46">
                                    <a href="{{ route('products.category.wise', ['slug' =>$product->category->slug]) }}?subcategory={{ $product->name }}">
                                      <div class="wheelchair-wrapper">
                                        <img class="wheelchair-2" src="{{ asset('storage/' . $product->image_1) }}" />
                                      </div>
                                    </a>
                                  </div>
                                  <div class="frame-47">
                                    <div class="frame-48">
                                      <a href="{{ route('products.category.wise', ['slug' =>$product->category->slug]) }}?subcategory={{ $product->name }}">
                                        <div class="frame-49">
                                          <div class="text-wrapper-27"> {{ Str::limit($product->name, 40) }}</div>
                                          <div class="text-wrapper-28">Explore Now</div>
                                        </div>
                                      </a>
                                    </div>
                                  </div>
                                </div>
                 {{-- @endforeach --}}
                @endforeach
              {{--
                                <img class="frame-50" src="https://c.animaapp.com/mciusnbpgZSJMg/img/frame-1707486596.svg" /> --}}

                              </div>
                            </div>
                          </div>
                          @endif
                          @if (isset($medicalequipmentproducts) && $medicalequipmentproducts->isNotEmpty())
                          <div class="div-3" >
                            <div class="frame-27">
                              <div class="text-wrapper-26">Medical Equipment</div>
                              <a href="{{ url('/categories/medical-equipment') }}">
                              <div class="frame-10">
                                <div class="text-wrapper-6">View All</div>
                                <img src="/front/images/orange_arrow.svg" alt="orange_arrow">
                              </div>
                            </a>
                            </div>
                            <div class="frame-43 ">
                              <div class="frame-44 medical-equipment-products">
                @foreach ($medicalequipmentproducts as $product)
                {{-- @foreach ($item->products as $product) --}}

                <div class="frame-45">
                  <div class="frame-46">
                    <a href="{{ route('products.category.wise', ['slug' =>$product->category->slug]) }}?subcategory={{ $product->name }}">
                      <div class="wheelchair-wrapper">
                        <img class="wheelchair-2" src="{{ asset('storage/' . $product->image_1) }}" />
                      </div>
                    </a>
                  </div>
                  <div class="frame-47">
                    <div class="frame-48">
                      <a href="{{ route('products.category.wise', ['slug' =>$product->category->slug]) }}?subcategory={{ $product->name }}">
                        <div class="frame-49">
                          <div class="text-wrapper-27"> {{ Str::limit($product->name, 40) }}</div>
                          <div class="text-wrapper-28">Explore Now</div>
                        </div>
                      </a>
                    </div>
                  </div>
                </div>
                 {{-- @endforeach --}}
                @endforeach
              {{--
                                <img class="frame-50" src="https://c.animaapp.com/mciusnbpgZSJMg/img/frame-1707486596.svg" /> --}}

                              </div>
                            </div>
                          </div>
                          @endif
                          <div class="div-2">
                            <div class="frame-14">
                              <div class="text-wrapper-8">Flash Sale</div>
                              <a href="{{ url('/products-list?tag=flash_sale') }}">
                              <div class="frame-10">
                                <div class="text-wrapper-6">View All</div>
                                <img src="/front/images/orange_arrow.svg" alt="orange_arrow">
                              </div>
                            </a>
                            </div>

                            <div class="frame-15">
             @foreach ($flashSaleProducts as $product)

                              <div class="frame-16">
                                <div class="overlap-group-wrapper">
                                  <div class="overlap">
                                      <a onclick="dataLayer.push({
                                        event: 'product_card_click',
                                        product_name: '{{ $product->name }}',
                                        category_name: '{{ $product->category->name }}'
                                      });" href="{{ route('products.sub.category.wise', ['slug' => $product->category->slug,'subSlug'=>$product->slug]) }}">
                                      <div class="rectangle">
                                        <img style="height: 90%;width: 90%;" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" />
                                      </div>
                                    </a>
                                    @if($product->best_selling_products)
                            <div class="group-2">
                              <div class="overlap-group">
                                <div class="text-wrapper-9">Best Seller</div>
                              </div>
                            </div>
                            @elseif($product->top_deals)
                            <div class="group-2" >
                              <div class="overlap-group top-deals-bg">
                                <div class="text-wrapper-9">Top Deals</div>
                              </div>
                            </div>
                            @endif
                                  </div>
                                </div>
                                <div class="frame-17">
                                  <div class="frame-wrapper">
                                    <div class="wheel-chair-hashtag-wrapper">
                                      <a onclick="dataLayer.push({
                                        event: 'product_card_click',
                                        product_name: '{{ $product->name }}',
                                        category_name: '{{ $product->category->name }}'
                                      });" href="{{ route('products.sub.category.wise', ['slug' => $product->category->slug,'subSlug'=>$product->slug]) }}">
                                        <p class="wheel-chair-hashtag">
                                          @if($isMobile)
                                          {{ Str::limit($product->name, 40) }}
                                          @else
                                          {{ Str::limit($product->name,50) }}
                                          @endif
                    </p>
                                      </a>
                                    </div>
                                  </div>
                                  <div class="frame-18">
                                    <div class="frame-19">
                                      <div class="frame-20">
                                        <div class="frame-21">
                                          <div class="text-wrapper-11">₹ @indianCurrency($product->our_price)</div>
                                          <div class="text-wrapper-12">₹ @indianCurrency($product->original_price)</div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="frame-9">
                                    <div class="frame-22">
                                      <div class="text-wrapper-13">@indianCurrency($product->discount_percentage) % OFF</div>
                                    </div>
                                    <div class="frame-23">
                                      <div class="frame-24">
                                        @if (
                                           $product->productAttributes->stock > 0)
                                        <svg
                                          xmlns="http://www.w3.org/2000/svg" width="10" height="14" viewBox="0 0 10 14" fill="none">
                                          <path d="M8.94377 7.02453L5.64575 5.11307L7.30837 1.12293C7.36639 1.00442 7.39339 0.873133 7.38686 0.741345C7.38032 0.609557 7.34046 0.481581 7.27101 0.369392C7.20155 0.257203 7.10476 0.164468 6.98971 0.0998659C6.87466 0.0352635 6.7451 0.000904968 6.61315 5.51437e-06C6.43776 -0.000654732 6.2673 0.0579921 6.12945 0.166423L6.07501 0.213082L0.242625 5.73441C0.154947 5.81767 0.0878507 5.9202 0.046644 6.03388C0.00543737 6.14756 -0.0087485 6.26926 0.00520861 6.38937C0.0191657 6.50947 0.0608829 6.62469 0.127059 6.72588C0.193236 6.82708 0.282055 6.91149 0.38649 6.97243L3.68529 8.88545L2.00323 12.9215C1.93385 13.0861 1.92333 13.2696 1.97344 13.4411C2.02355 13.6126 2.13123 13.7615 2.27835 13.8629C2.42546 13.9643 2.60301 14.0118 2.78109 13.9976C2.95917 13.9833 3.1269 13.9081 3.25602 13.7847L9.08841 8.26178C9.1759 8.17845 9.24282 8.07593 9.28387 7.9623C9.32493 7.84867 9.33899 7.72705 9.32496 7.60705C9.31094 7.48704 9.26919 7.37195 9.20304 7.27085C9.13688 7.16976 9.04812 7.08543 8.94377 7.02453Z" fill="#F24F67"/>
                                        </svg>
                                        <div class="text-wrapper-14">
                                          Get it {{ \Carbon\Carbon::now()->addDays(7)->format('M d') }}
                                      </div>
                                      @else
                                      <div class="text-wrapper-14" style="color: red;">
                                        Sold out
                                    </div>
                                      @endif
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="frame-25">
                                  <div class="frame-26">
                                    <div class="text-wrapper-15 addtocart" data-id="{{ $product->id }}">Add to cart</div>
                                  </div>
                                </div>
                              </div>
            @endforeach

                            </div>
                          </div>
        @if(!$isMobile)

                          <div class="raise-query-2">
                            <div class="frame-54" style="background: #D9D7F0;">
                              <div class="flowbite-wallet">
                                <img src="{{ asset('front/images/wallet.png') }}" alt="wallet">
                                </div>
                                <div class="frame-55">
                                  <div class="frame-56">
                                    <p class="text-wrapper-29">Make medical equipment affordable for all.</p>
                                  </div>
                                </div>
                              </div>
                              <div class="frame-54" style="background: linear-gradient(135deg, #B7ED60, #23D8A1);">
                                <div class="flowbite-wallet">
                                    <img src="{{ asset('front/images/smart.svg') }}" alt="smart">
                                    </div>
                                <div class="frame-55">
                                  <div class="frame-56">
                                    <p class="text-wrapper-29">Enabling modern care with smart health tools.</p>
                                  </div>
                                </div>
                              </div>
                              <div class="frame-54" style="background: linear-gradient(90deg, #fada63, #fca591);">
                                <svg
                                  xmlns="http://www.w3.org/2000/svg" width="55" height="55" viewBox="0 0 55 55" fill="none">
                                  <path d="M38.9584 41.2499C36.4147 41.2499 34.3751 43.2895 34.3751 45.8332C34.3751 47.0488 34.858 48.2146 35.7175 49.0742C36.577 49.9337 37.7428 50.4166 38.9584 50.4166C40.174 50.4166 41.3398 49.9337 42.1993 49.0742C43.0589 48.2146 43.5417 47.0488 43.5417 45.8332C43.5417 44.6177 43.0589 43.4519 42.1993 42.5923C41.3398 41.7328 40.174 41.2499 38.9584 41.2499ZM2.29175 4.58325V9.16658H6.87508L15.1251 26.5603L12.0084 32.1749C11.6647 32.8166 11.4584 33.5728 11.4584 34.3749C11.4584 35.5905 11.9413 36.7563 12.8008 37.6158C13.6604 38.4754 14.8262 38.9582 16.0417 38.9582H43.5417V34.3749H17.0042C16.8523 34.3749 16.7066 34.3146 16.5991 34.2071C16.4917 34.0997 16.4313 33.9539 16.4313 33.802C16.4313 33.6874 16.4542 33.5958 16.5001 33.527L18.5626 29.7916H35.6355C37.3542 29.7916 38.8667 28.8291 39.6459 27.4312L47.8501 12.6041C48.0105 12.2374 48.1251 11.8478 48.1251 11.4583C48.1251 10.8505 47.8836 10.2676 47.4539 9.8378C47.0241 9.40803 46.4412 9.16658 45.8334 9.16658H11.9397L9.7855 4.58325M16.0417 41.2499C13.498 41.2499 11.4584 43.2895 11.4584 45.8332C11.4584 47.0488 11.9413 48.2146 12.8008 49.0742C13.6604 49.9337 14.8262 50.4166 16.0417 50.4166C17.2573 50.4166 18.4231 49.9337 19.2827 49.0742C20.1422 48.2146 20.6251 47.0488 20.6251 45.8332C20.6251 44.6177 20.1422 43.4519 19.2827 42.5923C18.4231 41.7328 17.2573 41.2499 16.0417 41.2499Z" fill="black"/>
                                </svg>
                                <div class="frame-55">
                                  <div class="frame-56">
                                    <p class="text-wrapper-29">Deliver healthcare tools across all India.</p>
                                  </div>
                                </div>
                              </div>
                              <div class="frame-54" style="background: linear-gradient(90deg, #f5b7c6, #fcd6e2);">
                                <svg
                                  xmlns="http://www.w3.org/2000/svg" width="55" height="55" viewBox="0 0 55 55" fill="none">
                                  <path d="M4.5835 25.2084C4.5835 12.5515 14.8433 2.29175 27.5002 2.29175C40.157 2.29175 50.4168 12.5515 50.4168 25.2084V37.0197C50.4168 40.7917 47.1627 43.5417 43.5418 43.5417H36.6668V25.2084H45.8335C45.8335 20.3461 43.902 15.683 40.4638 12.2448C37.0256 8.80662 32.3625 6.87508 27.5002 6.87508C22.6379 6.87508 17.9747 8.80662 14.5365 12.2448C11.0984 15.683 9.16683 20.3461 9.16683 25.2084H18.3335V43.5417H13.8945C14.1486 44.5258 14.7225 45.3975 15.5261 46.0197C16.3296 46.642 17.3172 46.9795 18.3335 46.9792H21.9177C22.6418 45.9411 23.845 45.2605 25.2085 45.2605H29.7918C30.8555 45.2605 31.8755 45.683 32.6276 46.4351C33.3797 47.1872 33.8022 48.2073 33.8022 49.2709C33.8022 50.3345 33.3797 51.3546 32.6276 52.1067C31.8755 52.8588 30.8555 53.2813 29.7918 53.2813H25.2085C23.845 53.2813 22.6418 52.6007 21.9177 51.5626H18.3335C16.037 51.5629 13.8241 50.7011 12.1326 49.1479C10.441 47.5948 9.39411 45.4632 9.19891 43.1751C6.58641 42.3111 4.5835 39.9805 4.5835 37.022V25.2084Z" fill="black"/>
                                </svg>
                                <div class="frame-55">
                                  <div class="frame-56">
                                    <div class="text-wrapper-29">Support families, clinics with essential equipment.</div>
                                  </div>
                                </div>
                              </div>

                            </div>
        @endif
        @if (isset($brandsWithProducts) && $brandsWithProducts->isNotEmpty())
                            <div class="div-3">
                              <div class="frame-27">
                                <div class="text-wrapper-5">Shop by Brand</div>
                                <a href="{{ url('/products-list') }}">
                                <div class="frame-10">
                                  <div class="text-wrapper-6">View All</div>
                                  <img src="/front/images/orange_arrow.svg" alt="orange_arrow">
                                </div>
                              </a>
                              </div>
                              <div class="frame-57">
                                @php
                                $firstBrandId = $brandsWithProducts->first()->id ?? null;
                            @endphp

                            @foreach ($brandsWithProducts as $index => $Brand)
                                <div class="frame-59 category-tab" onclick="changeProductsByCategory({{ $Brand->id }}, this)">
                                   <img class="image-6" src="{{ asset('storage/Brand/' . $Brand->image) }}" />
                                </div>
            @endforeach
                            
                            @if ($firstBrandId)
                                <script>
                                    window.onload = function () {
                                        const firstBrandElement = document.querySelector('.category-tab');
                                        if (firstBrandElement) {
                                            changeProductsByCategory({{ $firstBrandId }}, firstBrandElement);
                                        }
                                    };
                                </script>
                            @endif
                            

                              </div>
                              <div class="Brand-products" id="category-products">

             

                              </div>
                            </div>
                            @endif
                            <div class="div-3">
                              @if(!$isMobile)
                              <a href="{{ route('raise.query') }}">
                                  <img class="raise-query-img desktop" src="{{ asset('front/images/Raise_Query.png') }}" alt="Raise_Query">
                              </a>
                          @else
                              <a href="{{ route('raise.query') }}">
                                  <img class="raise-query-img mobile" src="{{ asset('front/images/Raise_Query_mobile.png') }}" alt="Raise_Query">
                              </a>
                          @endif
                          
                            </div>
                            <div class="div-2">
                              <div class="frame-14">
                                
                              <div class="text-wrapper-8">Products For You</div>
                                <a href="{{ url('/products-list?tag=product_for_you') }}">
                                <div class="frame-10">
                                  <div class="text-wrapper-6">View All</div>
                                  <img src="/front/images/orange_arrow.svg" alt="orange_arrow">
                                </div>
                              </a>
                              </div>
                              <div class="frame-15">
             @foreach ($productForYou as $product)

                                <div class="frame-16">
                                  <div class="overlap-group-wrapper">
                                    <div class="overlap">
                                      <a onclick="dataLayer.push({
                                        event: 'product_card_click',
                                        product_name: '{{ $product->name }}',
                                        category_name: '{{ $product->category->name }}'
                                      });" href="{{ route('products.sub.category.wise', ['slug' => $product->category->slug,'subSlug'=>$product->slug]) }}">
                                        <div class="rectangle">
                                          <img style="height: 90%;width: 90%;" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" />
                                        </div>
                                      </a>
                                      @if($product->best_selling_products)
                            <div class="group-2">
                              <div class="overlap-group">
                                <div class="text-wrapper-9">Best Seller</div>
                              </div>
                            </div>
                            @elseif($product->top_deals)
                            <div class="group-2">
                              <div class="overlap-group top-deals-bg">
                                <div class="text-wrapper-9">Top Deals</div>
                              </div>
                            </div>
                            @endif
                                    </div>
                                  </div>
                                  <div class="frame-17">
                                    <div class="frame-wrapper">
                                      <div class="wheel-chair-hashtag-wrapper">
                                        <a onclick="dataLayer.push({
                                          event: 'product_card_click',
                                          product_name: '{{ $product->name }}',
                                          category_name: '{{ $product->category->name }}'
                                        });" href="{{ route('products.sub.category.wise', ['slug' => $product->category->slug,'subSlug'=>$product->slug]) }}">
                                          <p class="wheel-chair-hashtag">
                                            @if($isMobile)
                                            {{ Str::limit($product->name, 40) }}
                                            @else
                                            {{ Str::limit($product->name,50) }}
                                            @endif
                    </p>
                                        </a>
                                      </div>
                                    </div>
                                    <div class="frame-18">
                                      <div class="frame-19">
                                        <div class="frame-20">
                                          <div class="frame-21">
                                            <div class="text-wrapper-11">₹ @indianCurrency($product->our_price)</div>
                                            <div class="text-wrapper-12">₹ @indianCurrency($product->original_price)</div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="frame-9">
                                      <div class="frame-22">
                                        <div class="text-wrapper-13">@indianCurrency($product->discount_percentage) % OFF</div>
                                      </div>
                                      <div class="frame-23">
                                        <div class="frame-24">
                                          @if ( $product->productAttributes->stock > 0)
                                <svg
                                  xmlns="http://www.w3.org/2000/svg" width="10" height="14" viewBox="0 0 10 14" fill="none">
                                  <path d="M8.94377 7.02453L5.64575 5.11307L7.30837 1.12293C7.36639 1.00442 7.39339 0.873133 7.38686 0.741345C7.38032 0.609557 7.34046 0.481581 7.27101 0.369392C7.20155 0.257203 7.10476 0.164468 6.98971 0.0998659C6.87466 0.0352635 6.7451 0.000904968 6.61315 5.51437e-06C6.43776 -0.000654732 6.2673 0.0579921 6.12945 0.166423L6.07501 0.213082L0.242625 5.73441C0.154947 5.81767 0.0878507 5.9202 0.046644 6.03388C0.00543737 6.14756 -0.0087485 6.26926 0.00520861 6.38937C0.0191657 6.50947 0.0608829 6.62469 0.127059 6.72588C0.193236 6.82708 0.282055 6.91149 0.38649 6.97243L3.68529 8.88545L2.00323 12.9215C1.93385 13.0861 1.92333 13.2696 1.97344 13.4411C2.02355 13.6126 2.13123 13.7615 2.27835 13.8629C2.42546 13.9643 2.60301 14.0118 2.78109 13.9976C2.95917 13.9833 3.1269 13.9081 3.25602 13.7847L9.08841 8.26178C9.1759 8.17845 9.24282 8.07593 9.28387 7.9623C9.32493 7.84867 9.33899 7.72705 9.32496 7.60705C9.31094 7.48704 9.26919 7.37195 9.20304 7.27085C9.13688 7.16976 9.04812 7.08543 8.94377 7.02453Z" fill="#F24F67"/>
                                </svg>
                                <div class="text-wrapper-14">
                                  Get it {{ \Carbon\Carbon::now()->addDays(7)->format('M d') }}
                              </div>
                              @else
                              <div class="text-wrapper-14" style="color: red;">
                                Sold out
                            </div>
                              @endif
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="frame-25">
                                    <div class="frame-26">
                                    <div class="text-wrapper-15 addtocart" onclick="dataLayer.push({
       event: 'add_to_cart_click',
       product_name: '{{ $product->name }}',
       product_id: '{{ $product->id }}',
       value: '{{ $product->our_price }}',
       category_name: '{{ $product->category->name }}'
     });" data-id="{{ $product->id }}">Add to cart</div>
                                    </div>
                                  </div>
                                </div>
            @endforeach

                              </div>
                            </div>
                            <section class="customer_part">
                                <div class="containerforfilters" style="display: block;">
                                    <div class="header-google">
                                        <h2>What Our Customers Say</h2>
                                    </div>

                                    <div class="google-section">
                                        <div class="google-header">
                                            <div class="google-info">
                                                <div class="google-logo">
                                                    <img src="/front/images/googlefull.svg" alt="Google Icon" width="124" height="84" style="height: 59px; margin-top: 8px;" />
                                                    @if($isMobile)
                                                    <div class="rating-section">
                                                        <span class="rating-number" style="font-size: 14px;margin-left: 14px;">4.7</span>
                                                        <span class="stars" style="    margin-left: 15px;">★★★★★</span>
                                                        <span class="review-count">(18)</span>
                                                    </div>
                                                    @else
                                                    <div class="rating-section">
                                                      <span class="rating-number" style="font-size: 14px">4.7</span>
                                                      <span class="stars" style="margin-right:-9px;">★★★★★</span>
                                                      <span class="review-count">(18)</span>
                                                  </div>
                                                    @endif
                                                </div>

                                                {{-- <span class="reviews-text">Reviews</span> --}}
                                            </div>
                                            {{-- <div class="rating-section">
                                                <span class="rating-number" style="font-size: 14px">4.7</span>
                                                <span class="stars">★★★★★</span>
                                                <span class="review-count">(18)</span>
                                            </div> --}}
                                            <a href="https://search.google.com/local/writereview?placeid=ChIJ8f2JDrvBwjsRBTVgSg8gSqA"
                                                target="_blank" rel="noopener noreferrer">
                                                <button class="review-button">Review us on Google</button>
                                            </a>

                                        </div>

                                        <div class="carousel-container">
                                            <div class="carousel" id="carousel">

                                                <!-- Start of review cards -->

                                                <div class="review-card">
                                                    <div class="review-header">
                                                        <div class="avatar">MU</div>
                                                        <div class="reviewer-info">
                                                            <div class="reviewer-name">Mayuri Ubale <span class="verified">✓</span></div>
                                                            <div class="review-date"><img src="/front/images/google-icon.svg" alt="Google Icon"
                                                                    width="24" height="24" /> 2 months ago</div>
                                                        </div>
                                                    </div>
                                                    <div class="review-stars">★★★★★</div>
                                                    <div class="review-text">
                                                        I had a great experience with Aarogyaa Bharat! I needed a hospital bed for my grandfather,
                                                        and their rental service was seamless. The ordering process was easy, delivery was quick,
                                                        and the equipment was in excellent condition.
                                                    </div>
                                                </div>

                                                <div class="review-card">
                                                    <div class="review-header">
                                                        <div class="avatar">AS</div>
                                                        <div class="reviewer-info">
                                                            <div class="reviewer-name">Ayesha Shaikh <span class="verified">✓</span></div>
                                                            <div class="review-date"><img src="/front/images/google-icon.svg" alt="Google Icon"
                                                                    width="24" height="24" /> 3 weeks ago</div>
                                                        </div>
                                                    </div>
                                                    <div class="review-stars">★★★★★</div>
                                                    <div class="review-text">
                                                        I had a great experience with Aarogyaabharat.com! They provide a wide range of medical
                                                        equipment for sale and rent, making it super convenient for those in need. The quality of
                                                        the products is excellent, and their customer service is great.
                                                    </div>
                                                </div>

                                                <div class="review-card">
                                                    <div class="review-header">
                                                        <div class="avatar">MR</div>
                                                        <div class="reviewer-info">
                                                            <div class="reviewer-name">Mohammed Rayan <span class="verified">✓</span></div>
                                                            <div class="review-date"><img src="/front/images/google-icon.svg" alt="Google Icon"
                                                                    width="24" height="24" /> 2 months ago</div>
                                                        </div>
                                                    </div>
                                                    <div class="review-stars">★★★★★</div>
                                                    <div class="review-text">
                                                        Excellent service from Aarogyaa Bharat! Rented an oxygen concentrator, and it was delivered
                                                        on time in perfect condition. Hassle-free process and great customer support. Highly
                                                        recommend!
                                                    </div>
                                                </div>

                                                <div class="review-card">
                                                    <div class="review-header">
                                                        <div class="avatar">SD</div>
                                                        <div class="reviewer-info">
                                                            <div class="reviewer-name">SHARON D'SA <span class="verified">✓</span></div>
                                                            <div class="review-date"><img src="/front/images/google-icon.svg" alt="Google Icon"
                                                                    width="24" height="24" /> 6 months ago</div>
                                                        </div>
                                                    </div>
                                                    <div class="review-stars">★★★★★</div>
                                                    <div class="review-text">
                                                        I once needed oxygen concentrator for a relative, and they delivered it within 30 mins. I
                                                        was amazed at their prompt service and would recommend everyone to keep in touch with them
                                                        in case of emergencies.
                                                    </div>
                                                </div>

                                                <div class="review-card">
                                                    <div class="review-header">
                                                        <div class="avatar">ZK</div>
                                                        <div class="reviewer-info">
                                                            <div class="reviewer-name">Zahed Kazi <span class="verified">✓</span></div>
                                                            <div class="review-date"><img src="/front/images/google-icon.svg" alt="Google Icon"
                                                                    width="24" height="24" /> a month ago</div>
                                                        </div>
                                                    </div>
                                                    <div class="review-stars">★★★★★</div>
                                                    <div class="review-text">
                                                        Thank you for delivering on time. The oxygen concentrator helped my granny to survive.
                                                    </div>
                                                </div>

                                                <div class="review-card">
                                                    <div class="review-header">
                                                        <div class="avatar">SS</div>
                                                        <div class="reviewer-info">
                                                            <div class="reviewer-name">simran shah <span class="verified">✓</span></div>
                                                            <div class="review-date"><img src="/front/images/google-icon.svg" alt="Google Icon"
                                                                    width="24" height="24" /> 3 months ago</div>
                                                        </div>
                                                    </div>
                                                    <div class="review-stars">★★★★★</div>
                                                    <div class="review-text">
                                                        Best and prompt service provider and enthusiastic environment to work with this company👍
                                                        Highly recommend
                                                    </div>
                                                </div>

                                                <div class="review-card">
                                                    <div class="review-header">
                                                        <div class="avatar">KO</div>
                                                        <div class="reviewer-info">
                                                            <div class="reviewer-name">Kalbhor Omkar <span class="verified">✓</span></div>
                                                            <div class="review-date"><img src="/front/images/google-icon.svg" alt="Google Icon"
                                                                    width="24" height="24" /> 2 months ago</div>
                                                        </div>
                                                    </div>
                                                    <div class="review-stars">★★★★★</div>
                                                    <div class="review-text">
                                                        Thank you so much for quick help. Team is very polite band responsive.
                                                    </div>
                                                </div>

                                                <div class="review-card">
                                                    <div class="review-header">
                                                        <div class="avatar">ST</div>
                                                        <div class="reviewer-info">
                                                            <div class="reviewer-name">Sai Tathe <span class="verified">✓</span></div>
                                                            <div class="review-date"><img src="/front/images/google-icon.svg" alt="Google Icon"
                                                                    width="24" height="24" /> 6 months ago</div>
                                                        </div>
                                                    </div>
                                                    <div class="review-stars">★★★★★</div>
                                                    <div class="review-text">
                                                        Thanks to Kiran, he was super supportive and responsible. thank you to aarogya bharat for
                                                        quick help.
                                                    </div>
                                                </div>

                                                <div class="review-card">
                                                    <div class="review-header">
                                                        <div class="avatar">JK</div>
                                                        <div class="reviewer-info">
                                                            <div class="reviewer-name">Jyoti kamble <span class="verified">✓</span></div>
                                                            <div class="review-date"><img src="/front/images/google-icon.svg" alt="Google Icon"
                                                                    width="24" height="24" /> 2 months ago</div>
                                                        </div>
                                                    </div>
                                                    <div class="review-stars">★★★★★</div>
                                                    <div class="review-text">
                                                        Great support by avinash. Thanks for quick help.
                                                    </div>
                                                </div>

                                                <div class="review-card">
                                                    <div class="review-header">
                                                        <div class="avatar">AK</div>
                                                        <div class="reviewer-info">
                                                            <div class="reviewer-name">Aditya Kumar Singh <span class="verified">✓</span></div>
                                                            <div class="review-date"><img src="/front/images/google-icon.svg" alt="Google Icon"
                                                                    width="24" height="24" /> 2 weeks ago</div>
                                                        </div>
                                                    </div>
                                                    <div class="review-stars">★★★★☆</div>
                                                    <div class="review-text">
                                                        Good customer support
                                                    </div>
                                                </div>

                                                <div class="review-card">
                                                    <div class="review-header">
                                                        <div class="avatar">SP</div>
                                                        <div class="reviewer-info">
                                                            <div class="reviewer-name">sandesh patil <span class="verified">✓</span></div>
                                                            <div class="review-date"><img src="/front/images/google-icon.svg" alt="Google Icon"
                                                                    width="24" height="24" /> a month ago</div>
                                                        </div>
                                                    </div>
                                                    <div class="review-stars">★★★★★</div>
                                                    <div class="review-text">
                                                        Thanks for quick support
                                                    </div>
                                                </div>

                                                <div class="review-card">
                                                    <div class="review-header">
                                                        <div class="avatar">AV</div>
                                                        <div class="reviewer-info">
                                                            <div class="reviewer-name">Anirudh Vasudevan <span class="verified">✓</span></div>
                                                            <div class="review-date"><img src="/front/images/google-icon.svg" alt="Google Icon"
                                                                    width="24" height="24" /> a month ago</div>
                                                        </div>
                                                    </div>
                                                    <div class="review-stars">★★★★★</div>
                                                    <div class="review-text">
                                                        Amazing!
                                                    </div>
                                                </div>

                                                <div class="review-card">
                                                    <div class="review-header">
                                                        <div class="avatar">HP</div>
                                                        <div class="reviewer-info">
                                                            <div class="reviewer-name">Harsh Pundir <span class="verified">✓</span></div>
                                                            <div class="review-date"><img src="/front/images/google-icon.svg" alt="Google Icon"
                                                                    width="24" height="24" /> 2 weeks ago</div>
                                                        </div>
                                                    </div>
                                                    <div class="review-stars">★★★★☆</div>
                                                    <div class="review-text">
                                                        Good service
                                                    </div>
                                                </div>

                                                <div class="review-card">
                                                    <div class="review-header">
                                                        <div class="avatar">SP</div>
                                                        <div class="reviewer-info">
                                                            <div class="reviewer-name">Samiksha Patil <span class="verified">✓</span></div>
                                                            <div class="review-date"><img src="/front/images/google-icon.svg" alt="Google Icon"
                                                                    width="24" height="24" /> a day ago</div>
                                                        </div>
                                                    </div>
                                                    <div class="review-stars">★★★★★</div>
                                                    <div class="review-text">
                                                        Helpful service 👍
                                                    </div>
                                                </div>
                                                <div class="review-card">
                                                  <div class="review-header">
                                                      <div class="avatar">AR</div>
                                                    <div class="reviewer-info">
                                                      <div class="reviewer-name">Avinash Rupnure <span class="verified">✓</span></div>
                                                        <div class="review-date"><img src="/front/images/google-icon.svg" alt="Google Icon" width="24" height="24"> a week ago</div>
                                                              </div>
                                                          </div>
                                                                  <div class="review-stars">★★★★</div>
                                                                      <div class="review-text">
                                                                          Highly satisfied! Rented a Cpap bipap machine for my uncle—good price, fast delivery, and great support.
                                                          </div>
                                               </div>
                                               <div class="review-card">
                                                  <div class="review-header">
                                                      <div class="avatar">SS</div>
                                                    <div class="reviewer-info">
                                                      <div class="reviewer-name">Saniya Shah <span class="verified">✓</span></div>
                                                        <div class="review-date"><img src="/front/images/google-icon.svg" alt="Google Icon" width="24" height="24"> a week ago</div>
                                                              </div>
                                                          </div>
                                                                  <div class="review-stars">★★★★★</div>
                                                                      <div class="review-text">
                                                                          Amazing service
                                                          </div>
                                               </div>
                                                <div class="review-card">
                                                  <div class="review-header">
                                                      <div class="avatar">RS</div>
                                                    <div class="reviewer-info">
                                                      <div class="reviewer-name">Ritesh Singh <span class="verified">✓</span></div>
                                                        <div class="review-date"><img src="/front/images/google-icon.svg" alt="Google Icon" width="24" height="24"> a week ago</div>
                                                              </div>
                                                          </div>
                                                                  <div class="review-stars">★★★★★</div>
                                                                      <div class="review-text">
                                                                          
                                                          </div>
                                               </div>
                                                 <div class="review-card">
                                                  <div class="review-header">
                                                      <div class="avatar">SR</div>
                                                    <div class="reviewer-info">
                                                      <div class="reviewer-name">Ritesh Singh <span class="verified">✓</span></div>
                                                        <div class="review-date"><img src="/front/images/google-icon.svg" alt="Google Icon" width="24" height="24"> a week ago</div>
                                                              </div>
                                                          </div>
                                                                  <div class="review-stars">★★★★★</div>
                                                                      <div class="review-text">
                                                                          Best services and fast delivery for innovative medical devices
                                                          </div>
                                               </div>
                                                  <div class="review-card">
                                                  <div class="review-header">
                                                      <div class="avatar">SR</div>
                                                    <div class="reviewer-info">
                                                      <div class="reviewer-name">Ritesh Singh <span class="verified">✓</span></div>
                                                        <div class="review-date"><img src="/front/images/google-icon.svg" alt="Google Icon" width="24" height="24"> a week ago</div>
                                                              </div>
                                                          </div>
                                                                  <div class="review-stars">★★★★★</div>
                                                                      <div class="review-text">
                                                                          Best services and fast delivery for innovative medical devices
                                                          </div>
                                               </div>
                                                   <div class="review-card">
                                                  <div class="review-header">
                                                      <div class="avatar">AH</div>
                                                    <div class="reviewer-info">
                                                      <div class="reviewer-name">akshay harihar <span class="verified">✓</span></div>
                                                        <div class="review-date"><img src="/front/images/google-icon.svg" alt="Google Icon" width="24" height="24"> a week ago</div>
                                                              </div>
                                                          </div>
                                                                  <div class="review-stars">★★★★★</div>
                                                                      <div class="review-text">
                                                                          Best
                                                          </div>
                                               </div>
                                               <div class="review-card">
                                                  <div class="review-header">
                                                      <div class="avatar">SG</div>
                                                    <div class="reviewer-info">
                                                      <div class="reviewer-name">Sandeep Godse <span class="verified">✓</span></div>
                                                        <div class="review-date"><img src="/front/images/google-icon.svg" alt="Google Icon" width="24" height="24"> a week ago</div>
                                                              </div>
                                                          </div>
                                                                  <div class="review-stars">★★★★★</div>
                                                                      <div class="review-text">
                                                                          Nice
                                                          </div>
                                               </div>
                                               <div class="review-card">
                                                  <div class="review-header">
                                                      <div class="avatar">AS</div>
                                                    <div class="reviewer-info">
                                                      <div class="reviewer-name">Aparna Sanas <span class="verified">✓</span></div>
                                                        <div class="review-date"><img src="/front/images/google-icon.svg" alt="Google Icon" width="24" height="24"> 4 weeks ago</div>
                                                              </div>
                                                          </div>
                                                                  <div class="review-stars">★★★★</div>
                                                                      <div class="review-text">
                                                                          Excellent Service, Amazing Product Quality.
                                                          </div>
                                               </div>
                                                <!-- Add more cards here if needed -->

                                            </div>
                                        </div>


                                        <div class="carousel-controls">
                                            <!-- Removed prevBtn button -->
                                            <div class="dots" id="dotsContainer"></div>
                                            <!-- Removed nextBtn button -->
                                        </div>
                                    </div>
                                </div>
                                <script>
                                  class ReviewCarousel {
                                      constructor() {
                                          this.carousel = document.getElementById('carousel');
                                          // Removed prevBtn and nextBtn
                                          this.dotsContainer = document.getElementById('dotsContainer');
                                          this.reviews = this.carousel.children;
                                          this.currentIndex = 0;
                                          this.reviewsToShow = this.getReviewsToShow();
                                          this.totalSlides = Math.ceil(this.reviews.length / this.reviewsToShow);
                                          this.dotCount = 3; // Always show 3 dots
                                          this.init();
                                      }

                                      getReviewsToShow() {
                                          if (window.innerWidth <= 480) return 1;
                                          if (window.innerWidth <= 768) return 2;
                                          if (window.innerWidth <= 1024) return 3;
                                          return 4;
                                      }

                                      init() {
                                          this.createDots();
                                          this.updateCarousel();
                                          this.bindEvents();
                                          window.addEventListener('resize', () => {
                                              const newReviewsToShow = this.getReviewsToShow();
                                              if (newReviewsToShow !== this.reviewsToShow) {
                                                  this.reviewsToShow = newReviewsToShow;
                                                  this.totalSlides = Math.ceil(this.reviews.length / this.reviewsToShow);
                                                  this.createDots();
                                                  this.updateCarousel();
                                              }
                                          });
                                      }

                                      createDots() {
                                          this.dotsContainer.innerHTML = '';
                                          for (let i = 0; i < this.dotCount; i++) {
                                              const dot = document.createElement('div');
                                              dot.className = 'dot';
                                              if (i === this.getDotIndex()) dot.classList.add('active');
                                              dot.addEventListener('click', () => this.goToDot(i));
                                              this.dotsContainer.appendChild(dot);
                                          }
                                      }

                                      getDotIndex() {
                                          // Map currentIndex to one of the 3 dots
                                          if (this.totalSlides <= 1) return 0;
                                          if (this.totalSlides === 2) return this.currentIndex;
                                          // For 3 or more slides, distribute indices evenly
                                          return Math.min(Math.floor(this.currentIndex / Math.ceil(this.totalSlides / this.dotCount)), this.dotCount - 1);
                                      }

                                      updateCarousel() {
                                          const translateX = -(this.currentIndex * 100);
                                          this.carousel.style.transform = `translateX(${translateX}%)`;

                                          // Update dots
                                          const dots = this.dotsContainer.querySelectorAll('.dot');
                                          dots.forEach((dot, index) => {
                                              dot.classList.toggle('active', index === this.getDotIndex());
                                          });
                                      }

                                      goToDot(dotIndex) {
                                          // Calculate the slide index for the dot
                                          const slidesPerDot = Math.ceil(this.totalSlides / this.dotCount);
                                          this.currentIndex = dotIndex * slidesPerDot;
                                          if (this.currentIndex >= this.totalSlides) {
                                              this.currentIndex = this.totalSlides - 1;
                                          }
                                          this.updateCarousel();
                                      }

                                      nextSlide() {
                                          if (this.currentIndex < this.totalSlides - 1) {
                                              this.currentIndex++;
                                              this.updateCarousel();
                                          }
                                      }

                                      prevSlide() {
                                          if (this.currentIndex > 0) {
                                              this.currentIndex--;
                                              this.updateCarousel();
                                          }
                                      }

                                      bindEvents() {
                                          // Removed nextBtn and prevBtn event listeners

                                          // Auto-scroll functionality
                                          let autoScrollInterval = setInterval(() => {
                                              if (this.currentIndex < this.totalSlides - 1) {
                                                  this.nextSlide();
                                              } else {
                                                  this.currentIndex = 0;
                                                  this.updateCarousel();
                                              }
                                          }, 5000);

                                          // Pause auto-scroll on hover
                                          this.carousel.addEventListener('mouseenter', () => {
                                              clearInterval(autoScrollInterval);
                                          });

                                          this.carousel.addEventListener('mouseleave', () => {
                                              autoScrollInterval = setInterval(() => {
                                                  if (this.currentIndex < this.totalSlides - 1) {
                                                      this.nextSlide();
                                                  } else {
                                                      this.currentIndex = 0;
                                                      this.updateCarousel();
                                                  }
                                              }, 5000);
                                          });

                                          // Touch/swipe support for mobile
                                          let startX = 0;
                                          let endX = 0;

                                          this.carousel.addEventListener('touchstart', (e) => {
                                              startX = e.touches[0].clientX;
                                          });

                                          this.carousel.addEventListener('touchend', (e) => {
                                              endX = e.changedTouches[0].clientX;
                                              const difference = startX - endX;

                                              if (difference > 50) {
                                                  this.nextSlide();
                                              } else if (difference < -50) {
                                                  this.prevSlide();
                                              }
                                          });
                                      }
                                  }

                                  // Initialize carousel when DOM is loaded
                                  document.addEventListener('DOMContentLoaded', () => {
                                      new ReviewCarousel();
                                  });

                                  // Handle read more functionality
                                  document.addEventListener('click', (e) => {
                                      if (e.target.classList.contains('read-more')) {
                                          e.preventDefault();
                                          const reviewText = e.target.parentElement;
                                          // Here you could expand the text or show a modal
                                          console.log('Read more clicked');
                                      }
                                  });

                                  // Handle review button click
                                  document.querySelector('.review-button').addEventListener('click', () => {
                                      // Here you would typically redirect to Google Reviews
                                      console.log('Review us on Google clicked');
                                  });
                              </script>
                              <script >
                                  document.querySelectorAll('.review-text').forEach(el => {
                                      const maxChars = 150;
                                      if (el.textContent.length > maxChars) {
                                          el.textContent = el.textContent.slice(0, maxChars) + '...';
                                      }
                                  });
                              </script>
                            </section>
                            <div class="frame-71">
                              <div class="text-wrapper-36">Champions beyond boundaries</div>
                              <div class="frame-72">
                                <div class="frame-73 profile-frame" id=champ1>
                                  <img class="image-10" src="{{ asset('front/images/champ_3.png') }}" />
                                  <div class="frame-74">
                                    <div class="text-wrapper-37 champ-name">Swaroop</div>
                                    <div class="text-wrapper-38 champ-title">Indian paralympic athlete</div>
                                  </div>
                                </div>
                                <div class="frame-75 profile-frame" id=champ2>
                                  <img class="image-11" src="{{ asset('front/images/champ_2.png') }}" />
                                  <div class="frame-76">
                                    <div class="text-wrapper-39 champ-name">Manpreet kaur</div>
                                    <div class="text-wrapper-40 champ-title">Indian paralympic athlete</div>
                                  </div>
                                </div>
                                <div class="frame-77 profile-frame" id=champ3>
                                  <img class="image-12" src="{{ asset('front/images/champ_3.png') }}"/>
                                  <div class="frame-78">
                                    <div class="text-wrapper-41 champ-name">Swaroop</div>
                                    <div class="text-wrapper-42 champ-title">Indian paralympic athlete</div>
                                  </div>
                                </div>
                                <div class="frame-79 profile-frame" id=champ4>
                                  <img class="image-13" src="{{ asset('front/images/champ_1.png') }}"/>
                                  <div class="frame-78">
                                    <div class="text-wrapper-43 champ-name">Avani Lekhara</div>
                                    <div class="text-wrapper-44 champ-title">Indian Paralympic rifle shooter</div>
                                  </div>
                                </div>
                                <div class="frame-77 profile-frame" id=champ5>
                                  <img class="image-14" src="{{ asset('front/images/champ_2.png') }}"/>
                                  <div class="frame-78">
                                    <div class="text-wrapper-45 champ-name">Manpreet kaur</div>
                                    <div class="text-wrapper-42 champ-title">Indian paralympic athlete</div>
                                  </div>
                                </div>
                                <div class="frame-75 profile-frame" id=champ6>
                                  <img class="image-15" src="{{ asset('front/images/champ_3.png') }}" />
                                  <div class="frame-76">
                                    <div class="text-wrapper-46 champ-name">Swaroop</div>
                                    <div class="text-wrapper-40 champ-title">Indian paralympic athlete</div>
                                  </div>
                                </div>
                                <div class="frame-73 profile-frame" id=champ7>
                                  <img class="image-16" src="{{ asset('front/images/champ_2.png') }}" />
                                  <div class="frame-74">
                                    <div class="text-wrapper-47 champ-name">Manpreet kaur</div>
                                    <div class="text-wrapper-38 champ-title">Indian paralympic athlete</div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="blogs">
                              <div class="text-wrapper-48">Our Blogs</div>
                              <div class="frame-80">


           @if ($isMobile)
            @foreach ($blogs->take(4) as $blog)

                                <div class="frame-81">
                                  <a href="{{ route('blog.details', ['slug' => $blog->slug]) }}">
                                    <div class="frame-82">
                
                                      <img class="rectangle-3" src="{{ asset('storage/' . $blog->images->first()->path) }}"
                                            alt="{{ $blog->images->first()->alt }}" />

                                      <img class="pngwing" />
                                    </div>
                                  </a>
               {{-- @foreach ($blogs as $blog) --}}

                                  <div class="frame-83">
                                    <div class="frame-69">
                                      <a href="{{ route('blog.details', ['slug' => $blog->slug]) }}">
                                        <div class="text-wrapper-49">{{ $blog->title }}</div>
                                        <p class="kros-samuktig">
                    {{ Str::limit($blog->description, 102) }}
                  </p>
                                      </a>
                                    </div>
                                    <div class="frame-9">
                                      <div class="frame-84">
                                        <div class="frame-85">
                   
                                            <div class="text-wrapper-50">{{ $blog->created_at->format('d/m/Y') }}</div>
                                          </div>
                                          <div class="frame-86">
                      @if ($isMobile)

                                            <svg
                                              xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none">
                    @else

                                              <svg
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    @endif

                                                <path d="M23.2049 11.745C22.3228 9.46324 20.7914 7.48996 18.8 6.06906C16.8086 4.64817 14.4445 3.84193 11.9999 3.75C9.55531 3.84193 7.19122 4.64817 5.19983 6.06906C3.20844 7.48996 1.67705 9.46324 0.794925 11.745C0.73535 11.9098 0.73535 12.0902 0.794925 12.255C1.67705 14.5368 3.20844 16.51 5.19983 17.9309C7.19122 19.3518 9.55531 20.1581 11.9999 20.25C14.4445 20.1581 16.8086 19.3518 18.8 17.9309C20.7914 16.51 22.3228 14.5368 23.2049 12.255C23.2645 12.0902 23.2645 11.9098 23.2049 11.745ZM11.9999 18.75C8.02492 18.75 3.82492 15.8025 2.30242 12C3.82492 8.1975 8.02492 5.25 11.9999 5.25C15.9749 5.25 20.1749 8.1975 21.6974 12C20.1749 15.8025 15.9749 18.75 11.9999 18.75Z" fill="#233F8C"/>
                                                <path d="M12 7.5C11.11 7.5 10.24 7.76392 9.49994 8.25839C8.75991 8.75285 8.18314 9.45566 7.84254 10.2779C7.50195 11.1002 7.41283 12.005 7.58647 12.8779C7.7601 13.7508 8.18869 14.5526 8.81802 15.182C9.44736 15.8113 10.2492 16.2399 11.1221 16.4135C11.995 16.5872 12.8998 16.4981 13.7221 16.1575C14.5443 15.8169 15.2471 15.2401 15.7416 14.5001C16.2361 13.76 16.5 12.89 16.5 12C16.5 10.8065 16.0259 9.66193 15.182 8.81802C14.3381 7.97411 13.1935 7.5 12 7.5ZM12 15C11.4067 15 10.8266 14.8241 10.3333 14.4944C9.83994 14.1648 9.45543 13.6962 9.22836 13.148C9.0013 12.5999 8.94189 11.9967 9.05765 11.4147C9.1734 10.8328 9.45912 10.2982 9.87868 9.87868C10.2982 9.45912 10.8328 9.1734 11.4147 9.05764C11.9967 8.94189 12.5999 9.0013 13.1481 9.22836C13.6962 9.45542 14.1648 9.83994 14.4944 10.3333C14.8241 10.8266 15 11.4067 15 12C15 12.7956 14.6839 13.5587 14.1213 14.1213C13.5587 14.6839 12.7957 15 12 15Z" fill="#233F8C"/>
                                              </svg>
                                              <div class="text-wrapper-50">{{ $blog->views }}</div>
                                            </div>
                                            <div class="share">
                                              <a target="_blank" href="https://wa.me/?text={{ urlencode('Check out this blog: ' . $blog->title . ' ' . route('blog.details', $blog->slug)) }}">
                     @if ($isMobile)
                               
                                              <svg
                                                xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none">
                    @else

                                                <svg
                                                  xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    @endif

                                                  <path d="M13.12 17.0232L8.92096 14.7332C8.37276 15.3193 7.66095 15.7269 6.87803 15.9031C6.09512 16.0793 5.27731 16.0159 4.53088 15.7212C3.78445 15.4266 3.14392 14.9142 2.69253 14.2506C2.24114 13.5871 1.99976 12.8032 1.99976 12.0007C1.99976 11.1982 2.24114 10.4143 2.69253 9.75076C3.14392 9.08725 3.78445 8.57486 4.53088 8.28017C5.27731 7.98548 6.09512 7.92211 6.87803 8.09832C7.66095 8.27452 8.37276 8.68214 8.92096 9.2682L13.121 6.97821C12.8829 6.03417 12.9973 5.0357 13.4427 4.16997C13.8881 3.30424 14.634 2.63069 15.5405 2.27557C16.447 1.92046 17.452 1.90816 18.3669 2.24098C19.2818 2.57381 20.044 3.2289 20.5105 4.08347C20.977 4.93804 21.1157 5.9334 20.9008 6.88299C20.6859 7.83257 20.132 8.67116 19.343 9.24158C18.554 9.81199 17.5841 10.0751 16.615 9.98147C15.6459 9.88789 14.7442 9.44406 14.079 8.7332L9.87896 11.0232C10.0402 11.6646 10.0402 12.3358 9.87896 12.9772L14.079 15.2672C14.7446 14.5567 15.6464 14.1133 16.6156 14.0202C17.5847 13.9271 18.5545 14.1906 19.3432 14.7614C20.1319 15.3322 20.6854 16.171 20.8999 17.1207C21.1143 18.0703 20.9751 19.0656 20.5083 19.9199C20.0414 20.7743 19.279 21.429 18.3639 21.7615C17.4489 22.0939 16.444 22.0812 15.5376 21.7257C14.6313 21.3702 13.8857 20.6964 13.4406 19.8305C12.9955 18.9646 12.8815 17.9661 13.12 17.0222V17.0232ZM5.99996 14.0002C6.5304 14.0002 7.0391 13.7895 7.41418 13.4144C7.78925 13.0393 7.99996 12.5306 7.99996 12.0002C7.99996 11.4698 7.78925 10.9611 7.41418 10.586C7.0391 10.2109 6.5304 10.0002 5.99996 10.0002C5.46953 10.0002 4.96082 10.2109 4.58575 10.586C4.21068 10.9611 3.99996 11.4698 3.99996 12.0002C3.99996 12.5306 4.21068 13.0393 4.58575 13.4144C4.96082 13.7895 5.46953 14.0002 5.99996 14.0002ZM17 8.00021C17.5304 8.00021 18.0391 7.78949 18.4142 7.41442C18.7892 7.03935 19 6.53064 19 6.00021C19 5.46977 18.7892 4.96107 18.4142 4.58599C18.0391 4.21092 17.5304 4.00021 17 4.00021C16.4695 4.00021 15.9608 4.21092 15.5857 4.58599C15.2107 4.96107 15 5.46977 15 6.00021C15 6.53064 15.2107 7.03935 15.5857 7.41442C15.9608 7.78949 16.4695 8.00021 17 8.00021ZM17 20.0002C17.5304 20.0002 18.0391 19.7895 18.4142 19.4144C18.7892 19.0393 19 18.5306 19 18.0002C19 17.4698 18.7892 16.9611 18.4142 16.586C18.0391 16.2109 17.5304 16.0002 17 16.0002C16.4695 16.0002 15.9608 16.2109 15.5857 16.586C15.2107 16.9611 15 17.4698 15 18.0002C15 18.5306 15.2107 19.0393 15.5857 19.4144C15.9608 19.7895 16.4695 20.0002 17 20.0002Z" fill="#F2A602"/>
                                                </svg>
                                                </a>
                                              </div>
                                            </div>
                 

                                          </div>
                                        </div>
                                      </div>
              @endforeach

           @else
           @foreach ($blogs as $blog)

           <div class="frame-81">
             <a href="{{ route('blog.details', ['slug' => $blog->slug]) }}">
               <div class="frame-82">

                 <img class="rectangle-3" src="{{ asset('storage/' . $blog->images->first()->path) }}"
                       alt="{{ $blog->images->first()->alt }}" />

                 <img class="pngwing" />
               </div>
             </a>
{{-- @foreach ($blogs as $blog) --}}

             <div class="frame-83">
               <div class="frame-69">
                 <a href="{{ route('blog.details', ['slug' => $blog->slug]) }}">
                   <div class="text-wrapper-49">{{ $blog->title }}</div>
                   <p class="kros-samuktig">
{{ Str::limit($blog->description, 102) }}
</p>
                 </a>
               </div>
               <div class="frame-9">
                 <div class="frame-84">
                   <div class="frame-85">

                       <div class="text-wrapper-50">{{ $blog->created_at->format('d/m/Y') }}</div>
                     </div>
                     <div class="frame-86">
 @if ($isMobile)

                       <svg
                         xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none">
@else

                         <svg
                           xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
@endif

                           <path d="M23.2049 11.745C22.3228 9.46324 20.7914 7.48996 18.8 6.06906C16.8086 4.64817 14.4445 3.84193 11.9999 3.75C9.55531 3.84193 7.19122 4.64817 5.19983 6.06906C3.20844 7.48996 1.67705 9.46324 0.794925 11.745C0.73535 11.9098 0.73535 12.0902 0.794925 12.255C1.67705 14.5368 3.20844 16.51 5.19983 17.9309C7.19122 19.3518 9.55531 20.1581 11.9999 20.25C14.4445 20.1581 16.8086 19.3518 18.8 17.9309C20.7914 16.51 22.3228 14.5368 23.2049 12.255C23.2645 12.0902 23.2645 11.9098 23.2049 11.745ZM11.9999 18.75C8.02492 18.75 3.82492 15.8025 2.30242 12C3.82492 8.1975 8.02492 5.25 11.9999 5.25C15.9749 5.25 20.1749 8.1975 21.6974 12C20.1749 15.8025 15.9749 18.75 11.9999 18.75Z" fill="#233F8C"/>
                           <path d="M12 7.5C11.11 7.5 10.24 7.76392 9.49994 8.25839C8.75991 8.75285 8.18314 9.45566 7.84254 10.2779C7.50195 11.1002 7.41283 12.005 7.58647 12.8779C7.7601 13.7508 8.18869 14.5526 8.81802 15.182C9.44736 15.8113 10.2492 16.2399 11.1221 16.4135C11.995 16.5872 12.8998 16.4981 13.7221 16.1575C14.5443 15.8169 15.2471 15.2401 15.7416 14.5001C16.2361 13.76 16.5 12.89 16.5 12C16.5 10.8065 16.0259 9.66193 15.182 8.81802C14.3381 7.97411 13.1935 7.5 12 7.5ZM12 15C11.4067 15 10.8266 14.8241 10.3333 14.4944C9.83994 14.1648 9.45543 13.6962 9.22836 13.148C9.0013 12.5999 8.94189 11.9967 9.05765 11.4147C9.1734 10.8328 9.45912 10.2982 9.87868 9.87868C10.2982 9.45912 10.8328 9.1734 11.4147 9.05764C11.9967 8.94189 12.5999 9.0013 13.1481 9.22836C13.6962 9.45542 14.1648 9.83994 14.4944 10.3333C14.8241 10.8266 15 11.4067 15 12C15 12.7956 14.6839 13.5587 14.1213 14.1213C13.5587 14.6839 12.7957 15 12 15Z" fill="#233F8C"/>
                         </svg>
                         <div class="text-wrapper-50">{{ $blog->views }}</div>
                       </div>
                       <div class="share">
                        <a target="_blank" href="https://wa.me/?text={{ urlencode('Check out this blog: ' . $blog->title . ' ' . route('blog.details', $blog->slug)) }}">
                  
@if ($isMobile)

                         <svg
                           xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none">
@else

                           <svg
                             xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
@endif

                             <path d="M13.12 17.0232L8.92096 14.7332C8.37276 15.3193 7.66095 15.7269 6.87803 15.9031C6.09512 16.0793 5.27731 16.0159 4.53088 15.7212C3.78445 15.4266 3.14392 14.9142 2.69253 14.2506C2.24114 13.5871 1.99976 12.8032 1.99976 12.0007C1.99976 11.1982 2.24114 10.4143 2.69253 9.75076C3.14392 9.08725 3.78445 8.57486 4.53088 8.28017C5.27731 7.98548 6.09512 7.92211 6.87803 8.09832C7.66095 8.27452 8.37276 8.68214 8.92096 9.2682L13.121 6.97821C12.8829 6.03417 12.9973 5.0357 13.4427 4.16997C13.8881 3.30424 14.634 2.63069 15.5405 2.27557C16.447 1.92046 17.452 1.90816 18.3669 2.24098C19.2818 2.57381 20.044 3.2289 20.5105 4.08347C20.977 4.93804 21.1157 5.9334 20.9008 6.88299C20.6859 7.83257 20.132 8.67116 19.343 9.24158C18.554 9.81199 17.5841 10.0751 16.615 9.98147C15.6459 9.88789 14.7442 9.44406 14.079 8.7332L9.87896 11.0232C10.0402 11.6646 10.0402 12.3358 9.87896 12.9772L14.079 15.2672C14.7446 14.5567 15.6464 14.1133 16.6156 14.0202C17.5847 13.9271 18.5545 14.1906 19.3432 14.7614C20.1319 15.3322 20.6854 16.171 20.8999 17.1207C21.1143 18.0703 20.9751 19.0656 20.5083 19.9199C20.0414 20.7743 19.279 21.429 18.3639 21.7615C17.4489 22.0939 16.444 22.0812 15.5376 21.7257C14.6313 21.3702 13.8857 20.6964 13.4406 19.8305C12.9955 18.9646 12.8815 17.9661 13.12 17.0222V17.0232ZM5.99996 14.0002C6.5304 14.0002 7.0391 13.7895 7.41418 13.4144C7.78925 13.0393 7.99996 12.5306 7.99996 12.0002C7.99996 11.4698 7.78925 10.9611 7.41418 10.586C7.0391 10.2109 6.5304 10.0002 5.99996 10.0002C5.46953 10.0002 4.96082 10.2109 4.58575 10.586C4.21068 10.9611 3.99996 11.4698 3.99996 12.0002C3.99996 12.5306 4.21068 13.0393 4.58575 13.4144C4.96082 13.7895 5.46953 14.0002 5.99996 14.0002ZM17 8.00021C17.5304 8.00021 18.0391 7.78949 18.4142 7.41442C18.7892 7.03935 19 6.53064 19 6.00021C19 5.46977 18.7892 4.96107 18.4142 4.58599C18.0391 4.21092 17.5304 4.00021 17 4.00021C16.4695 4.00021 15.9608 4.21092 15.5857 4.58599C15.2107 4.96107 15 5.46977 15 6.00021C15 6.53064 15.2107 7.03935 15.5857 7.41442C15.9608 7.78949 16.4695 8.00021 17 8.00021ZM17 20.0002C17.5304 20.0002 18.0391 19.7895 18.4142 19.4144C18.7892 19.0393 19 18.5306 19 18.0002C19 17.4698 18.7892 16.9611 18.4142 16.586C18.0391 16.2109 17.5304 16.0002 17 16.0002C16.4695 16.0002 15.9608 16.2109 15.5857 16.586C15.2107 16.9611 15 17.4698 15 18.0002C15 18.5306 15.2107 19.0393 15.5857 19.4144C15.9608 19.7895 16.4695 20.0002 17 20.0002Z" fill="#F2A602"/>
                           </svg>
                           </a>
                         </div>
                       </div>
                     </div>
                   </div>
                 </div>
@endforeach
           @endif


                                    </div>
                                    <div class="frame-89">
                                      <a href="{{ route('blogs') }}">
                                      <div class="text-wrapper-6">Read More Blogs</div>
                                      </a>
                                      <svg
                                        xmlns="http://www.w3.org/2000/svg" width="19" height="11" viewBox="0 0 19 11" fill="none">
                                        <path d="M1.28378 1.28378L9.50001 9.5L17.7162 1.28378" stroke="#F2A602" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                      </svg>
                                    </div>
                                    <div class="frame-87">
                                      <div class="frame-87">
                                        <div class="frame-9 blogsimage">
                                          <img class="image-17" src="{{ asset('front/images/blogs-image-1.png') }}" />
                                          <img class="image-17" src="{{ asset('front/images/blogs-image-2.png') }}" />
                                          <img class="image-17" src="{{ asset('front/images/blogs-image-1.png') }}" />
                                          <img class="image-17" src="{{ asset('front/images/blogs-image-2.png') }}" />
                                        </div>
                                      </div>
            {{--
                                      <img class="frame-88" src="https://c.animaapp.com/mciusnbpgZSJMg/img/frame-1707486595.svg" /> --}}

                                    </div>
                                    
                                    
                                 
                                  </div>
                                  <div class="div-3">
                                    <div class="frame-27">
                                      <div class="text-wrapper-26">In the news</div>
                                      {{-- <div class="frame-10">
                                        <div class="text-wrapper-6">View All</div>
                                        <img src="/front/images/orange_arrow.svg" alt="orange_arrow">
                                      </div> --}}
                                    </div>
                                    <div class="partners_we_work_logo1">
                                        <a target="_blank" href=" https://republicnewsindia.com/aarogyaa-bharat-the-pune-based-startup-revolutionizing-access-to-medical-equipment-across-india/">
                                        <img src="{{ asset('front/images/Republic-News-India-New-Logo-PNG.png') }}" alt="image">
                                    </a>
                                    <a target="_blank" href=" https://theindianbulletin.com/aarogyaa-bharat-the-pune-based-startup-revolutionizing-access-to-medical-equipment-across-india/">
                                        <img src="{{ asset('front/images/The-Indian-Bulletin-LOGO-02-300x75.jpg') }}" alt="image">
                                    </a>
                                        <!-- <img src="/front/images/Frame_1.png" alt="" /><img src="/front/images/Frame_2.png" alt="" /><img src="/front/images/Frame_3.png" alt="" /><img src="/front/images/Frame_4.png" alt="" /><img src="/front/images/Frame_5.png" alt="" /><img src="/front/images/Frame_6.png" alt="" /> -->
                                      </div>
                                  </div>
                                  <div class="div-3">
                                    <div class="frame-27">
                                      <div class="text-wrapper-5">Related Videos</div>
                                      {{-- <div class="frame-10">
                                        <div class="text-wrapper-6">View All</div>
                                        <img src="/front/images/orange_arrow.svg" alt="orange_arrow">
                                      </div> --}}
                                    </div>
                                    <div class="frame-95">
                                      <div class="frame-96">
                                        <div id="video-container">
                                          <iframe
                                            id="video1"
                                            width="315"
                                            height="180"
                                            src="https://www.youtube.com/embed/H1Szqz3R9PI?enablejsapi=1"
                                            title="Aarogyaa Bharat YouTube Video 1"
                                            loading="lazy"
                                            frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            referrerpolicy="strict-origin-when-cross-origin"
                                            allowfullscreen
                                          ></iframe>
                                        </div>
                                      </div>
                                      
                                      <div class="frame-96">
                                        <div id="video-container">
                                          <iframe
                                            id="video2"
                                            width="315"
                                            height="180"
                                            src="https://www.youtube.com/embed/pOgXLLjyfMk?enablejsapi=1"
                                            title="Aarogyaa Bharat YouTube Video 2"
                                            loading="lazy"
                                            frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            referrerpolicy="strict-origin-when-cross-origin"
                                            allowfullscreen
                                          ></iframe>
                                        </div>
                                      </div>
                                      
                                      <div class="frame-96">
                                        <div id="video-container">
                                          <iframe
                                            id="video3"
                                            width="315"
                                            height="180"
                                            src="https://www.youtube.com/embed/QintyV0dn2M?enablejsapi=1"
                                            title="Aarogyaa Bharat YouTube Video 3"
                                            loading="lazy"
                                            frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            referrerpolicy="strict-origin-when-cross-origin"
                                            allowfullscreen
                                          ></iframe>
                                        </div>
                                      </div>
                                      
                                      <div class="frame-96">
                                        <div id="video-container">
                                          <iframe
                                            id="video4"
                                            width="315"
                                            height="180"
                                            src="https://www.youtube.com/embed/xlmdJSnEDwk?enablejsapi=1"
                                            title="Aarogyaa Bharat YouTube Video 4"
                                            loading="lazy"
                                            frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            referrerpolicy="strict-origin-when-cross-origin"
                                            allowfullscreen
                                          ></iframe>
                                        </div>
                                      </div>
                                      
                                      <div class="frame-96">
                                        <div id="video-container">
                                          <iframe
                                            id="video5"
                                            width="315"
                                            height="180"
                                            src="https://www.youtube.com/embed/9QWic5oCXu8?enablejsapi=1"
                                            title="Aarogyaa Bharat YouTube Video 5"
                                            loading="lazy"
                                            frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            referrerpolicy="strict-origin-when-cross-origin"
                                            allowfullscreen
                                          ></iframe>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="div-3" style="margin-top:17px;">
                                    <div class="frame-64">
                                      <div class="text-wrapper-8">Why Aarogyaa Bharat ..?</div>
                                      <p class="text-wrapper-55">We put our customers at the heart of everything we do, understanding their unique needs and preferences. Our customer-centric approach ensures that our products and services are perfectly tailored to meet the expectations of our valued customers.
                                    </div>
                                    <div class="frame-98">
                                      <div class="middle">
                                        <div class="frame-99">
                                          <div class="frame-100">
                                            <div class="group-wrapper-2">
                                              <div class="group-130">
                                                <div class="overlap-group-24">
                                                  <img class="vector-56" src="{{ asset('front/images/Client-Centric_Approach.png') }}" />
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="frame-101">
                                            <div class="text-wrapper-56">Client-Centric Approach</div>
                                          </div>
                                        </div>
                                        <div class="frame-99">
                                          <div class="overlap-group-24">
                                            <img class="vector-56" src="{{ asset('front/images/Well-Equipped_Infrastructural_Setu.png') }}" />
                                          </div>
                                          <div class="frame-102">
                                            <div class="text-wrapper-56">Well-Equipped Infrastructural Setup</div>
                                          </div>
                                        </div>
                                        <div class="frame-99">
                                          <div class="overlap-group-24">
                                            <img class="vector-56" src="{{ asset('front/images/Skilled_Team_of_Professionals.png') }}" />
                                          </div>
                                          <div class="frame-102">
                                            <div class="text-wrapper-56">Skilled Team of Professionals</div>
                                          </div>
                                        </div>
                                        <div class="frame-99">
                                          <div class="overlap-group-24">
                                            <img class="vector-56" src="{{ asset('front/images/Wide_Distribution_Network.png') }}" />
                                          </div>
                                          <div class="frame-101">
                                            <div class="text-wrapper-56">Wide Distribution Network</div>
                                          </div>
                                        </div>
                                        <div class="frame-99">
                                          <div class="frame-100">
                                            <div class="overlap-group-24">
                                              <img class="vector-56" src="{{ asset('front/images/Ethical_Business_Practices.png') }}" />
                                            </div>
                                          </div>
                                          <div class="frame-101">
                                            <div class="text-wrapper-56">Ethical Business Practices</div>
                                          </div>
                                        </div>
                                        <div class="frame-99">
                                          <div class="frame-100">
                                            <div class="group-130">
                                              <div class="overlap-group-24">
                                                <img class="vector-56" src="{{ asset('front/images/Timely_Delivery.png') }}" />
                                              </div>
                                            </div>
                                          </div>
                                          <div class="frame-101">
                                            <div class="text-wrapper-56">Timely Delivery</div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <section class="partners_we_work_with">
                                    <!-- <div class="container"><div class="titlePart"><h4>Partners - we work with</h4><p>A wheelchair is a chair fitted with wheels. The device comes in variations allowing either manual propulsion by the seated occupant turning the rear wheels by hand or electric propulsion by motors electric propulsion by motors.</p></div><div class="partners_we_work_logo"><img src="/front/images/Frame_1.png" alt="" /><img src="/front/images/Frame_2.png" alt="" /><img src="/front/images/Frame_3.png" alt="" /><img src="/front/images/Frame_4.png" alt="" /><img src="/front/images/Frame_5.png" alt="" /><img src="/front/images/Frame_6.png" alt="" /></div></div> -->
                                    <div class="div-3">
                                      <div class="titlePart">
                                        <h4>{{ $partners->cms->title ?? 'Partners - We Work With' }}</h4>
                                        <p>{!! strip_tags($partners->cms->content) ??
                        'Ensuring quality healthcare access, we work with renowned medical institutions to provide trusted and seamless medical equipment solutions across India' !!}</p>
                                      </div>
                                      <div class="partners_we_work_logo">
                    @foreach ($partners->cms->images as $img)

                                        <img src="{{ asset('storage/' . $img->path) }}" alt="image" />
                    @endforeach

                                        <!-- <img src="{{ asset('front/images/Frame_1.png') }}" alt="" /><img src="{{ asset('front/images/Frame_2.png') }}" alt="" /><img src="{{ asset('front/images/Frame_3.png') }}" alt="" /><img src="{{ asset('front/images/Frame_4.png') }}" alt="" /><img src="{{ asset('front/images/Frame_5.png') }}" alt="" /><img src="{{ asset('front/images/Frame_6.png') }}" alt="" /> -->
                                      </div>
                                    </div>
                                  </section>
                                  <div class="div-3">
                                    <div class="text-wrapper-8">About Aarogyaa Bharat</div>
                                    <div class="frame-108">
                                      <p class="text-wrapper-58">
              A wheelchair is a chair fitted with wheels. The device comes in variations allowing either manual
              propulsion by the seated occupant turning the rear wheels by hand or electric propulsion by motors.A
              wheelchair is a chair fitted with wheels. The device comes in variations allowing either manual propulsion
              by the seated occupant turning the rear wheels by hand or electric propulsion by motors.
            </p>
                                      <p class="text-wrapper-58">
                                        <span class="text-wrapper-59"
                >A wheelchair is a chair fitted with wheels. The device comes in variations allowing either manual
                propulsion by the seated occupant turning the rear wheels by hand or electric propulsion by motors. A
                wheelchair is a chair fitted with wheels. The device comes in variations allowing either manual
                propulsion by the seated occupant turning the rear wheels by hand or electric propulsion by motors
              </span>
                                        {{-- <span class="text-wrapper-60">Read More..</span> --}}
                                      </p>
                                      <p class="text-wrapper-58">
              A wheelchair is a chair fitted with wheels. The device comes in variations allowing either manual
              propulsion by the seated occupant turning the rear wheels by hand or electric propulsion by motors. A
              wheelchair is a chair fitted with wheels. The device comes in variations allowing either manual propulsion
              by the seated occupant turning the rear wheels by hand or electric propulsion by motors.A wheelchair is a
              chair fitted with wheels. The device comes in variations allowing either manual propulsion by the seated
              occupant turning the rear wheels by hand or electric propulsion by motors.A wheelchair is a chair fitted
              with wheels. The device comes in variations allowing either manual propulsion by the seated occupant
              turning the rear wheels by hand or electric propulsion by motors.A wheelchair is a chair fitted with
              wheels. The device comes in variations allowing either manual propulsion by the seated occupant turning
              the rear wheels by hand or electric propulsion by motors.A wheelchair is a chair fitted with wheels. The
              device comes in variations allowing either manual propulsion by the seated occupant turning the rear
              wheels by hand or electric propulsion by motors.A wheelchair is a chair fitted with wheels. The device
              comes in variations allowing either manual propulsion by the seated occupant turning the rear wheels by
              hand or electric propulsion by motors.
            </p>
                                      <p class="text-wrapper-58">
              A wheelchair is a chair fitted with wheels. The device comes in variations allowing either manual
              propulsion by the seated occupant turning the rear wheels by hand or electric propulsion by motors.A
              wheelchair is a chair fitted with wheels. The device comes in variations allowing either manual propulsion
              by the seated occupant turning the rear wheels by hand or electric propulsion by motors.
            </p>
                                    </div>
                                  </div>
                                </div>
                                <script src="https://code.jquery.com/jquery-3.7.0.min.js" data-reload="true"></script>
                               
                                  <script>
                                    document.addEventListener('DOMContentLoaded', () => {
                                      const champions = [
  {
    name: "Swaroop",
    title: "Indian paralympic athlete",
    image: "champ_3.png"
  },
  {
    name: "Manpreet kaur",
    title: "Indian paralympic athlete",
    image: "champ_2.png"
  },
  {
    name: "Swaroop",
    title: "Indian paralympic athlete",
    image: "champ_3.png"
  },
  {
    name: "Avani Lekhara",
    title: "Indian Paralympic rifle shooter",
    image: "champ_1.png"
  },
  {
    name: "Manpreet kaur",
    title: "Indian paralympic athlete",
    image: "champ_2.png"
  },
  {
    name: "Swaroop",
    title: "Indian paralympic athlete",
    image: "champ_3.png"
  },
  {
    name: "Manpreet kaur",
    title: "Indian paralympic athlete",
    image: "champ_2.png"
  }
];

                                    
                                      const totalFrames = 7; // assuming 7 visible cards (champ1 to champ7)
                                      let currentIndex = 0;
                                    
                                      function updateFrames() {
                                        for (let i = 0; i < totalFrames; i++) {
                                          const champData = champions[(currentIndex + i) % champions.length];
                                          const frame = document.getElementById(`champ${i + 1}`);
                                          if (frame) {
                                            const img = frame.querySelector('img');
                                            const name = frame.querySelector('.champ-name');
                                            const title = frame.querySelector('.champ-title');
                                            if (img) img.src = `{{ asset('front/images/') }}/${champData.image}`;
                                            if (name) name.textContent = champData.name;
                                            if (title) title.textContent = champData.title;
                                          }
                                        }
                                    
                                        currentIndex = (currentIndex + 1) % champions.length;
                                      }
                                    
                                      // Initial population
                                      updateFrames();
                                    
                                      // Continuous update every 2 seconds
                                      setInterval(updateFrames, 2000);
                                    });
                                    let youtubeAPILoaded = false;
  let players = [];

  function loadYouTubeAPI() {
    if (youtubeAPILoaded) return;
    youtubeAPILoaded = true;

    const tag = document.createElement('script');
    tag.src = "https://www.youtube.com/iframe_api";
    document.head.appendChild(tag);
  }

  const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        loadYouTubeAPI();
        observer.disconnect(); // stop observing after loading API
      }
    });
  }, { threshold: 0.25 });

  document.querySelectorAll('iframe[src*="youtube"]').forEach(iframe => {
    observer.observe(iframe);
  });

  // YouTube API callback
  function onYouTubeIframeAPIReady() {
    const ids = ['video1', 'video2', 'video3', 'video4', 'video5'];
    ids.forEach((id, index) => {
      const player = new YT.Player(id, {
        events: {
          onStateChange: function (event) {
            if (event.data === YT.PlayerState.PLAYING) {
              window.dataLayer = window.dataLayer || [];
              dataLayer.push({
                event: 'video_play',
                video_title: document.getElementById(id).title,
                video_id: id,
                video_platform: 'YouTube'
              });
            }
          }
        }
      });
      players.push(player);
    });
  }
                                    </script>
                                    
                                <script type="application/ld+json">
                                  {
                                    "@context": "https://schema.org",
                                    "@type": "WebSite",
                                    "name": "Aarogyaa Bharat",
                                    "url": "{{url('/')}}",
                                    "logo": "{{url('/')}}/front/images/Favicon-new.svg",
                                    "potentialAction": {
                                      "@type": "SearchAction",
                                      "target": "{{url('/')}}/search/products/results/{search_term_string}",
                                      "query-input": "required name=search_term_string"
                                    }
                                  }
                                  </script>
                                  
                                @endsection('content')                     
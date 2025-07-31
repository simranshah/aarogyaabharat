@extends('front.layouts2.layout2')
@section('content')
    @php
        $isMobile =
            request()->header('User-Agent') &&
            preg_match('/mobile|android|iphone|ipad|phone/i', request()->header('User-Agent'));
    @endphp

    @if (!$isMobile)
        <div
            style="align-self: stretch; padding-top: 65px;  justify-content: flex-start; align-items: flex-start; gap: 18px; ">
        @else
            <div
                style="align-self: stretch; padding-top: 50px;  justify-content: flex-start; align-items: flex-start; gap: 18px; ">
    @endif

    @if ($isMobile)
        <nav class="new-home-breadcrumb" style="padding-top: 30px;">
            <a href="{{ url('/') }}">Home</a> / <a href="{{ route('products.list') }}">Categories</a> / <a
                href="{{ route('products.category.wise', ['slug' => $categoriesmain->slug]) }}">{{ $categoriesmain->name }}</a>
        </nav>
    @endif
    @if (!$isMobile)
        <div class="new-home-hero-section">
            @if (!$isMobile)
                <nav class="new-home-breadcrumb">
                    <a href="{{ url('/') }}">Home</a> / <a href="{{ route('products.list') }}">Categories</a>/ <a
                        href="{{ route('products.category.wise', ['slug' => $categoriesmain->slug]) }}">{{ $categoriesmain->name }}</a>
                </nav>
            @endif

            <main class="new-home-main-content">
                <h1 class="new-home-title">{{ $categoriesmain->name }}</h1>
                <p class="new-home-subtitle">{{ $categoriesmain->descriptation }}</p>
                {{-- <p class="new-home-description">Bel krokanat och ren diter clicks tiejkott.</p> --}}
            </main>
        </div>
        </div>
    @endif
    @if (!$isMobile)
        <div class="containerforfilters">
        @else
            <div class="containerforfilters" style="padding-top: 5px;">
    @endif

    @if ($isMobile)
        <div class="mobile-header">
            <button class="filter-toggle">
                FILTER
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path
                        d="M3 17v2h6v-2H3zM3 5v2h10V5H3zm10 16v-2h8v-2h-8v-2h-2v6h2zM7 9v2H3v2h4v2h2V9H7zm14 4v-2H11v2h10zm-6-4h2V7h4V5h-4V3h-2v6z" />
                </svg>
            </button>
            <div class="mobile-sort">
                <label style="
    font-size: 11px;
    width: 58px;
">Sort by:</label>
                <select class="sort-select mobile-sort-select">
                    <option value="relevance">Relevance</option>
                    <option value="price-low">Price: Low to High</option>
                    <option value="price-high">Price: High to Low</option>
                    <option value="rating">Customer Rating</option>
                    <option value="newest">Newest First</option>
                </select>
            </div>
        </div>
        <div class="applied-filters" id="appliedFilters">

        </div>
    @endif
    <!-- Filter Overlay -->
    <div class="filter-overlay" id="filterOverlay" onclick="closeMobileFilters()"></div>

    <!-- Mobile Filters -->
    @if ($isMobile)
        <div class="mobile-filters" id="mobileFilters">
            <div
                style="padding: 0 8px; display: flex; flex-direction: column; position: sticky; top: 0; z-index: 10; background: #fff;">
                <div style="display: flex; justify-content: flex-end;">
                    <button onclick="closeMobileFilters()"
                        style="font-size: 24px; line-height: 1; background: none; border: none; cursor: pointer; margin: 8px 0 8px 0;">&times;</button>
                </div>
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <h3 style="margin: 0; font-size: 1.2em;">Filters</h3>
                    <span id="clear-all-filters" onclick="clearAllFilters()"
                        style="color: red; text-decoration: underline; cursor: pointer; font-size: 15px; font-weight: 500;">Clear
                        All</span>
                </div>
                <hr style="    margin-top: 10px;
    margin-bottom: 4px;">
            </div>
            <div class="mobile-filters-content">


                <div class="filter-section">
                    <h3>Price Range</h3>
                    <div class="price-range">
                        <div class="price-inputs">
                            <input type="number" class="price-input" placeholder="Min" value="">
                            <input type="number" class="price-input" placeholder="Max" value="">

                        </div>
                        <span id="price-error" style="color: red; font-size: 12px;"></span>
                        <div class="price-slider">
                            <div class="price-slider-track"></div>
                            <div class="price-slider-thumb min"></div>
                            <div class="price-slider-thumb max"></div>
                        </div>
                    </div>
                </div>

                <div class="filter-section">
                    <h3>Stock</h3>
                    <div class="filter-options">
                        <div class="filter-option">
                            <input type="checkbox" value="in stock" name="stock" id="inStock">
                            <label for="inStock">In Stock</label>
                            <span class="filter-count">12</span>
                        </div>
                        {{-- <div class="filter-option">
                        <input type="checkbox" value="out of stock" name="stock" id="outOfStock">
                        <label for="outOfStock">Out of Stock</label>
                        <span class="filter-count">3</span>
                    </div> --}}
                    </div>
                </div>
                <div class="filter-section">
                    <h3>Rentable</h3>
                    <div class="filter-options">
                        <div class="filter-option">
                            <input type="checkbox" value="rentable" name="rentable" id="rentable">
                            <label for="rentable">Rentable</label>
                            <span class="filter-count">12</span>
                        </div>
                        {{-- <div class="filter-option">
                        <input type="checkbox" value="out of stock" name="stock" id="outOfStock">
                        <label for="outOfStock">Out of Stock</label>
                        <span class="filter-count">3</span>
                    </div> --}}
                    </div>
                </div>

                <div class="filter-section">
                    <h3>Gender</h3>
                    <div class="filter-options">
                        <div class="filter-option">
                            <input type="checkbox" value="Unisex" name="gender" id="unisex">
                            <label for="unisex">Unisex</label>
                            <span class="filter-count">8</span>
                        </div>
                        <div class="filter-option">
                            <input type="checkbox" value="Male" name="gender" id="male">
                            <label for="male">Male</label>
                            <span class="filter-count">4</span>
                        </div>
                        <div class="filter-option">
                            <input type="checkbox" value="Female" name="gender" id="female">
                            <label for="female">Female</label>
                            <span class="filter-count">3</span>
                        </div>
                    </div>
                </div>

                <div class="filter-section">
                    <h3 id="toggle-brand-filter" style="cursor: pointer;">
                        Brand <span id="brand-arrow" style="margin-right: 5px;">▶</span>
                      </h3>
                      
                      <div class="filter-options" id="brand-filter-options" style="display: none;">
                          @foreach ($brands as $brand)
                              <div class="filter-option">
                                  <input type="checkbox" value="{{ $brand->name }}" name="brand" id="brand_{{ $brand->id }}">
                                  <label for="brand_{{ $brand->id }}">{{ $brand->name }}</label>
                              </div>
                          @endforeach
                      </div>
                </div>

                <div class="filter-section">
                    <h3>Type</h3>
                    <div class="filter-options">
                        @foreach ($categoriesAndProducts as $category)
                            @foreach ($category->SubCategories as $SubCategories)
                                <div class="filter-option">
                                    <input type="checkbox" value="{{ $SubCategories->name }}" name="subcategory"
                                        id="{{ $SubCategories->slug }}">
                                    <label for="{{ $SubCategories->slug }}">{{ $SubCategories->name }}</label>
                                    <span class="filter-count">8</span>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
                <div class="filter-section">
                    <h3>Product Tags</h3>
                    <div class="filter-options">
                        <div class="filter-option">
                            <input type="checkbox" value="product_for_you" name="tag" id="product_for_you">
                            <label for="product_for_you">Product For You</label>
                        </div>
                        <div class="filter-option">
                            <input type="checkbox" value="is_new" name="tag" id="is_new">
                            <label for="is_new">New Arrival</label>
                        </div>
                        <div class="filter-option">
                            <input type="checkbox" value="flash_sale" name="tag" id="flash_sale">
                            <label for="flash_sale">Flash Sale</label>
                        </div>
                        <div class="filter-option">
                            <input type="checkbox" value="best_selling_products" name="tag"
                                id="best_selling_products">
                            <label for="best_selling_products">Best Seller</label>
                        </div>
                        <div class="filter-option">
                            <input type="checkbox" value="sports_healthcare_more" name="tag"
                                id="sports_healthcare_more">
                            <label for="sports_healthcare_more">Sports, Healthcare & More</label>
                        </div>
                        <div class="filter-option">
                            <input type="checkbox" value="top_deals" name="tag" id="top_deals">
                            <label for="top_deals">Top Deals</label>
                        </div>
                        <div class="filter-option">
                            <input type="checkbox" value="top_pick_for_you" name="tag" id="top_pick_for_you">
                            <label for="top_pick_for_you">Top Pick For You</label>
                        </div>
                    </div>
                </div>

                <div class="filter-section">
                    <h3>Rating</h3>
                    <div class="filter-options">
                        <div class="filter-option">
                            <input type="checkbox" value="4" name="rateing" id="rating4">
                            <label for="rating4">4 Stars & Above</label>
                            <span class="filter-count">8</span>
                        </div>
                        <div class="filter-option">
                            <input type="checkbox" value="3" name="rateing" id="rating3">
                            <label for="rating3">3 Stars & Above</label>
                            <span class="filter-count">12</span>
                        </div>
                        <div class="filter-option">
                            <input type="checkbox" value="2" name="rateing" id="rating2">
                            <label for="rating2">2 Stars & Above</label>
                            <span class="filter-count">15</span>
                        </div>
                    </div>
                </div>

                <div class="filter-section">
                    <h3>Discount</h3>
                    <div class="filter-options">
                        <div class="filter-option">
                            <input type="checkbox" value="50" name="discount" id="discount50">
                            <label for="discount50">Up to 50%</label>
                            <span class="filter-count">2</span>
                        </div>
                        <div class="filter-option">
                            <input type="checkbox" value="30" name="discount" id="discount30">
                            <label for="discount30">Up to 30%</label>
                            <span class="filter-count">5</span>
                        </div>
                        <div class="filter-option">
                            <input type="checkbox" value="20" name="discount" id="discount20">
                            <label for="discount20">Up to 20%</label>
                            <span class="filter-count">8</span>
                        </div>
                        <div class="filter-option">
                            <input type="checkbox" value="10" name="discount" id="discount10">
                            <label for="discount10">Up to 10%</label>
                            <span class="filter-count">12</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mobile-filters-footer">
                <button class="clear-mobile-filters" onclick="clearAllMobileFilters()">Clear All</button>
                <button class="apply-filters" onclick="applyMobileFilters()">Apply Filters</button>
            </div>
        </div>
    @endif
    @if (!$isMobile)
        <div class="filters-sidebar">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 18px;">
                <span style="font-size: 18px; font-weight: 700;">Filter</span>
                <span id="clear-all-filters" onclick="clearAllFilters()"
                    style="color: red; text-decoration: underline; cursor: pointer; font-size: 15px; font-weight: 500;">Clear
                    All</span>
            </div>

            <div class="filter-section">
                <h3>Price Range</h3>
                <div class="price-range">
                    <div class="price-inputs">
                        <input type="number" class="price-input" placeholder="Min" value="">
                        <input type="number" class="price-input" placeholder="Max" value="">

                    </div>
                    <span id="price-error" style="color: red; font-size: 12px;"></span>
                    <div class="price-slider">
                        <div class="price-slider-track"></div>
                        <div class="price-slider-thumb min"></div>
                        <div class="price-slider-thumb max"></div>
                    </div>
                </div>
            </div>

            <div class="filter-section">
                <h3>Stock</h3>
                <div class="filter-options">
                    <div class="filter-option">
                        <input type="checkbox" value="in stock" name="stock" id="inStock">
                        <label for="inStock">In Stock</label>
                        <span class="filter-count">12</span>
                    </div>
                    {{-- <div class="filter-option">
                    <input type="checkbox" value="out of stock" name="stock" id="outOfStock">
                    <label for="outOfStock">Out of Stock</label>
                    <span class="filter-count">3</span>
                </div> --}}
                </div>
            </div>
            <div class="filter-section">
                <h3>Rentable</h3>
                <div class="filter-options">
                    <div class="filter-option">
                        <input type="checkbox" value="rentable" name="rentable" id="rentable">
                        <label for="rentable">Rentable</label>
                        <span class="filter-count">12</span>
                    </div>
                    {{-- <div class="filter-option">
                    <input type="checkbox" value="out of stock" name="stock" id="outOfStock">
                    <label for="outOfStock">Out of Stock</label>
                    <span class="filter-count">3</span>
                </div> --}}
                </div>
            </div>

            <div class="filter-section">
                <h3>Gender</h3>
                <div class="filter-options">
                    <div class="filter-option">
                        <input type="checkbox" value="Unisex" name="gender" id="unisex">
                        <label for="unisex">Unisex</label>
                        <span class="filter-count">8</span>
                    </div>
                    <div class="filter-option">
                        <input type="checkbox" value="Male" name="gender" id="male">
                        <label for="male">Male</label>
                        <span class="filter-count">4</span>
                    </div>
                    <div class="filter-option">
                        <input type="checkbox" value="Female" name="gender" id="female">
                        <label for="female">Female</label>
                        <span class="filter-count">3</span>
                    </div>
                </div>
            </div>

            <div class="filter-section">
                <h3 id="toggle-brand-filter" style="cursor: pointer;">
                    Brand <span id="brand-arrow" style="margin-right: 5px;">▶</span>
                  </h3>
                  
                  <div class="filter-options" id="brand-filter-options" style="display: none;">
                      @foreach ($brands as $brand)
                          <div class="filter-option">
                              <input type="checkbox" value="{{ $brand->name }}" name="brand" id="brand_{{ $brand->id }}">
                              <label for="brand_{{ $brand->id }}">{{ $brand->name }}</label>
                          </div>
                      @endforeach
                  </div>
                  

            </div>

            <div class="filter-section">
                <h3>Type</h3>
                <div class="filter-options">
                    @foreach ($categoriesAndProducts as $category)
                        @foreach ($category->SubCategories as $SubCategories)
                            <div class="filter-option">
                                <input type="checkbox" value="{{ $SubCategories->name }}" name="subcategory"
                                    id="{{ $SubCategories->slug }}">
                                <label for="{{ $SubCategories->slug }}">{{ $SubCategories->name }}</label>
                                <span class="filter-count">8</span>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
            <div class="filter-section">
                <h3>Product Tags</h3>
                <div class="filter-options">
                    <div class="filter-option">
                        <input type="checkbox" value="product_for_you" name="tag" id="product_for_you">
                        <label for="product_for_you">Product For You</label>
                    </div>
                    <div class="filter-option">
                        <input type="checkbox" value="is_new" name="tag" id="is_new">
                        <label for="is_new">Newly Product</label>
                    </div>
                    <div class="filter-option">
                        <input type="checkbox" value="flash_sale" name="tag" id="flash_sale">
                        <label for="flash_sale">Flash Sale</label>
                    </div>
                    <div class="filter-option">
                        <input type="checkbox" value="best_selling_products" name="tag" id="best_selling_products">
                        <label for="best_selling_products">Best Seller</label>
                    </div>
                    <div class="filter-option">
                        <input type="checkbox" value="sports_healthcare_more" name="tag"
                            id="sports_healthcare_more">
                        <label for="sports_healthcare_more">Sports, Healthcare & More</label>
                    </div>
                    <div class="filter-option">
                        <input type="checkbox" value="top_deals" name="tag" id="top_deals">
                        <label for="top_deals">Top Deals</label>
                    </div>
                    <div class="filter-option">
                        <input type="checkbox" value="top_pick_for_you" name="tag" id="top_pick_for_you">
                        <label for="top_pick_for_you">Top Pick For You</label>
                    </div>
                </div>
            </div>

            <div class="filter-section">
                <h3>Rating</h3>
                <div class="filter-options">
                    <div class="filter-option">
                        <input type="checkbox" value="4" name="rateing" id="rating4">
                        <label for="rating4">4 Stars & Above</label>
                        <span class="filter-count">8</span>
                    </div>
                    <div class="filter-option">
                        <input type="checkbox" value="3" name="rateing" id="rating3">
                        <label for="rating3">3 Stars & Above</label>
                        <span class="filter-count">12</span>
                    </div>
                    <div class="filter-option">
                        <input type="checkbox" value="2" name="rateing" id="rating2">
                        <label for="rating2">2 Stars & Above</label>
                        <span class="filter-count">15</span>
                    </div>
                </div>
            </div>

            <div class="filter-section">
                <h3>Discount</h3>
                <div class="filter-options">
                    <div class="filter-option">
                        <input type="checkbox" value="50" name="discount" id="discount50">
                        <label for="discount50">Up to 50%</label>
                        <span class="filter-count">2</span>
                    </div>
                    <div class="filter-option">
                        <input type="checkbox" value="30" name="discount" id="discount30">
                        <label for="discount30">Up to 30%</label>
                        <span class="filter-count">5</span>
                    </div>
                    <div class="filter-option">
                        <input type="checkbox" value="20" name="discount" id="discount20">
                        <label for="discount20">Up to 20%</label>
                        <span class="filter-count">8</span>
                    </div>
                    <div class="filter-option">
                        <input type="checkbox" value="10" name="discount" id="discount10">
                        <label for="discount10">Up to 10%</label>
                        <span class="filter-count">12</span>
                    </div>
                </div>
            </div>

            {{-- <button class="clear-filters" onclick="clearAllFilters()">Clear All Filters</button> --}}
        </div>
    @endif
    <div class="products-section">

        <div class="products-header">
            <div>
                <h2 id="category-name" style="font-size: 20px; font-weight: 600;">{{ $categoriesmain->name }}( products)
                </h2>
            </div>
            <div class="sort-options">
                <label style="width: 85px;">Sort by:</label>
                <select class="sort-select">
                    <option value="relevance">Relevance</option>
                    <option value="price-low">Price: Low to High</option>
                    <option value="price-high">Price: High to Low</option>
                    <option value="rating">Customer Rating</option>
                    <option value="newest">Newest First</option>
                </select>
            </div>
        </div>
        <div class="applied-filters" id="appliedFilters">

        </div>
        <div class="products-grid">
            @foreach ($categoriesAndProducts as $category)
                @foreach ($category->products as $product)
                    <div class="frame-16">
                        <div class="overlap-group-wrapper">
                            <div class="overlap">
                                <a onclick="dataLayer.push({
                                    event: 'product_card_click',
                                    product_name: '{{ $product->name }}',
                                    category_name: '{{ $category->name }}'
                                  });"
                                    href="{{ route('products.sub.category.wise', ['slug' => $category->slug, 'subSlug' => $product->slug]) }}">
                                    <div class="rectangle">
                                        <img style="height: 90%;width: 90%;"
                                            src="{{ asset('storage/' . $product->image) }}"
                                            alt="{{ $product->name }}" />
                                    </div>
                                </a>
                                @if ($product->best_selling_products)
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
                                        category_name: '{{ $category->name }}'
                                      });"
                                        href="{{ route('products.sub.category.wise', ['slug' => $category->slug, 'subSlug' => $product->slug]) }}">
                                        <p class="wheel-chair-hashtag">
                                            {{ Str::limit($product->name, 40) }}
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
                                        @if ($product->productAttributes->stock > 0)
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="14"
                                                viewBox="0 0 10 14" fill="none">
                                                <path
                                                    d="M8.94377 7.02453L5.64575 5.11307L7.30837 1.12293C7.36639 1.00442 7.39339 0.873133 7.38686 0.741345C7.38032 0.609557 7.34046 0.481581 7.27101 0.369392C7.20155 0.257203 7.10476 0.164468 6.98971 0.0998659C6.87466 0.0352635 6.7451 0.000904968 6.61315 5.51437e-06C6.43776 -0.000654732 6.2673 0.0579921 6.12945 0.166423L6.07501 0.213082L0.242625 5.73441C0.154947 5.81767 0.0878507 5.9202 0.046644 6.03388C0.00543737 6.14756 -0.0087485 6.26926 0.00520861 6.38937C0.0191657 6.50947 0.0608829 6.62469 0.127059 6.72588C0.193236 6.82708 0.282055 6.91149 0.38649 6.97243L3.68529 8.88545L2.00323 12.9215C1.93385 13.0861 1.92333 13.2696 1.97344 13.4411C2.02355 13.6126 2.13123 13.7615 2.27835 13.8629C2.42546 13.9643 2.60301 14.0118 2.78109 13.9976C2.95917 13.9833 3.1269 13.9081 3.25602 13.7847L9.08841 8.26178C9.1759 8.17845 9.24282 8.07593 9.28387 7.9623C9.32493 7.84867 9.33899 7.72705 9.32496 7.60705C9.31094 7.48704 9.26919 7.37195 9.20304 7.27085C9.13688 7.16976 9.04812 7.08543 8.94377 7.02453Z"
                                                    fill="#F24F67" />
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
                                <div class="text-wrapper-15" onclick="addToCart({{ $product->id }});
                                dataLayer.push({
       event: 'add_to_cart_click',
       product_name: '{{ $product->name }}',
       product_id: '{{ $product->id }}',
       value: '{{ $product->our_price }}',
       category_name: '{{ $category->name }}'
     });" data-id="{{ $product->id }}">Add to cart</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endforeach


        </div>
        <div class="no-results-container" id="no-results-container" style="display: none;">
            <div class="no-results-title">No results found</div>
            <div class="filter-suggestion">Try adjusting your filter values</div>
        </div>
    </div>
    </div>
    <div class="recent-product-recently-viewed recent-products">
        <div class="recent-product-section-title">Recently Viewed</div>
        <div class="recent-product-products-slider">
            <!-- Repeat product-card divs here -->
            @foreach ($recentViewedProducts as $product)
                <a
                    href="{{ route('products.sub.category.wise', ['slug' => $product->category->slug, 'subSlug' => $product->slug]) }}">
                    <div class="recent-product-product-card">
                        <img src="{{ asset('storage/' . $product->image) }}" class="recent-product-product-image"
                            alt="{{ $product->name }}" />
                        <div class="recent-product-product-name"> {{ Str::limit($product->name, 35) }}</div>
                        <div class="recent-product-product-price">
                            <span class="recent-product-currency">₹</span>{{ $product->our_price }}

                        </div>
                    </div>
                </a>
            @endforeach
            <!-- Duplicate above product-card for more products -->
        </div>
    </div>
    <div class="div-3" style="margin-top: 20px;">
        <div class="text-wrapper-8">About Aarogya Bharat</div>
        <div class="frame-108">
            <p class="text-wrapper-58">
                A wheelchair is a chair fitted with wheels. The device comes in variations allowing either manual
                propulsion by the seated occupant turning the rear wheels by hand or electric propulsion by motors.A
                wheelchair is a chair fitted with wheels. The device comes in variations allowing either manual propulsion
                by the seated occupant turning the rear wheels by hand or electric propulsion by motors.
            </p>
            <p class="a-wheelchair-is-a">
                <span class="text-wrapper-59">A wheelchair is a chair fitted with wheels. The device comes in variations
                    allowing either manual
                    propulsion by the seated occupant turning the rear wheels by hand or electric propulsion by motors. A
                    wheelchair is a chair fitted with wheels. The device comes in variations allowing either manual
                    propulsion by the seated occupant turning the rear wheels by hand or electric propulsion by motors
                </span>
                <span class="text-wrapper-60">Read More..</span>
            </p>
            <p class="text-wrapper-61">
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
            <p class="text-wrapper-62">
                A wheelchair is a chair fitted with wheels. The device comes in variations allowing either manual
                propulsion by the seated occupant turning the rear wheels by hand or electric propulsion by motors.A
                wheelchair is a chair fitted with wheels. The device comes in variations allowing either manual propulsion
                by the seated occupant turning the rear wheels by hand or electric propulsion by motors.
            </p>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" data-reload="true"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js" data-reload="true"></script> --}}


    <script>
        function updateUrlWithFilters(filters) {
            const params = new URLSearchParams();
            for (const key in filters) {
                if (filters[key]) params.set(key, filters[key]);
            }
            const newUrl = window.location.pathname + '?' + params.toString();
            history.replaceState(null, '', newUrl);
        }

        function removeFilter(filterType) {
            const tag = event.target.parentElement;
            tag.remove();

            // Reset corresponding filter checkbox
            if (filterType === 'brand') {
                document.getElementById('medicos').checked = false;
            } else if (filterType === 'price') {
                document.querySelector('.price-input[placeholder="Min"]').value = '';
                document.querySelector('.price-input[placeholder="Max"]').value = '';
            }
        }

        function clearAllFilters() {
            // alert('All filters cleared!');
            // Clear all checkboxes
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(checkbox => checkbox.checked = false);

            // Clear price inputs
            document.querySelector('.price-input[placeholder="Min"]').value = '';
            document.querySelector('.price-input[placeholder="Max"]').value = '';

            // Clear applied filters
            document.getElementById('appliedFilters').innerHTML = '';
            updateAppliedFilters();
        }

        // Add event listeners for real-time filtering
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    updateAppliedFilters();
                });
            });

            const priceInputs = document.querySelectorAll('.price-input');
            priceInputs.forEach(input => {
                input.addEventListener('input', function() {
                    const minPriceInput = document.querySelector('.price-input[placeholder="Min"]');
                    const maxPriceInput = document.querySelector('.price-input[placeholder="Max"]');
                    const minPrice = parseFloat(minPriceInput.value);
                    const maxPrice = parseFloat(maxPriceInput.value);

                    if (isNaN(minPrice) || isNaN(maxPrice) || maxPrice > minPrice) {
                        updateAppliedFilters();
                    }
                });

            });
        });

        function updateAppliedFilters() {
            const appliedFiltersContainer = document.getElementById('appliedFilters');
            const filters = [];

            // Check price range
            const minPriceInput = document.querySelector('.price-input[placeholder="Min"]');
            const maxPriceInput = document.querySelector('.price-input[placeholder="Max"]');
            const minPrice = parseFloat(minPriceInput.value);
            const maxPrice = parseFloat(maxPriceInput.value);

            if ((minPriceInput.value && minPrice < 0) || (maxPriceInput.value && maxPrice < 0)) {
                // alert("Price cannot be negative.");
                document.getElementById('price-error').textContent = "Price cannot be negative.";
                if (minPrice < 0) minPriceInput.value = 0;
                if (maxPrice < 0) maxPriceInput.value = 0;
                // Optionally, return here to prevent further processing
            } else if (
                minPriceInput.value && maxPriceInput.value && maxPrice < minPrice
            ) {
                // alert("Maximum price cannot be less than minimum price.");
                document.getElementById('price-error').textContent = "Maximum price cannot be less than minimum price.";
                // maxPriceInput.value = ; // Optionally set max = min, or clear max
                // Optionally, return here to prevent further processing
            } else if (minPriceInput.value || maxPriceInput.value) {
                filters.push({
                    type: 'price',
                    text: `₹${minPriceInput.value || '0'} - ₹${maxPriceInput.value || '∞'}`
                });
            }

            // Check other filters
            const checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
            checkboxes.forEach(checkbox => {
                const label = document.querySelector(`label[for="${checkbox.id}"]`);
                console.log('label' + label);
                if (label) {
                    filters.push({
                        type: checkbox.id,
                        text: label.textContent.trim()

                    });
                }
            });

            // Update URL with filters
            const filterData = getFilterData();
            updateUrlWithFilters(filterData);

            filterProducts();
            // Update applied filters display
            appliedFiltersContainer.innerHTML = filters.map(filter =>
                `<div class="filter-tag">
                    ${filter.text} <span class="remove" onclick="removeSpecificFilter('${filter.type}')">&times;</span>
                </div>`
            ).join('');
        }

        function removeSpecificFilter(filterType) {
            if (filterType === 'price') {
                document.querySelector('.price-input[placeholder="Min"]').value = '';
                document.querySelector('.price-input[placeholder="Max"]').value = '';
            } else {
                const checkbox = document.getElementById(filterType);
                if (checkbox) {
                    checkbox.checked = false;
                }
            }
            updateAppliedFilters();
        }

        // Price slider functionality
        let isDragging = false;
        let currentSlider = null;

        document.addEventListener('DOMContentLoaded', function() {
            const sliderThumbs = document.querySelectorAll('.price-slider-thumb');
            const sliderTrack = document.querySelector('.price-slider-track');
            const minInput = document.querySelector('.price-input[placeholder="Min"]');
            const maxInput = document.querySelector('.price-input[placeholder="Max"]');

            sliderThumbs.forEach(thumb => {
                thumb.addEventListener('mousedown', function(e) {
                    console.log('in the mouse down on slider');
                    isDragging = true;
                    currentSlider = thumb;
                    if (isDragging && currentSlider) {
                        console.log('in the event2');
                        const slider = document.querySelector('.price-slider');
                        const rect = slider.getBoundingClientRect();
                        const percentage = Math.max(0, Math.min(100, ((e.clientX - rect.left) / rect
                            .width) * 100));

                        if (currentSlider.classList.contains('min')) {
                            currentSlider.style.left = percentage + '%';
                            const value = Math.round((percentage / 100) * 100000);
                            minInput.value = value;
                        } else {
                            currentSlider.style.right = (100 - percentage) + '%';
                            const value = Math.round((percentage / 100) * 100000);
                            maxInput.value = value;
                        }

                        updateSliderTrack();
                        updateAppliedFilters();
                        filterProducts();
                    }
                    // e.preventDefault();
                });
            });
            // document.addEventListener('mouseup', function(e) {

            //     updateSliderTrack();
            //         updateAppliedFilters();
            //         filterProducts();
            // });
            document.addEventListener('mousemove', function(e) {

                if (isDragging && currentSlider) {
                    console.log('in the event2');
                    const slider = document.querySelector('.price-slider');
                    const rect = slider.getBoundingClientRect();
                    const percentage = Math.max(0, Math.min(100, ((e.clientX - rect.left) / rect.width) *
                        100));

                    if (currentSlider.classList.contains('min')) {
                        currentSlider.style.left = percentage + '%';
                        const value = Math.round((percentage / 100) * 100000);
                        minInput.value = value;
                    } else {
                        currentSlider.style.right = (100 - percentage) + '%';
                        const value = Math.round((percentage / 100) * 100000);
                        maxInput.value = value;
                    }

                    updateSliderTrack();
                    // filterProducts();
                }
            });

            document.addEventListener('mouseup', function() {
                isDragging = false;
                currentSlider = null;
            });

            function updateSliderTrack() {
                const minThumb = document.querySelector('.price-slider-thumb.min');
                const maxThumb = document.querySelector('.price-slider-thumb.max');
                const minPos = parseFloat(minThumb.style.left || '0%');
                const maxPos = 100 - parseFloat(maxThumb.style.right || '0%');
                console.log(minPos, maxPos);
                sliderTrack.style.left = minPos + '%';
                sliderTrack.style.width = (maxPos - minPos) + '%';

            }

            // Initialize slider track
            updateSliderTrack();
        });

        // Simulate product filtering
        function filterProducts() {
            const filters = getFilterData();
            const baseUrl = '{{ url()->current() }}'; // or use url('/') for site root
            console.log(filters);
            $.ajax({
                url: baseUrl, // or your actual filter endpoint
                method: 'GET',
                data: {
                    ...filters,
                    base_url: baseUrl, // send base URL as a separate parameter
                    // _token: '{{ csrf_token() }}'
                },
                beforeSend: function() {
                    // Optionally show a loader
                },
                success: function(response) {
                    $('.products-grid').html(response.html);
                    $('.products-grid').html(response.html);
                    if (response.total_count == 0) {
                        $('#no-results-container').show();
                        $('.products-grid').hide();
                    } else {
                        $('#no-results-container').hide();
                        $('.products-grid').show();
                    }
                    $('#category-name').text('{{ $category->name }} (' + response.total_count + ' products)');

                    @if ($isMobile)
                        document.querySelectorAll('.group-2').forEach(badge => {
                            badge.style.top = "14px";
                        });
                    @else
                        adjustGroup2BadgePosition();
                    @endif
                    const grid = document.querySelector('.products-grid');
                    const firstProduct = grid ? grid.querySelector('.frame-16') : null;
                    if (grid && firstProduct) {
                        // Get the offset of the first product relative to the grid
                        const gridRect = grid.getBoundingClientRect();
                        const productRect = firstProduct.getBoundingClientRect();
                        const offset = productRect.top - gridRect.top + grid.scrollTop -
                        20; // adjust -20 for padding if needed
                        grid.scrollTo({
                            top: offset,
                            behavior: 'smooth'
                        });
                    }
                },
                error: function(xhr) {
                    alert('Error filtering products');
                }
            });
        }

        // Mobile filter functions
        $(document).ready(function() {
            $('.filter-toggle').on('click', function(e) {
                // e.preventDefault();
                // showFilterAlert();
                toggleMobileFilters();
            });
        });

        function showFilterAlert() {
            alert('Filter options are now available!');
        }

        function toggleMobileFilters() {
            // alert('in thisss');
            const $mobileFilters = $('#mobileFilters');
            const $filterOverlay = $('#filterOverlay');

            if ($mobileFilters.length && $filterOverlay.length) {
                const isVisible = $mobileFilters.css('transform') === 'translateX(0%)';

                $mobileFilters.css('transform', isVisible ? 'translateX(100%)' : 'translateX(0%)');
                $filterOverlay.css('display', isVisible ? 'none' : 'block');
            }
            document.body.classList.add('noscroll');
        }

        function closeMobileFilters() {
            const overlay = document.getElementById('filterOverlay');
            const filters = document.getElementById('mobileFilters');

            // Remove CSS classes
            overlay.classList.remove('show');
            filters.classList.remove('show');
            document.body.classList.remove('noscroll');

            // Reset inline styles
            $('#mobileFilters').css({
                'transform': '',
                'transition': '',
                'opacity': '',
                'visibility': '',
                'position': ''
            });

            $('#filterOverlay').css({
                'display': '',
                'background': '',
                'opacity': '',
                'visibility': '',
                'position': ''
            });
        }

        function applyMobileFilters() {
            // Sync mobile filters with desktop filters
            syncMobileToDesktop();
            closeMobileFilters();
            filterProducts();
        }

        function clearAllMobileFilters() {
            // Clear all mobile checkboxes
            const mobileCheckboxes = document.querySelectorAll('#mobileFilters input[type="checkbox"]');
            mobileCheckboxes.forEach(checkbox => checkbox.checked = false);

            // Clear price inputs
            const mobilePriceInputs = document.querySelectorAll('#mobileFilters .price-input');
            mobilePriceInputs.forEach(input => input.value = '');

            // Clear applied filters
            document.getElementById('appliedFilters').innerHTML = '';
        }

        function syncMobileToDesktop() {
            // Sync checkboxes
            const mobileCheckboxes = document.querySelectorAll('#mobileFilters input[type="checkbox"]');
            mobileCheckboxes.forEach(checkbox => {
                const desktopId = checkbox.id.replace('mobile', '').toLowerCase();
                const desktopCheckbox = document.getElementById(desktopId);
                if (desktopCheckbox) {
                    desktopCheckbox.checked = checkbox.checked;
                }
            });

            // Sync price inputs
            const mobilePriceInputs = document.querySelectorAll('#mobileFilters .price-input');
            const desktopPriceInputs = document.querySelectorAll('.filters-sidebar .price-input');
            mobilePriceInputs.forEach((input, index) => {
                if (desktopPriceInputs[index]) {
                    desktopPriceInputs[index].value = input.value;
                }
            });
        }

        function toggleSortDropdown() {
            const dropdown = document.getElementById('sortDropdown');
            dropdown.classList.toggle('show');
        }

        // Close sort dropdown when clicking outside
        // document.addEventListener('click', function(e) {
        //     const dropdown = document.getElementById('sortDropdown');
        //     const button = document.querySelector('.mobile-sort-btn');
        //     if (!dropdown.contains(e.target) && !button.contains(e.target)) {
        //         dropdown.classList.remove('show');
        //     }
        // });

        // Sort option selection
        document.addEventListener('DOMContentLoaded', function() {
            const sortOptions = document.querySelectorAll('.sort-option');
            sortOptions.forEach(option => {
                option.addEventListener('click', function() {
                    // Remove selected class from all options
                    sortOptions.forEach(opt => opt.classList.remove('selected'));

                    // Add selected class to clicked option
                    this.classList.add('selected');

                    // Update button text
                    const button = document.querySelector('.mobile-sort-btn');
                    button.childNodes[0].textContent = this.textContent;

                    // Close dropdown
                    document.getElementById('sortDropdown').classList.remove('show');

                    // Apply sorting
                    applySorting(this.dataset.value);
                });
            });
        });

        function applySorting(sortValue) {
            const products = Array.from(document.querySelectorAll('.product-card'));
            const grid = document.querySelector('.products-grid');

            products.sort((a, b) => {
                const priceA = parseFloat(a.querySelector('.product-price').textContent.replace(/[^\d.]/g, ''));
                const priceB = parseFloat(b.querySelector('.product-price').textContent.replace(/[^\d.]/g, ''));

                switch (sortValue) {
                    case 'price-low':
                        return priceA - priceB;
                    case 'price-high':
                        return priceB - priceA;
                    case 'rating':
                        const ratingA = parseFloat(a.querySelector('.rating-text').textContent.split(' ')[0]);
                        const ratingB = parseFloat(b.querySelector('.rating-text').textContent.split(' ')[0]);
                        return ratingB - ratingA;
                    default:
                        return 0;
                }
            });

            // Re-append sorted products
            products.forEach(product => grid.appendChild(product));
        }

        // Sort functionality
        document.addEventListener('DOMContentLoaded', function() {
            const sortSelect = document.querySelector('.sort-select');
            sortSelect.addEventListener('change', function() {
                const products = Array.from(document.querySelectorAll('.product-card'));
                const grid = document.querySelector('.products-grid');

                products.sort((a, b) => {
                    const priceA = parseFloat(a.querySelector('.product-price').textContent.replace(
                        /[^\d.]/g, ''));
                    const priceB = parseFloat(b.querySelector('.product-price').textContent.replace(
                        /[^\d.]/g, ''));

                    switch (sortSelect.value) {
                        case 'price-low':
                            return priceA - priceB;
                        case 'price-high':
                            return priceB - priceA;
                        case 'rating':
                            const ratingA = parseFloat(a.querySelector('.rating-text').textContent
                                .split(' ')[0]);
                            const ratingB = parseFloat(b.querySelector('.rating-text').textContent
                                .split(' ')[0]);
                            return ratingB - ratingA;
                        default:
                            return 0;
                    }
                });

                // Re-append sorted products
                products.forEach(product => grid.appendChild(product));
            });
        });

        function getFilterData() {
            const filters = {};

            // Get all checkbox groups by name
            const allCheckboxes = document.querySelectorAll('input[type="checkbox"]:checked');
            const filterGroups = {};

            allCheckboxes.forEach(cb => {
                const key = cb.name || cb.id;
                if (!filterGroups[key]) filterGroups[key] = [];
                filterGroups[key].push(cb.value || cb.id);
            });

            // Join each group with '|'
            for (const key in filterGroups) {
                filters[key] = filterGroups[key].join('|');
            }
            const sortSelect = document.querySelector('.sort-select');
            if (sortSelect) {
                filters.sort = sortSelect.value;
            }

            // Get price range
            const minInput = document.querySelector('.price-input[placeholder="Min"]');
            const maxInput = document.querySelector('.price-input[placeholder="Max"]');
            filters.min_price = minInput ? minInput.value : '';
            filters.max_price = maxInput ? maxInput.value : '';

            return filters;
        }
        document.addEventListener('DOMContentLoaded', function() {
            const sortSelect = document.querySelector('.sort-select');
            if (sortSelect) {
                sortSelect.addEventListener('change', function() {
                    filterProducts(); // This will now include the sort value
                });
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Helper to get all values for a param (handles repeated params)
            function getAllUrlParams(url) {
                let params = {};
                let parser = document.createElement('a');
                parser.href = url || window.location.href;
                let query = parser.search.substring(1);
                let vars = query.split('&');
                for (let i = 0; i < vars.length; i++) {
                    let pair = vars[i].split('=');
                    let key = decodeURIComponent(pair[0]);
                    let value = typeof pair[1] === 'undefined' ? '' : decodeURIComponent(pair[1]);
                    if (typeof params[key] === 'undefined') {
                        params[key] = value;
                    } else if (typeof params[key] === 'string') {
                        params[key] = [params[key], value];
                    } else {
                        params[key].push(value);
                    }
                }
                return params;
            }

            const params = getAllUrlParams();

            // Set price range
            if (params.min_price) {
                let minInput = document.querySelector('.price-input[placeholder="Min"]');
                if (minInput) minInput.value = params.min_price;
            }
            if (params.max_price) {
                let maxInput = document.querySelector('.price-input[placeholder="Max"]');
                if (maxInput) maxInput.value = params.max_price;
            }

            // Set sort selection from URL param
            if (params.sort) {
                let sortSelect = document.querySelector('.sort-select');
                if (sortSelect) sortSelect.value = params.sort;
            }

            // Helper to check checkboxes by value and name
            function checkByNameAndValue(name, value) {
                // alert(name);
                if (!value) return;
                value.split('|').forEach(val => {
                    // alert(name+'name');
                    // Replace + with space, then decode
                    let decoded = decodeURIComponent(val.replace(/\+/g, ' '));
                    // alert('val===' + decoded);

                    let selector = `input[type="checkbox"][name="${name}"][value="${decoded}"]`;
                    let checkbox = document.querySelector(selector);
                    if (checkbox) checkbox.checked = true;
                });
            }

            // For single-value filters
            function checkByNameAndValueSingle(name, value) {
                if (!value) return;
                let selector = `input[type="checkbox"][name="${name}"][value="${value}"]`;
                let checkbox = document.querySelector(selector);
                if (checkbox) checkbox.checked = true;
            }

            // Set checkboxes for each filter group
            checkByNameAndValue('stock', params.stock);
            checkByNameAndValue('gender', params.gender);
            checkByNameAndValue('brand', params.brand);
            checkByNameAndValue('subcategory', params.subcategory);
            checkByNameAndValue('discount', params.discount);
            checkByNameAndValue('rateing', params.rateing);
            checkByNameAndValue('rentable', params.rentable);
            checkByNameAndValue('tag', params.tag);


            // After setting, update the applied filters UI and filter products
            updateAppliedFilters();
        });

        function addToCart(productId) {
            $.ajax({
                url: "{{ route('cart.add', ['productId' => '__ID__']) }}".replace('__ID__', productId),
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.success) {
                        document.getElementById('cartproductcount').innerHTML = response.cartproductcount;
                        document.getElementById('text-btween-cartpopup').innerHTML = response.message;
                        document.getElementById('text-btween-cartpopup').style.color = '#2d5a2d';
                    } else {
                        document.getElementById('text-btween-cartpopup').innerHTML = response.message;
                        document.getElementById('text-btween-cartpopup').style.color = 'red';
                    }
                    cartPopup();
                },
                error: function() {
                    document.getElementById('logoutPopup3').style.display = 'flex';
                }
            });
        }
        @if (!$isMobile)
            function setProductsGridHeight() {
                var sidebar = document.querySelector('.filters-sidebar');
                var grid = document.querySelector('.products-grid');
                if (sidebar && grid) {
                    var sidebarHeight = sidebar.offsetHeight;
                    grid.style.maxHeight = sidebarHeight - 80 + 'px';
                }
            }

            // Run on page load
            window.addEventListener('DOMContentLoaded', setProductsGridHeight);
            // Run on window resize
            window.addEventListener('resize', setProductsGridHeight);

            function adjustGroup2BadgePosition() {
                const baseTop = 1; // base value for top
                const baseLeft = -12; // base value for left
                const width = window.innerWidth;
                const increment = Math.floor(width / 900); // 1px per 100px

                const newTop = baseTop + increment;
                const newLeft = baseLeft + increment;

                document.querySelectorAll('.group-2').forEach(badge => {
                    badge.style.top = newTop + "px";
                    badge.style.left = newLeft + "px";
                });
            }

            // Run on load and on resize
            window.addEventListener('DOMContentLoaded', adjustGroup2BadgePosition);
            window.addEventListener('resize', adjustGroup2BadgePosition);
        @else
            const grid = document.querySelector('.products-grid');
            grid.style.overflowX = 'hidden';
        @endif
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
          const toggleBtn = document.getElementById('toggle-brand-filter');
          const filterOptions = document.getElementById('brand-filter-options');
          const arrow = document.getElementById('brand-arrow');
        
          toggleBtn.addEventListener('click', () => {
            const isVisible = filterOptions.style.display === 'block';
            filterOptions.style.display = isVisible ? 'none' : 'block';
            arrow.textContent = isVisible ? '▶' : '▼';
          });
        });
        </script>
        
        
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

<!DOCTYPE html>
<html>
  <head>

    @php
        $isMobile =
            request()->header('User-Agent') &&
            preg_match('/mobile|android|iphone|ipad|phone/i', request()->header('User-Agent'));
    @endphp

    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <link rel="stylesheet" href="globals.css" />
    <link rel="stylesheet" href="styleguide.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="{{ asset('front/css/new-home.css') }}?v={{ time() }}" type="text/css"
        media="screen" />
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}?v={{ time() }}" type="text/css"
        media="screen" />
    <script src="{{ asset('front/js/jquery.min.js') }}"></script>
    <script src="{{ asset('front/js/script.js') }}?v={{ time() }}"></script>
  </head>
  <body>
    <div class="home-d">
      {{-- <div class="frame">
        <div class="ellipse"></div>
        <div class="div"></div>
      </div> --}}
      <div class="header-pre-login">
        <div class="frame-2">
          <div class="frame-3">
                 @if ($isMobile)

            <div class="hamburger" onclick="toggleSidebar()">
              <img src="{{ asset('front/images/hamburger.png') }}" alt="">
              </div>
              <div class="sidebar" id="sidebarMenu">
                <div class="sidebar-header">
                  <span>Account</span>
                  <span class="close-btn" onclick="toggleSidebar()">✕</span>
                </div>
                <div class="signin-register">
                  <a href="#">Sign in</a> |
                  <a href="#">Register</a>
                </div>
                <ul class="menu-section">
                  <li>
                    <strong>Products</strong>
                    <span class="toggle">+</span>
                  </li>
                  <li>
                    <strong>Offers</strong>
                  </li>
                  <li>
                    <strong>Category</strong>
                    <span class="toggle">-</span>
                  </li>
                  <li class="sub-item">Long product name
                    <span class="arrow">›</span>
                  </li>
                  <li class="sub-item">Long product name
                    <span class="arrow">›</span>
                  </li>
                  <li class="sub-item">Long product name
                    <span class="arrow">›</span>
                  </li>
                  <li class="sub-item">Long product name
                    <span class="arrow">›</span>
                  </li>
                  <li class="sub-item">Long product name
                    <span class="arrow">›</span>
                  </li>
                </ul>
              </div>
              <!-- Overlay -->
              <div class="overlay" id="overlay" onclick="toggleSidebar()"></div>
             @endif

              <div class="">
                <img src="{{ asset('front/images/arogya_bharat.svg') }}" class="logo-AB" />
              </div>
              @if (!$isMobile)
              <div class="frame-4">
                <div class="div-wrapper">
                  <a href="{{ route('new.home') }}">
                    <div class="text-wrapper">Home</div>
                  </a>
                </div>
                <div class="div-wrapper">
                  <a href="{{ route('products.list') }}">
                    <div class="text-wrapper-2">Products</div>
                  </a>
                </div>
                <div class="div-wrapper">
                  <a href="{{ route('products.flash.sale') }}">
                    <div class="text-wrapper-2">Offers</div>
                  </a>
                </div>
                <div class="div-wrapper">
                  <a href="{{ route('customer.about.us') }}">
                    <div class="text-wrapper-2">About</div>
                  </a>
                </div>
              </div>
              @endif

            </div>
            <div class="frame-5">
              <div class="search-bar">
                <div class="frame-6">
                  <svg
                    xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.33743 1.20377e-08C4.48625 7.25271e-05 3.64743 0.203696 2.89095 0.593882C2.13448 0.984069 1.48228 1.5495 0.988772 2.24301C0.495265 2.93652 0.17476 3.73799 0.0539975 4.58056C-0.0667652 5.42312 0.0157162 6.28235 0.29456 7.08656C0.573404 7.89077 1.04052 8.61663 1.65695 9.20359C2.27337 9.79055 3.02123 10.2216 3.83812 10.4607C4.65501 10.6999 5.51724 10.7402 6.35289 10.5784C7.18854 10.4165 7.97336 10.0572 8.64189 9.53031L10.9353 11.8237C11.0537 11.9381 11.2124 12.0014 11.377 12C11.5417 11.9985 11.6992 11.9325 11.8156 11.8161C11.932 11.6996 11.9981 11.5421 11.9995 11.3775C12.001 11.2128 11.9377 11.0542 11.8233 10.9357L9.52986 8.64234C10.1503 7.85524 10.5366 6.90935 10.6446 5.91294C10.7526 4.91653 10.5778 3.90985 10.1404 3.00811C9.70296 2.10637 9.02049 1.346 8.17109 0.814015C7.32168 0.282032 6.33967 -6.72845e-05 5.33743 1.20377e-08ZM1.25552 5.33788C1.25552 4.25529 1.68557 3.21704 2.45108 2.45153C3.21659 1.68603 4.25484 1.25597 5.33743 1.25597C6.42002 1.25597 7.45826 1.68603 8.22377 2.45153C8.98928 3.21704 9.41933 4.25529 9.41933 5.33788C9.41933 6.42047 8.98928 7.45872 8.22377 8.22422C7.45826 8.98973 6.42002 9.41979 5.33743 9.41979C4.25484 9.41979 3.21659 8.98973 2.45108 8.22422C1.68557 7.45872 1.25552 6.42047 1.25552 5.33788Z" fill="#233F8C"/>
                  </svg>
                  <input type="text" id="searchInput" class="text-wrapper-3" placeholder="Search" />
                </div>
              </div>
              <div class="recent-search-dropdown" id="recentSearch">
                <ul id="searchResultList"></ul>
              </div>
              @if (!$isMobile)

              <svg
                xmlns="http://www.w3.org/2000/svg" width="22" height="24" viewBox="0 0 22 24" fill="none">
                <g clip-path="url(#clip0_1_2260)">
                  <path d="M10.7998 0.75C14.833 0.75 18.1494 4.14933 18.1494 8.40039V9.24512C18.1494 10.401 18.4789 11.5332 19.0996 12.499L20.4287 14.5674C21.3843 16.0541 20.633 18.0391 19.0312 18.4922C13.642 20.0165 7.95772 20.0166 2.56836 18.4922C0.967027 18.0389 0.2157 16.054 1.1709 14.5674L2.49902 12.499L2.5 12.5C3.12098 11.534 3.45115 10.4012 3.45117 9.24512V8.40039C3.45117 4.14944 6.76675 0.750183 10.7998 0.75Z" stroke="#233F8C" stroke-width="1.5"/>
                  <path d="M11.6999 4.8004C11.6999 4.30334 11.297 3.90039 10.7999 3.90039C10.3029 3.90039 9.8999 4.30334 9.8999 4.8004V9.60045C9.8999 10.0975 10.3029 10.5005 10.7999 10.5005C11.297 10.5005 11.6999 10.0975 11.6999 9.60045V4.8004Z" fill="#F2A602"/>
                  <path d="M5.0918 19.8545C5.87293 22.2608 8.13325 24.0003 10.7998 24.0003C13.4665 24.0003 15.7267 22.2608 16.5079 19.8545C12.7333 20.5629 8.86637 20.5629 5.0918 19.8545Z" fill="#233F8C"/>
                </g>
                <defs>
                  <clipPath id="clip0_1_2260">
                    <rect width="21.6003" height="24" fill="white"/>
                  </clipPath>
                </defs>
              </svg>

             @endif
              @php
                            $customer = Auth::user();
                            $session_id = session()->get('cart_id');

                            // Only count cart items if a session ID or user exists
                            if ($customer || $session_id) {
                                $cartProductCount1 = App\Models\Front\Cart::where(function ($query) use (
                                    $customer,
                                    $session_id,
                                ) {
                                    if ($customer) {
                                        $query->where('user_id', $customer->id);
                                    }
                                    if ($session_id) {
                                        // Only check session_id if it's not null
            $query->orWhere('session_id', $session_id);
        }
    })
        ->withCount('cartProducts')
        ->get()
        ->sum('cart_products_count');
} else {
    $cartProductCount1 = 0; // No cart items if no session or user
}

\Log::channel('cart_log')->info('Header - Session ID:', [
    'session_id' => $session_id,
    'cartProductCount1' => $cartProductCount1,
                            ]);
                        @endphp


              <div class="frame-7">
                <a href="{{ route('cart') }}">
                  <img src="/front/images/cart.svg" alt="Cart">
                    <span class="count-mark" id="cartproductcount">{{ $cartProductCount1 ?? 0 }}</span>
                  </a>
                </div>
                <div class="cart-popup1" id="cartPopup">
                  <p class="popup-text" id="text-btween-cartpopup">Item Added to Cart</p>
                </div>
            @if (!$isMobile)


                <button class="login-button">
                  <a href="{{ route('login') }}">
                    <div class="text-wrapper-4">Login</div>
                  </a>
                </button>
            @endif

              </div>
            </div>
          </div>
          <div class="frame-8">
          @if(!$isMobile)

            <div style="align-self: stretch; padding-top: 70px; padding-left: 50px; padding-right: 50px; justify-content: flex-start; align-items: flex-start; gap: 18px; display: inline-flex">
            @else

              <div style="align-self: stretch; padding-top: 50px;  justify-content: flex-start; align-items: flex-start; gap: 18px; display: inline-flex">

            @endif
            @if(!$isMobile)

                <div class="list-container">
                      @foreach ($categories as $category)

                  <div class="list-item">
                    <div class="avatar-container">
                      <img class="avatar1" src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}"  />
                    </div>
                    <div class="content">
                      <div class="text">{{ $category->name }}</div>
                    </div>
                  </div>
                @endforeach
                </div>
@endif

                <div class="banner-container">
  @if ($isMobile)
                    @foreach ($mobileBannerImages as $banner)
                        {{-- @if ($loop->first) --}}

                  <div class="bannerBlock">
                    <a href="{{ $banner->link }}" target="_blank">
                      <img width="100%" class="bannerImage" src="{{ asset('storage/' . $banner->image) }}"
                                        alt="Mobile Banner" loading="lazy">
                      </a>
                    </div>
                        {{-- @endif --}}
                    @endforeach
                @else
                    @foreach ($bannerImages as $banner)
                        {{-- @if ($loop->first) --}}

                    <div class="bannerBlock">
                      <a href="{{ $banner->link }}" target="_blank">
                        <img width="100%" class="bannerImage" src="{{ asset('storage/' . $banner->image) }}"
                                        alt="Desktop Banner" loading="lazy">
                        </a>
                      </div>
                        {{-- @endif --}}
                    @endforeach
                    @endif
                    </div>
                  </div>
                  <div class="div-2">
                    <div class="frame-9" style="justify-content: space-between;">
                      <div class="text-wrapper-5">Category</div>
                      <div class="frame-10">
                        <div class="text-wrapper-6">View All</div>
                        <img src="/front/images/orange_arrow.svg" alt="orange_arrow">
                      </div>
                    </div>
                    <div class="frame-11 categories">
             @foreach ($categories as $category)

                      <a href="{{ route('products.category.wise', ['slug' => $category->slug]) }}"
                            style="text-decoration: none;">
                        <div class="frame-12">
                          <div class="image-wrapper">
                            <img class="image" src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" />
                          </div>
                          <div class="text-wrapper-7">{{ $category->name }}</div>
                        </div>
                      </a>
            @endforeach
            @foreach ($categories as $category)

            <a href="{{ route('products.category.wise', ['slug' => $category->slug]) }}"
                  style="text-decoration: none;">
              <div class="frame-12">
                <div class="image-wrapper">
                  <img class="image" src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" />
                </div>
                <div class="text-wrapper-7">{{ $category->name }}</div>
              </div>
            </a>
  @endforeach
                    </div>
                  </div>
                  <div class="div-2">
                    <div class="frame-14">
                      <div class="text-wrapper-8">Newly Product</div>
                      <div class="frame-10">
                        <div class="text-wrapper-6">View All</div>
                        <img src="/front/images/orange_arrow.svg" alt="orange_arrow">
                      </div>
                    </div>
                    <div class="frame-15 products">
             @foreach ($products as $product)

                      <div class="frame-16">
                        <div class="overlap-group-wrapper">
                          <div class="overlap">
                            <a href="{{ route('products.sub.category.wise', ['slug' => $product->category->slug,'subSlug'=>$product->slug]) }}">
                              <a href="{{ route('products.sub.category.wise', ['slug' => $product->category->slug,'subSlug'=>$product->slug]) }}">
                                <div class="rectangle">
                                  <img style="height: 90%;width: 90%;" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" />
                                </div>
                              </a>
                            </a>
                            <div class="group-2">
                              <div class="overlap-group">
                                <div class="text-wrapper-9">Best Seller</div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="frame-17">
                          <div class="frame-wrapper">
                            <div class="wheel-chair-hashtag-wrapper">
                              <a href="{{ route('products.sub.category.wise', ['slug' => $product->category->slug,'subSlug'=>$product->slug]) }}">
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
                                <svg
                                  xmlns="http://www.w3.org/2000/svg" width="10" height="14" viewBox="0 0 10 14" fill="none">
                                  <path d="M8.94377 7.02453L5.64575 5.11307L7.30837 1.12293C7.36639 1.00442 7.39339 0.873133 7.38686 0.741345C7.38032 0.609557 7.34046 0.481581 7.27101 0.369392C7.20155 0.257203 7.10476 0.164468 6.98971 0.0998659C6.87466 0.0352635 6.7451 0.000904968 6.61315 5.51437e-06C6.43776 -0.000654732 6.2673 0.0579921 6.12945 0.166423L6.07501 0.213082L0.242625 5.73441C0.154947 5.81767 0.0878507 5.9202 0.046644 6.03388C0.00543737 6.14756 -0.0087485 6.26926 0.00520861 6.38937C0.0191657 6.50947 0.0608829 6.62469 0.127059 6.72588C0.193236 6.82708 0.282055 6.91149 0.38649 6.97243L3.68529 8.88545L2.00323 12.9215C1.93385 13.0861 1.92333 13.2696 1.97344 13.4411C2.02355 13.6126 2.13123 13.7615 2.27835 13.8629C2.42546 13.9643 2.60301 14.0118 2.78109 13.9976C2.95917 13.9833 3.1269 13.9081 3.25602 13.7847L9.08841 8.26178C9.1759 8.17845 9.24282 8.07593 9.28387 7.9623C9.32493 7.84867 9.33899 7.72705 9.32496 7.60705C9.31094 7.48704 9.26919 7.37195 9.20304 7.27085C9.13688 7.16976 9.04812 7.08543 8.94377 7.02453Z" fill="#F24F67"/>
                                </svg>
                                <div class="text-wrapper-14">Get it May 29</div>
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
                  <div class="div-3">
                    <div class="frame-27">
                      <div class="text-wrapper-5">Everyone Buying This</div>
                      <div class="frame-10">
                        <div class="text-wrapper-6">View All</div>
                        <img src="/front/images/orange_arrow.svg" alt="orange_arrow">
                      </div>
                    </div>
                    <div class="frame-9 everyonebuying">
                      <div class="frame-28">
                        <img class="offer-image-home"
                        src="{{ asset('front/images/Everyone_is_bying.png') }}" alt="">
                        </div>
                        <div class="frame-28">
                            <img class="offer-image-home"
                            src="{{ asset('front/images/Everyone_is_bying.png') }}" alt="">
                            </div>
                        <div class="frame-28">
                            <img class="offer-image-home"
                            src="{{ asset('front/images/Everyone_is_bying.png') }}" alt="">
                            </div>
                            <div class="frame-28">
                                <img class="offer-image-home"
                                src="{{ asset('front/images/Everyone_is_bying.png') }}" alt="">
                                </div>
                          </div>
                        </div>
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

                          <div class="div-3" style="gap:0px">
                            <div class="frame-27">
                              <div class="text-wrapper-26">Home Care</div>
                              <div class="frame-10">
                                <div class="text-wrapper-6">View All</div>
                                <img src="/front/images/orange_arrow.svg" alt="orange_arrow">
                              </div>
                            </div>
                            <div class="frame-43">
                              <div class="frame-44">
                @foreach ($homecareproducts->products as $product)
                {{-- @foreach ($item->products as $product) --}}

                                <div class="frame-45">
                                  <div class="frame-46">
                                    <a href="{{ route('products.sub.category.wise', ['slug' => $homecareproducts->slug,'subSlug'=>$product->slug]) }}">
                                      <div class="wheelchair-wrapper">
                                        <img class="wheelchair-2" src="{{ asset('storage/' . $product->image) }}" />
                                      </div>
                                    </a>
                                  </div>
                                  <div class="frame-47">
                                    <div class="frame-48">
                                      <a href="{{ route('products.sub.category.wise', ['slug' => $homecareproducts->slug,'subSlug'=>$product->slug]) }}">
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
                          <div class="div-3" >
                            <div class="frame-27">
                              <div class="text-wrapper-26">Medical Equipment</div>
                              <div class="frame-10">
                                <div class="text-wrapper-6">View All</div>
                                <img src="/front/images/orange_arrow.svg" alt="orange_arrow">
                              </div>
                            </div>
                            <div class="frame-43">
                              <div class="frame-44">
                @foreach ($medicalequipmentproducts->products as $product)
                {{-- @foreach ($item->products as $product) --}}

                                <div class="frame-45">
                                  <div class="frame-46">
                                    <a href="{{ route('products.sub.category.wise', ['slug' => $medicalequipmentproducts->slug,'subSlug'=>$product->slug]) }}">
                                      <div class="wheelchair-wrapper">
                                        <img class="wheelchair-2" src="{{ asset('storage/' . $product->image) }}" />
                                      </div>
                                    </a>
                                  </div>
                                  <div class="frame-47">
                                    <div class="frame-48">
                                      <a href="{{ route('products.sub.category.wise', ['slug' => $medicalequipmentproducts->slug,'subSlug'=>$product->slug]) }}">
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
                          <div class="div-2">
                            <div class="frame-14">
                              <div class="text-wrapper-8">Flash Sale</div>
                              <div class="frame-10">
                                <div class="text-wrapper-6">View All</div>
                                <img src="/front/images/orange_arrow.svg" alt="orange_arrow">
                              </div>
                            </div>
                            <div class="frame-15">
             @foreach ($flashSaleProducts as $product)

                              <div class="frame-16">
                                <div class="overlap-group-wrapper">
                                  <div class="overlap">
                                    <a href="{{ route('products.sub.category.wise', ['slug' => $product->category->slug,'subSlug'=>$product->slug]) }}">
                                      <div class="rectangle">
                                        <img style="height: 90%;width: 90%;" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" />
                                      </div>
                                    </a>
                                    <div class="group-2">
                                      <div class="overlap-group">
                                        <div class="text-wrapper-9">Best Seller</div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="frame-17">
                                  <div class="frame-wrapper">
                                    <div class="wheel-chair-hashtag-wrapper">
                                      <a href="{{ route('products.sub.category.wise', ['slug' => $product->category->slug,'subSlug'=>$product->slug]) }}">
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
                                        <svg
                                          xmlns="http://www.w3.org/2000/svg" width="10" height="14" viewBox="0 0 10 14" fill="none">
                                          <path d="M8.94377 7.02453L5.64575 5.11307L7.30837 1.12293C7.36639 1.00442 7.39339 0.873133 7.38686 0.741345C7.38032 0.609557 7.34046 0.481581 7.27101 0.369392C7.20155 0.257203 7.10476 0.164468 6.98971 0.0998659C6.87466 0.0352635 6.7451 0.000904968 6.61315 5.51437e-06C6.43776 -0.000654732 6.2673 0.0579921 6.12945 0.166423L6.07501 0.213082L0.242625 5.73441C0.154947 5.81767 0.0878507 5.9202 0.046644 6.03388C0.00543737 6.14756 -0.0087485 6.26926 0.00520861 6.38937C0.0191657 6.50947 0.0608829 6.62469 0.127059 6.72588C0.193236 6.82708 0.282055 6.91149 0.38649 6.97243L3.68529 8.88545L2.00323 12.9215C1.93385 13.0861 1.92333 13.2696 1.97344 13.4411C2.02355 13.6126 2.13123 13.7615 2.27835 13.8629C2.42546 13.9643 2.60301 14.0118 2.78109 13.9976C2.95917 13.9833 3.1269 13.9081 3.25602 13.7847L9.08841 8.26178C9.1759 8.17845 9.24282 8.07593 9.28387 7.9623C9.32493 7.84867 9.33899 7.72705 9.32496 7.60705C9.31094 7.48704 9.26919 7.37195 9.20304 7.27085C9.13688 7.16976 9.04812 7.08543 8.94377 7.02453Z" fill="#F24F67"/>
                                        </svg>
                                        <div class="text-wrapper-14">Get it May 29</div>
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
                                <img src="{{ asset('front/images/wallet.png') }}" alt="">
                                </div>
                                <div class="frame-55">
                                  <div class="frame-56">
                                    <p class="text-wrapper-29">Make medical equipment affordable for all.</p>
                                  </div>
                                </div>
                              </div>
                              <div class="frame-54" style="background: linear-gradient(135deg, #B7ED60, #23D8A1);">
                                <div class="flowbite-wallet">
                                    <img src="{{ asset('front/images/smart.svg') }}" alt="">
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

                            <div class="div-3">
                              <div class="frame-27">
                                <div class="text-wrapper-5">Product by Brands</div>
                                <div class="frame-10">
                                  <div class="text-wrapper-6">View All</div>
                                  <img src="/front/images/orange_arrow.svg" alt="orange_arrow">
                                </div>
                              </div>
                              <div class="frame-57">
            @foreach ($categories as $category)

                                <div class="frame-59 category-tab" onclick="changeProductsByCategory({{ $category->id }},this)">
                                  <span>{{ $category->name }}</span>
                                </div>
            @endforeach
            {{--
                                <div class="frame-59">
                {{--
                                  <img class="image-6" src="{{ asset('front/images/brand_1.png') }}" />
                                </div>
            {{--
                                <div class="frame-59">
                                  <img class="image-6" src="{{ asset('front/images/brand_2.png') }}" />
                                </div>
                                <div class="frame-59">
                                  <img class="image-6" src="{{ asset('front/images/brand_3.png') }}" />
                                </div>
                                <div class="frame-59">
                                  <img class="image-6" src="{{ asset('front/images/brand_4.png') }}" />
                                </div>
                                <div class="frame-59">
                                  <img class="image-6" src="{{ asset('front/images/brand_5.png') }}" />
                                </div> --}}


                              </div>
                              <div class="frame-15" id="category-products">

             @foreach ($bestSellingProducts as $product)

                                <div class="frame-16">
                                  <div class="overlap-group-wrapper">
                                    <div class="overlap">
                                      <a href="{{ route('products.sub.category.wise', ['slug' => $product->category->slug,'subSlug'=>$product->slug]) }}">
                                        <div class="rectangle">
                                          <img style="height: 90%;width: 90%;" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" />
                                        </div>
                                      </a>
                                      <div class="group-2">
                                        <div class="overlap-group">
                                          <div class="text-wrapper-9">Best Seller</div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="frame-17">
                                    <div class="frame-wrapper">
                                      <div class="wheel-chair-hashtag-wrapper">
                                        <a href="{{ route('products.sub.category.wise', ['slug' => $product->category->slug,'subSlug'=>$product->slug]) }}">
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
                                          <svg
                                            xmlns="http://www.w3.org/2000/svg" width="10" height="14" viewBox="0 0 10 14" fill="none">
                                            <path d="M8.94377 7.02453L5.64575 5.11307L7.30837 1.12293C7.36639 1.00442 7.39339 0.873133 7.38686 0.741345C7.38032 0.609557 7.34046 0.481581 7.27101 0.369392C7.20155 0.257203 7.10476 0.164468 6.98971 0.0998659C6.87466 0.0352635 6.7451 0.000904968 6.61315 5.51437e-06C6.43776 -0.000654732 6.2673 0.0579921 6.12945 0.166423L6.07501 0.213082L0.242625 5.73441C0.154947 5.81767 0.0878507 5.9202 0.046644 6.03388C0.00543737 6.14756 -0.0087485 6.26926 0.00520861 6.38937C0.0191657 6.50947 0.0608829 6.62469 0.127059 6.72588C0.193236 6.82708 0.282055 6.91149 0.38649 6.97243L3.68529 8.88545L2.00323 12.9215C1.93385 13.0861 1.92333 13.2696 1.97344 13.4411C2.02355 13.6126 2.13123 13.7615 2.27835 13.8629C2.42546 13.9643 2.60301 14.0118 2.78109 13.9976C2.95917 13.9833 3.1269 13.9081 3.25602 13.7847L9.08841 8.26178C9.1759 8.17845 9.24282 8.07593 9.28387 7.9623C9.32493 7.84867 9.33899 7.72705 9.32496 7.60705C9.31094 7.48704 9.26919 7.37195 9.20304 7.27085C9.13688 7.16976 9.04812 7.08543 8.94377 7.02453Z" fill="#F24F67"/>
                                          </svg>
                                          <div class="text-wrapper-14">Get it May 29</div>
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
                            <div class="div-3">
                            @if(!$isMobile)
                              <img src="{{ asset('front/images/Raise_Query.png') }}" alt="Raise_Query" width="100%">
                            @else
                            <img src="{{ asset('front/images/Raise_Query_mobile.png') }}" alt="Raise_Query" width="100%">
                            @endif
                            </div>
                            <div class="div-2">
                              <div class="frame-14">
                                <div class="text-wrapper-8">Products For You</div>
                                <div class="frame-10">
                                  <div class="text-wrapper-6">View All</div>
                                  <img src="/front/images/orange_arrow.svg" alt="orange_arrow">
                                </div>
                              </div>
                              <div class="frame-15">
             @foreach ($productForYou as $product)

                                <div class="frame-16">
                                  <div class="overlap-group-wrapper">
                                    <div class="overlap">
                                      <a href="{{ route('products.sub.category.wise', ['slug' => $product->category->slug,'subSlug'=>$product->slug]) }}">
                                        <div class="rectangle">
                                          <img style="height: 90%;width: 90%;" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" />
                                        </div>
                                      </a>
                                      <div class="group-2">
                                        <div class="overlap-group">
                                          <div class="text-wrapper-9">Best Seller</div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="frame-17">
                                    <div class="frame-wrapper">
                                      <div class="wheel-chair-hashtag-wrapper">
                                        <a href="{{ route('products.sub.category.wise', ['slug' => $product->category->slug,'subSlug'=>$product->slug]) }}">
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
                                          <svg
                                            xmlns="http://www.w3.org/2000/svg" width="10" height="14" viewBox="0 0 10 14" fill="none">
                                            <path d="M8.94377 7.02453L5.64575 5.11307L7.30837 1.12293C7.36639 1.00442 7.39339 0.873133 7.38686 0.741345C7.38032 0.609557 7.34046 0.481581 7.27101 0.369392C7.20155 0.257203 7.10476 0.164468 6.98971 0.0998659C6.87466 0.0352635 6.7451 0.000904968 6.61315 5.51437e-06C6.43776 -0.000654732 6.2673 0.0579921 6.12945 0.166423L6.07501 0.213082L0.242625 5.73441C0.154947 5.81767 0.0878507 5.9202 0.046644 6.03388C0.00543737 6.14756 -0.0087485 6.26926 0.00520861 6.38937C0.0191657 6.50947 0.0608829 6.62469 0.127059 6.72588C0.193236 6.82708 0.282055 6.91149 0.38649 6.97243L3.68529 8.88545L2.00323 12.9215C1.93385 13.0861 1.92333 13.2696 1.97344 13.4411C2.02355 13.6126 2.13123 13.7615 2.27835 13.8629C2.42546 13.9643 2.60301 14.0118 2.78109 13.9976C2.95917 13.9833 3.1269 13.9081 3.25602 13.7847L9.08841 8.26178C9.1759 8.17845 9.24282 8.07593 9.28387 7.9623C9.32493 7.84867 9.33899 7.72705 9.32496 7.60705C9.31094 7.48704 9.26919 7.37195 9.20304 7.27085C9.13688 7.16976 9.04812 7.08543 8.94377 7.02453Z" fill="#F24F67"/>
                                          </svg>
                                          <div class="text-wrapper-14">Get it May 29</div>
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
                                                    <div class="rating-section">
                                                        <span class="rating-number" style="font-size: 14px">4.7</span>
                                                        <span class="stars">★★★★★</span>
                                                        <span class="review-count">(18)</span>
                                                    </div>
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

                                                <!-- Add more cards here if needed -->

                                            </div>
                                        </div>


                                        <div class="carousel-controls">
                                            <button class="nav-button" id="prevBtn">‹</button>
                                            {{-- <div class="dots" id="dotsContainer"></div> --}}
                                            <button class="nav-button" id="nextBtn">›</button>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    class ReviewCarousel {
                                        constructor() {
                                            this.carousel = document.getElementById('carousel');
                                            this.prevBtn = document.getElementById('prevBtn');
                                            this.nextBtn = document.getElementById('nextBtn');
                                            this.dotsContainer = document.getElementById('dotsContainer');
                                            this.reviews = this.carousel.children;
                                            this.currentIndex = 0;
                                            this.reviewsToShow = this.getReviewsToShow();
                                            this.totalSlides = Math.ceil(this.reviews.length / this.reviewsToShow);

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
                                                    this.currentIndex = Math.min(this.currentIndex, this.totalSlides - 1);
                                                    this.createDots();
                                                    this.updateCarousel();
                                                }
                                            });
                                        }

                                        createDots() {
                                            this.dotsContainer.innerHTML = '';
                                            for (let i = 0; i < this.totalSlides; i++) {
                                                const dot = document.createElement('div');
                                                dot.className = 'dot';
                                                if (i === this.currentIndex) dot.classList.add('active');
                                                dot.addEventListener('click', () => this.goToSlide(i));
                                                this.dotsContainer.appendChild(dot);
                                            }
                                        }

                                        updateCarousel() {
                                            const translateX = -(this.currentIndex * 100);
                                            this.carousel.style.transform = `translateX(${translateX}%)`;

                                            // Update dots
                                            const dots = this.dotsContainer.querySelectorAll('.dot');
                                            dots.forEach((dot, index) => {
                                                dot.classList.toggle('active', index === this.currentIndex);
                                            });

                                            // Update button states
                                            this.prevBtn.disabled = this.currentIndex === 0;
                                            this.nextBtn.disabled = this.currentIndex === this.totalSlides - 1;
                                        }

                                        goToSlide(index) {
                                            this.currentIndex = Math.max(0, Math.min(index, this.totalSlides - 1));
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
                                            this.nextBtn.addEventListener('click', () => this.nextSlide());
                                            this.prevBtn.addEventListener('click', () => this.prevSlide());

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
                                <script>
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
                                <div class="frame-73 profile-frame">
                                  <img class="image-10" src="{{ asset('front/images/champ_3.png') }}" />
                                  <div class="frame-74">
                                    <div class="text-wrapper-37">Swaroop</div>
                                    <div class="text-wrapper-38">Indian paralympic athlete</div>
                                  </div>
                                </div>
                                <div class="frame-75 profile-frame">
                                  <img class="image-11" src="{{ asset('front/images/champ_2.png') }}" />
                                  <div class="frame-76">
                                    <div class="text-wrapper-39">Manpreet kaur</div>
                                    <div class="text-wrapper-40">Indian paralympic athlete</div>
                                  </div>
                                </div>
                                <div class="frame-77 profile-frame">
                                  <img class="image-12" src="{{ asset('front/images/champ_3.png') }}"/>
                                  <div class="frame-78">
                                    <div class="text-wrapper-41">Swaroop</div>
                                    <div class="text-wrapper-42">Indian paralympic athlete</div>
                                  </div>
                                </div>
                                <div class="frame-79 profile-frame">
                                  <img class="image-13" src="{{ asset('front/images/champ_1.png') }}"/>
                                  <div class="frame-78">
                                    <div class="text-wrapper-43">Avani Lekhara</div>
                                    <div class="text-wrapper-44">Indian Paralympic rifle shooter</div>
                                  </div>
                                </div>
                                <div class="frame-77 profile-frame">
                                  <img class="image-14" src="{{ asset('front/images/champ_2.png') }}"/>
                                  <div class="frame-78">
                                    <div class="text-wrapper-45">Manpreet kaur</div>
                                    <div class="text-wrapper-42">Indian paralympic athlete</div>
                                  </div>
                                </div>
                                <div class="frame-75 profile-frame">
                                  <img class="image-15" src="{{ asset('front/images/champ_3.png') }}" />
                                  <div class="frame-76">
                                    <div class="text-wrapper-46">Swaroop</div>
                                    <div class="text-wrapper-40">Indian paralympic athlete</div>
                                  </div>
                                </div>
                                <div class="frame-73 profile-frame">
                                  <img class="image-16" src="{{ asset('front/images/champ_2.png') }}" />
                                  <div class="frame-74">
                                    <div class="text-wrapper-47">Manpreet kaur</div>
                                    <div class="text-wrapper-38">Indian paralympic athlete</div>
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
                {{--
                                      <img class="rectangle-3" src="{{ asset('storage/' . $blog->images->first()->path) }}"
                                            alt="{{ $blog->images->first()->alt }}" /> --}}

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
                    @if ($isMobile)

                                          <svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none">
                    @else

                                            <svg
                                              xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    @endif

                                              <g clip-path="url(#clip0_367_327)">
                                                <path d="M0 9.33327C0 6.81859 -7.94731e-08 5.56259 0.781336 4.78125C1.56267 3.99992 2.81868 3.99992 5.33335 3.99992H18.6667C21.1814 3.99992 22.4374 3.99992 23.2187 4.78125C24.0001 5.56259 24.0001 6.81859 24.0001 9.33327H0Z" fill="#233F8C"/>
                                                <path d="M2.66694 4.9999H21.3336C22.254 4.99998 23.0005 5.74642 23.0005 6.66686V21.3336C23.0004 22.2539 22.2539 22.9994 21.3336 22.9995H2.66694C1.74653 22.9995 1.00011 22.2539 0.99998 21.3336V6.66686C0.99998 5.74637 1.74645 4.9999 2.66694 4.9999Z" stroke="#233F8C" stroke-width="2"/>
                                                <path d="M5.33436 1.49997V5.49998M18.6677 1.49997V5.49998" stroke="#233F8C" stroke-width="2" stroke-linecap="round"/>
                                              </g>
                                              <defs>
                                                <clipPath id="clip0_367_327">
                                                  <rect width="24.0006" height="24" fill="white"/>
                                                </clipPath>
                                              </defs>
                                            </svg>
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
                     @if ($isMobile)

                                              <svg
                                                xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none">
                    @else

                                                <svg
                                                  xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    @endif

                                                  <path d="M13.12 17.0232L8.92096 14.7332C8.37276 15.3193 7.66095 15.7269 6.87803 15.9031C6.09512 16.0793 5.27731 16.0159 4.53088 15.7212C3.78445 15.4266 3.14392 14.9142 2.69253 14.2506C2.24114 13.5871 1.99976 12.8032 1.99976 12.0007C1.99976 11.1982 2.24114 10.4143 2.69253 9.75076C3.14392 9.08725 3.78445 8.57486 4.53088 8.28017C5.27731 7.98548 6.09512 7.92211 6.87803 8.09832C7.66095 8.27452 8.37276 8.68214 8.92096 9.2682L13.121 6.97821C12.8829 6.03417 12.9973 5.0357 13.4427 4.16997C13.8881 3.30424 14.634 2.63069 15.5405 2.27557C16.447 1.92046 17.452 1.90816 18.3669 2.24098C19.2818 2.57381 20.044 3.2289 20.5105 4.08347C20.977 4.93804 21.1157 5.9334 20.9008 6.88299C20.6859 7.83257 20.132 8.67116 19.343 9.24158C18.554 9.81199 17.5841 10.0751 16.615 9.98147C15.6459 9.88789 14.7442 9.44406 14.079 8.7332L9.87896 11.0232C10.0402 11.6646 10.0402 12.3358 9.87896 12.9772L14.079 15.2672C14.7446 14.5567 15.6464 14.1133 16.6156 14.0202C17.5847 13.9271 18.5545 14.1906 19.3432 14.7614C20.1319 15.3322 20.6854 16.171 20.8999 17.1207C21.1143 18.0703 20.9751 19.0656 20.5083 19.9199C20.0414 20.7743 19.279 21.429 18.3639 21.7615C17.4489 22.0939 16.444 22.0812 15.5376 21.7257C14.6313 21.3702 13.8857 20.6964 13.4406 19.8305C12.9955 18.9646 12.8815 17.9661 13.12 17.0222V17.0232ZM5.99996 14.0002C6.5304 14.0002 7.0391 13.7895 7.41418 13.4144C7.78925 13.0393 7.99996 12.5306 7.99996 12.0002C7.99996 11.4698 7.78925 10.9611 7.41418 10.586C7.0391 10.2109 6.5304 10.0002 5.99996 10.0002C5.46953 10.0002 4.96082 10.2109 4.58575 10.586C4.21068 10.9611 3.99996 11.4698 3.99996 12.0002C3.99996 12.5306 4.21068 13.0393 4.58575 13.4144C4.96082 13.7895 5.46953 14.0002 5.99996 14.0002ZM17 8.00021C17.5304 8.00021 18.0391 7.78949 18.4142 7.41442C18.7892 7.03935 19 6.53064 19 6.00021C19 5.46977 18.7892 4.96107 18.4142 4.58599C18.0391 4.21092 17.5304 4.00021 17 4.00021C16.4695 4.00021 15.9608 4.21092 15.5857 4.58599C15.2107 4.96107 15 5.46977 15 6.00021C15 6.53064 15.2107 7.03935 15.5857 7.41442C15.9608 7.78949 16.4695 8.00021 17 8.00021ZM17 20.0002C17.5304 20.0002 18.0391 19.7895 18.4142 19.4144C18.7892 19.0393 19 18.5306 19 18.0002C19 17.4698 18.7892 16.9611 18.4142 16.586C18.0391 16.2109 17.5304 16.0002 17 16.0002C16.4695 16.0002 15.9608 16.2109 15.5857 16.586C15.2107 16.9611 15 17.4698 15 18.0002C15 18.5306 15.2107 19.0393 15.5857 19.4144C15.9608 19.7895 16.4695 20.0002 17 20.0002Z" fill="#F2A602"/>
                                                </svg>
                                              </div>
                                            </div>
                  @if(!$isMobile)

                                            <div class="text-wrapper-51">Read Now</div>
                  @endif

                                          </div>
                                        </div>
                                      </div>
              @endforeach

           @else
           @foreach ($blogs as $blog)

           <div class="frame-81">
             <a href="{{ route('blog.details', ['slug' => $blog->slug]) }}">
               <div class="frame-82">
{{--
                 <img class="rectangle-3" src="{{ asset('storage/' . $blog->images->first()->path) }}"
                       alt="{{ $blog->images->first()->alt }}" /> --}}

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
@if ($isMobile)

                     <svg
                       xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none">
@else

                       <svg
                         xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
@endif

                         <g clip-path="url(#clip0_367_327)">
                           <path d="M0 9.33327C0 6.81859 -7.94731e-08 5.56259 0.781336 4.78125C1.56267 3.99992 2.81868 3.99992 5.33335 3.99992H18.6667C21.1814 3.99992 22.4374 3.99992 23.2187 4.78125C24.0001 5.56259 24.0001 6.81859 24.0001 9.33327H0Z" fill="#233F8C"/>
                           <path d="M2.66694 4.9999H21.3336C22.254 4.99998 23.0005 5.74642 23.0005 6.66686V21.3336C23.0004 22.2539 22.2539 22.9994 21.3336 22.9995H2.66694C1.74653 22.9995 1.00011 22.2539 0.99998 21.3336V6.66686C0.99998 5.74637 1.74645 4.9999 2.66694 4.9999Z" stroke="#233F8C" stroke-width="2"/>
                           <path d="M5.33436 1.49997V5.49998M18.6677 1.49997V5.49998" stroke="#233F8C" stroke-width="2" stroke-linecap="round"/>
                         </g>
                         <defs>
                           <clipPath id="clip0_367_327">
                             <rect width="24.0006" height="24" fill="white"/>
                           </clipPath>
                         </defs>
                       </svg>
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
@if ($isMobile)

                         <svg
                           xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none">
@else

                           <svg
                             xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
@endif

                             <path d="M13.12 17.0232L8.92096 14.7332C8.37276 15.3193 7.66095 15.7269 6.87803 15.9031C6.09512 16.0793 5.27731 16.0159 4.53088 15.7212C3.78445 15.4266 3.14392 14.9142 2.69253 14.2506C2.24114 13.5871 1.99976 12.8032 1.99976 12.0007C1.99976 11.1982 2.24114 10.4143 2.69253 9.75076C3.14392 9.08725 3.78445 8.57486 4.53088 8.28017C5.27731 7.98548 6.09512 7.92211 6.87803 8.09832C7.66095 8.27452 8.37276 8.68214 8.92096 9.2682L13.121 6.97821C12.8829 6.03417 12.9973 5.0357 13.4427 4.16997C13.8881 3.30424 14.634 2.63069 15.5405 2.27557C16.447 1.92046 17.452 1.90816 18.3669 2.24098C19.2818 2.57381 20.044 3.2289 20.5105 4.08347C20.977 4.93804 21.1157 5.9334 20.9008 6.88299C20.6859 7.83257 20.132 8.67116 19.343 9.24158C18.554 9.81199 17.5841 10.0751 16.615 9.98147C15.6459 9.88789 14.7442 9.44406 14.079 8.7332L9.87896 11.0232C10.0402 11.6646 10.0402 12.3358 9.87896 12.9772L14.079 15.2672C14.7446 14.5567 15.6464 14.1133 16.6156 14.0202C17.5847 13.9271 18.5545 14.1906 19.3432 14.7614C20.1319 15.3322 20.6854 16.171 20.8999 17.1207C21.1143 18.0703 20.9751 19.0656 20.5083 19.9199C20.0414 20.7743 19.279 21.429 18.3639 21.7615C17.4489 22.0939 16.444 22.0812 15.5376 21.7257C14.6313 21.3702 13.8857 20.6964 13.4406 19.8305C12.9955 18.9646 12.8815 17.9661 13.12 17.0222V17.0232ZM5.99996 14.0002C6.5304 14.0002 7.0391 13.7895 7.41418 13.4144C7.78925 13.0393 7.99996 12.5306 7.99996 12.0002C7.99996 11.4698 7.78925 10.9611 7.41418 10.586C7.0391 10.2109 6.5304 10.0002 5.99996 10.0002C5.46953 10.0002 4.96082 10.2109 4.58575 10.586C4.21068 10.9611 3.99996 11.4698 3.99996 12.0002C3.99996 12.5306 4.21068 13.0393 4.58575 13.4144C4.96082 13.7895 5.46953 14.0002 5.99996 14.0002ZM17 8.00021C17.5304 8.00021 18.0391 7.78949 18.4142 7.41442C18.7892 7.03935 19 6.53064 19 6.00021C19 5.46977 18.7892 4.96107 18.4142 4.58599C18.0391 4.21092 17.5304 4.00021 17 4.00021C16.4695 4.00021 15.9608 4.21092 15.5857 4.58599C15.2107 4.96107 15 5.46977 15 6.00021C15 6.53064 15.2107 7.03935 15.5857 7.41442C15.9608 7.78949 16.4695 8.00021 17 8.00021ZM17 20.0002C17.5304 20.0002 18.0391 19.7895 18.4142 19.4144C18.7892 19.0393 19 18.5306 19 18.0002C19 17.4698 18.7892 16.9611 18.4142 16.586C18.0391 16.2109 17.5304 16.0002 17 16.0002C16.4695 16.0002 15.9608 16.2109 15.5857 16.586C15.2107 16.9611 15 17.4698 15 18.0002C15 18.5306 15.2107 19.0393 15.5857 19.4144C15.9608 19.7895 16.4695 20.0002 17 20.0002Z" fill="#F2A602"/>
                           </svg>
                         </div>
                       </div>
@if(!$isMobile)

                       <div class="text-wrapper-51">Read Now</div>
@endif

                     </div>
                   </div>
                 </div>
@endforeach
           @endif


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
                                    <div class="frame-89">
                                      <div class="text-wrapper-6">Read More Blogs</div>
                                      <svg
                                        xmlns="http://www.w3.org/2000/svg" width="19" height="11" viewBox="0 0 19 11" fill="none">
                                        <path d="M1.28378 1.28378L9.50001 9.5L17.7162 1.28378" stroke="#F2A602" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                      </svg>
                                    </div>
                                  </div>
                                  <div class="div-3">
                                    <div class="frame-27">
                                      <div class="text-wrapper-26">In the news</div>
                                      <div class="frame-10">
                                        <div class="text-wrapper-6">View All</div>
                                        <img src="/front/images/orange_arrow.svg" alt="orange_arrow">
                                      </div>
                                    </div>
                                    <div class="partners_we_work_logo1">
                                        <a href=" https://republicnewsindia.com/aarogyaa-bharat-the-pune-based-startup-revolutionizing-access-to-medical-equipment-across-india/">
                                        <img src="{{ asset('front/images/Republic-News-India-New-Logo-PNG.png') }}" alt="image">
                                    </a>
                                    <a href=" https://theindianbulletin.com/aarogyaa-bharat-the-pune-based-startup-revolutionizing-access-to-medical-equipment-across-india/">
                                        <img src="{{ asset('front/images/The-Indian-Bulletin-LOGO-02-300x75.jpg') }}" alt="image">
                                    </a>
                                        <!-- <img src="/front/images/Frame_1.png" alt="" /><img src="/front/images/Frame_2.png" alt="" /><img src="/front/images/Frame_3.png" alt="" /><img src="/front/images/Frame_4.png" alt="" /><img src="/front/images/Frame_5.png" alt="" /><img src="/front/images/Frame_6.png" alt="" /> -->
                                      </div>
                                  </div>
                                  <div class="div-3">
                                    <div class="frame-27">
                                      <div class="text-wrapper-5">Related Videos</div>
                                      <div class="frame-10">
                                        <div class="text-wrapper-6">View All</div>
                                        <img src="/front/images/orange_arrow.svg" alt="orange_arrow">
                                      </div>
                                    </div>
                                    <div class="frame-95">
                                      <div class="frame-96">
                                        <script>
                                            var tag = document.createElement('script');
                                            tag.src = "https://www.youtube.com/iframe_api";
                                            var firstScriptTag = document.getElementsByTagName('script')[0];
                                            firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
                                          </script>

                                          <!-- HTML Embed -->
                                          <div id="video-container">
                                            <iframe
                                              id="aarogyaaVideo"
                                              width="315"
                                              height="180"
                                              src="https://www.youtube.com/embed/MIc299Flibs?enablejsapi=1&origin=https://aarogyaabharat.com"
                                              title="Aarogyaa Bharat YouTube Video"
                                              frameborder="0"
                                              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                              referrerpolicy="strict-origin-when-cross-origin"
                                              allowfullscreen
                                            ></iframe>
                                          </div>

                                          <!-- YouTube API & GA4 Event Push -->
                                          <script>
                                            var player;
                                            function onYouTubeIframeAPIReady() {
                                              player = new YT.Player('aarogyaaVideo', {
                                                events: {
                                                  'onStateChange': onPlayerStateChange
                                                }
                                              });
                                            }

                                            function onPlayerStateChange(event) {
                                              if (event.data == YT.PlayerState.PLAYING) {
                                                // Push event to GA4 dataLayer
                                                window.dataLayer = window.dataLayer || [];
                                                dataLayer.push({
                                                  event: 'video_play',
                                                  video_title: 'Aarogyaa Bharat Healthcare Video',
                                                  video_id: 'MIc299Flibs',
                                                  video_platform: 'YouTube'
                                                });
                                              }
                                            }
                                          </script>

                                      </div>
                                      <div class="frame-96">
                                        <img class="" src="{{ asset('front/images/Videos_section.png') }}"/>
                                      </div>
                                      <div class="frame-96">
                                        <img class="" src="{{ asset('front/images/Videos_section.png') }}"/>
                                      </div>
                                      <div class="frame-96">
                                        <img class="" src="{{ asset('front/images/Videos_section.png') }}"/>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="div-3">
                                    <div class="frame-64">
                                      <div class="text-wrapper-8">Why Aarogya Bharat ..?</div>
                                      <p class="text-wrapper-55">
              We prioritize our clients, understanding their unique needs and preferences. Our client-centric approach
              ensures that our products and services align seamlessly with the requirements of our valued customers.
            </p>
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
                                    <div class="text-wrapper-8">About Aarogya Bharat</div>
                                    <div class="frame-108">
                                      <p class="text-wrapper-58">
              A wheelchair is a chair fitted with wheels. The device comes in variations allowing either manual
              propulsion by the seated occupant turning the rear wheels by hand or electric propulsion by motors.A
              wheelchair is a chair fitted with wheels. The device comes in variations allowing either manual propulsion
              by the seated occupant turning the rear wheels by hand or electric propulsion by motors.
            </p>
                                      <p class="a-wheelchair-is-a">
                                        <span class="text-wrapper-59"
                >A wheelchair is a chair fitted with wheels. The device comes in variations allowing either manual
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
                                </div>
                                <footer class="footer">
                                  <div class="div-3">
                                    <div class="all_footer_parts">
                                      <div class="footer_acco_box">
                                        <div class="acco_click">
                                          <a href="#;">
                                            <p>Quick links</p>
                                            <img src="{{ asset('front/images/upArrow.svg') }}" alt="upArrow" />
                                          </a>
                                        </div>
                                        <div class="acco_text">
                                          <div class="footer_links">
                                            <div class="links_text">
                                              <ul>
                                                <li>
                                                  <a href="{{ route('customer.about.us') }}">About</a>
                                                </li>
                                                <li>
                                                  <a href="{{ route('privacy.policy') }}">Privacy Policy</a>
                                                </li>
                                              </ul>
                                            </div>
                                            <div class="links_text">
                                              <ul>
                                                <li>
                                                  <a href="{{ route('blogs') }}">Blogs</a>
                                                </li>
                                                <li>
                                                  <a href="{{ route('faqs') }}">FAQ's</a>
                                                </li>
                                              </ul>
                                            </div>
                                            <div class="links_text">
                                              <ul>
                                                <li>
                                                  <a href="{{ route('write.to.us') }}">Write For Us</a>
                                                </li>
                                                <li>
                                                  <a href="{{ route('front.contact') }}">Contact us</a>
                                                </li>
                                {{--
                                                <li>
                                                  <a href="{{ route('faqs') }}">Frequently Asked Questions</a>
                                                </li>
                                                <li>
                                                  <a href="{{ route('front.contact') }}">Contact us</a>
                                                </li> --}}

                                              </ul>
                                            </div>
                                            <div class="links_text">
                                              <ul>
                                                <li>
                                                  <a href="{{ route('terms.and.conditions') }}">Terms and Condtions</a>
                                                </li>
                                              </ul>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="footer_acco_box">
                                        <div class="acco_click">
                                          <a href="#;">
                                            <p>Popular Products</p>
                                            <img src="{{ asset('front/images/upArrow.svg') }}" alt="upArrow" />
                                          </a>
                                        </div>
                                        <div class="acco_text">
                                          <div class="Products_tag">
                        @if (isset($popularProducts))

                                            <ul>
                                @foreach ($popularProducts as $product)

                                              <li>
                                                <a href="{{ route('products.sub.category.wise', ['slug' => $product->category->slug,'subSlug'=>$product->slug]) }}">
                                                  <p>{{ $product->name }}</p>
                                                  <!-- <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"> -->
                                                </a>
                                              </li>
                                @endforeach

                                            </ul>
                        @endif

                                          </div>
                                        </div>
                                      </div>
                                      <div class="footer_acco_box">
                                        <div class="acco_click">
                                          <a href="#;">
                                            <p>Social connects</p>
                                            <img src="{{ asset('front/images/upArrow.svg') }}" alt="upArrow" />
                                          </a>
                                        </div>
                                        <div class="acco_text">
                                          <div class="social_connects">
                                            <ul>
                                              <li>
                                                <a href="{{ env('FACEBOOK_PAGE_URI') }}">
                                                  <img
                                        src="{{ asset('front/images/facebook.svg') }}" alt="Facebook" />
                                                </a>
                                              </li>
                                              <li>
                                                <a href="{{ env('INSTA_PAGE_URI') }}">
                                                  <img src="{{ asset('front/images/insta.svg') }}"
                                        alt="Insta" />
                                                </a>
                                              </li>
                                              <li>
                                                <a href="{{ env('X_PAGE_URI') }}">
                                                  <img src="{{ asset('front/images/Xtwit.svg') }}"
                                        alt="X" />
                                                </a>
                                              </li>
                                              <li>
                                                <a href="{{ env('YOUTUBE_PAGE_URL') }}" target="_blank">
                                                  <img
                                src="{{ asset('front/images/youtube.png') }}" alt="youtube" />
                                                </a>
                                              </li>
                                              <li>
                                                <a href="https://wa.me/{{ env('HELP_LINE_NO') }}" target="_blank">
                                                  <img
                                        src="{{ asset('front/images/whatsapp.svg') }}" alt="WhatsApp" />
                                                </a>
                                              </li>
                                            </ul>
                                          </div>
                                          <!-- <div class="emergency_help"><h2>Need an emergency help</h2><ul><li><a href="tel:{{ env('HELP_LINE_NO') }}"><img src="{{ asset('front/images/phone_call.svg') }}" alt="" /><p>{{ env('HELP_LINE_NO') }}</p><span>Call Now</span></a></li><li><a href="mailto:{{ env('HELP_LINE_EMAIL') }}"><img src="{{ asset('front/images/mail.svg') }}" alt="" /><p>{{ env('HELP_LINE_EMAIL') }}</p></a></li></ul></div> -->
                                        </div>
                                        <div class="emergency_help">
                                          <h2>Need an emergency help</h2>
                                          <ul>
                                            <li>
                                              <a href="tel:{{ env('HELP_LINE_NO') }}">
                                                <img
                                    src="{{ asset('front/images/phone_call.svg') }}" alt="phone_call" />
                                                <p>{{ env('HELP_LINE_NO') }}</p>
                                                <span>Call Now</span>
                                              </a>
                                            </li>
                                            <li>
                                              <a href="mailto:{{ env('HELP_LINE_EMAIL') }}">
                                                <img
                                    src="{{ asset('front/images/mail.svg') }}" alt="mail" />
                                                <p>{{ env('HELP_LINE_EMAIL') }}</p>
                                              </a>
                                            </li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="frame-120">
                                    <p class="text-wrapper-67">Copyrights © 2020 Aarogya Bharat</p>
                                  </div>
                                </footer>
                              </div>
                            </body>
                              <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
                              <script src="https://code.jquery.com/jquery-3.7.0.min.js" data-reload="true"></script>
                              <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js" data-reload="true"></script>
                              <script>
      function reloadAllScripts() {
      $('script[data-reload="true"]').each(function () {
          var oldScript = $(this);
          var newScript = document.createElement('script');
          newScript.src = oldScript.attr('src') + '?v=' + new Date().getTime(); // cache-buster
          newScript.setAttribute('data-reload', 'true');
          document.body.appendChild(newScript);
          oldScript.remove();
      });
  }



  $(document).ready(function(){
    $('.frame-15').slick({
      infinite: false,
      slidesToShow: 6.6,
      slidesToScroll: 1,

      arrows: false, // 👈 hides next/prev buttons
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 4,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1
          }
        }
      ]
    });
  });
  $(document).ready(function(){
    $('.categories').slick({
      infinite: false,
      slidesToShow: 6,
      slidesToScroll: 2,
      autoplay: true,
      autoplaySpeed: 2000,
      arrows: false, // 👈 hides next/prev buttons

      dots: true,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 5,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 5,
            slidesToScroll: 4
          }
        }
      ]
    });
  });
  $(document).ready(function(){
    $('.frame-44').slick({
      infinite: false,
      slidesToShow: 6,
      slidesToScroll: 2,
      {{-- autoplay: true, --}}
      autoplaySpeed: 2000,
      arrows: false, // 👈 hides next/prev buttons
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 4,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1
          }
        }
      ]
    });
  });
  $(document).ready(function(){
    $('.everyonebuying').slick({
      infinite: false,
      slidesToShow: 3.5,
      slidesToScroll: 2,
      autoplay: true,
      autoplaySpeed: 2000,
      arrows: false, // 👈 hides next/prev buttons
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1.5,
            slidesToScroll: 1
          }
        }
      ]
    });
  });
  $(document).ready(function(){
    $('.blogsimage').slick({
      infinite: false,
      slidesToShow: 4,
      slidesToScroll: 2,
      autoplay: true,
      autoplaySpeed: 2000,
      arrows: false, // 👈 hides next/prev buttons
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1
          }
        }
      ]
    });
  });
  {{-- $(document).ready(function(){
    $('.raise-query-2').slick({
      infinite: false,
      slidesToShow: 3,
      slidesToScroll: 2,
      autoplay: true,
      autoplaySpeed: 2000,
      arrows: false, // 👈 hides next/prev buttons
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
      ]
    });
  }); --}}
  $(document).ready(function(){
    $('.middle').slick({
      infinite: false,
      slidesToShow: 5,
      slidesToScroll: 2,
      autoplay: true,
      autoplaySpeed: 2000,
      arrows: false, // 👈 hides next/prev buttons
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 4,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
      ]
    });
  });
  {{-- $(document).ready(function(){
    $('.frame-90').slick({
      infinite: false,
      slidesToShow: 3,
      slidesToScroll: 2,
      autoplay: true,
      autoplaySpeed: 2000,
      arrows: false, // 👈 hides next/prev buttons
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
      ]
    });
  }); --}}
  $(document).ready(function(){
    $('.frame-95').slick({
      infinite: false,
      slidesToShow: 4,
      slidesToScroll: 2,
      autoplay: true,
      autoplaySpeed: 2000,
      arrows: false, // 👈 hides next/prev buttons
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
      ]
    });
  });
  $(document).ready(function(){
    $('.banner-container').slick({
      infinite: false,
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 2000,
      arrows: false, // 👈 hides next/prev buttons
      dots: true,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
      ]
    });
  });
  </script>
                              <script>
                                function toggleSidebar() {
                                    const sidebar = document.getElementById('sidebarMenu');
                                    const overlay = document.getElementById('overlay');

                                    // Toggle class
                                    sidebar.classList.toggle('open');
                                    overlay.classList.toggle('show');

                                    // Check if it now has the class 'open'
                                    if (sidebar.classList.contains('open')) {
                                      document.body.classList.add('noscroll');
                                    } else {
                                      document.body.classList.remove('noscroll');
                                    }
                                  }

      $(document).ready(function() {
              $('#searchInput').on('keyup', function() {
                  var query = $(this).val(); // Get the input value

                  if (query.length >= 2) { // Trigger search when at least 2 characters are entered
                      $.ajax({
                          url: "{{ route('search.products') }}", // Your route to search products
                          type: 'GET',
                          data: {
                              query: query // Send the input as a query parameter
                          },
                          success: function(response) {
                              if (response.success === false) {
                                  $('#searchResultList').html(' <li>No products found.</li>');
                              } else {
                                  $('#searchResultList').html(response); // Render the results
                              }
                          $("#recentSearch").show()
                          },
                          error: function(xhr, status, error) {
                              console.error(error);
                              $('#searchResultList').html('<li>Something went wrong.</li>');
                          }
                      });
                  } else {
                      $('#searchResultList').empty(); // Clear results if query length is less than 2
                  }
              });
          });

                              </script>
                              <script>
          const input1 = document.getElementById('searchInput');
          const placeholderText = "Search best deals on medical equipment...";
          let i = 0;

          function typePlaceholder() {
              if (i < placeholderText.length) {
                  input1.placeholder += placeholderText.charAt(i);
                  i++;
                  setTimeout(typePlaceholder, 100); // Adjust speed here (milliseconds)
              }
          }
          // Start the animation
          function resetPlaceholder() {
              input1.placeholder = "";
              i = 0;
              typePlaceholder();
          }
          typePlaceholder();
          input1.addEventListener('focus', resetPlaceholder);
          input1.addEventListener('blur', resetPlaceholder);
          // Loop the animation
          input1.addEventListener('input', function() {
              if (input1.value === "") {
              resetPlaceholder();
              }
          });
          // Restart typing animation when finished
          let observer = new MutationObserver(function() {
              if (i < input1.placeholder.length === placeholderText.length) {
              setTimeout(resetPlaceholder, 1500); // Wait before restarting
              }
          });
          observer.observe(input1, { attributes: true, attributeFilter: ['placeholder'] });

                              </script>
                              <script>
    const input = document.getElementById('searchInput');
    const dropdown = document.getElementById('recentSearch');

  //   input.addEventListener('focus', () => {
  //     dropdown.style.display = 'block';
  //   });

    document.addEventListener('click', (e) => {
      if (!document.querySelector('.search-bar').contains(e.target)) {
        dropdown.style.display = 'none';
      }
    });
  </script>
                              <script>
  document.addEventListener("DOMContentLoaded", function () {
    const profileFrames = document.querySelectorAll(".profile-frame");
    const total = profileFrames.length;
    const half = Math.ceil(total / 2); // left side count
    const rightCount = total - half;

    let index = 0;

    function updateRightFrames() {
      for (let i = 0; i < rightCount; i++) {
        // Reverse the left index
        const leftIndex = (half + index - i - 1 + half) % half;
        const left = profileFrames[leftIndex];
        const right = profileFrames[i + half];

        // Get data from left
        const imgSrc = left.querySelector("img")?.getAttribute("src") || '';
        const leftInner = left.querySelector("div[class^='frame-']");
        const leftTextDivs = leftInner?.querySelectorAll("div") || [];
        const name = leftTextDivs[0]?.innerText || '';
        const desc = leftTextDivs[1]?.innerText || '';

        // Set data to right
        right.querySelector("img")?.setAttribute("src", imgSrc);
        const rightInner = right.querySelector("div[class^='frame-']");
        const rightTextDivs = rightInner?.querySelectorAll("div") || [];

        if (rightTextDivs.length >= 2) {
          rightTextDivs[0].innerText = name;
          rightTextDivs[1].innerText = desc;
        }
      }

      // Move backward
      index = (index - 1 + half) % half;
    }

    updateRightFrames();
    setInterval(updateRightFrames, 3000); // Rotate every 3 seconds
  });

                              </script>
                              <script>
  $(document).ready(function () {
      $('.addtocart').on('click', function () {
          var productId = $(this).data('id');
          var $btn = $(this);
          // $btn.prop('disabled', true).addClass('disabled');
          $.ajax({
              url: "{{ route('cart.add', ['productId' => '__ID__']) }}".replace('__ID__', productId),
              method: 'POST',
              data: {
                  _token: "{{ csrf_token() }}"
              },
              success: function (response) {
                  // ✅ Handle success (e.g., update cart count, show toast, etc.)
                  if(response.success){
                  document.getElementById('cartproductcount').innerHTML=response.cartproductcount;
                  document.getElementById('text-btween-cartpopup').innerHTML=response.message;
                  document.getElementById('text-btween-cartpopup').style.color='#2d5a2d';
                  cartPopup();
                  }else{
                  document.getElementById('text-btween-cartpopup').innerHTML=response.message;
                  document.getElementById('text-btween-cartpopup').style.color='red';
                  cartPopup();
                  }
                  $btn.prop('disabled', false).removeClass('disabled');
              },
              error: function (xhr) {
                  // ❌ Handle error
                  $btn.prop('disabled', false).removeClass('disabled');
                  document.getElementById('logoutPopup3').style.display='flex';
              }
          });
      });
  });
    function cartPopup() {
          // const cartBtn = document.getElementById('cartBtn');
          const cartPopup = document.getElementById('cartPopup');

          // cartCount++;
          // cartBtn.textContent = `Cart (${cartCount})`;

          cartPopup.style.display = 'flex';

          // Hide the popup after 3 seconds
          setTimeout(() => {
              cartPopup.style.display = 'none';
          }, 3000);
      }
  </script>
                              <script>
      function changeProductsByCategory(categoryId,clickedElement) {
      console.log("Selected category ID:", categoryId);
      $.ajax({
          url: "{{ route('products.category') }}",
          type: 'GET',
          data: { category_id: categoryId },
          success: function(response) {
              $('#category-products').html(response);

              // Now reload all JS
              document.querySelectorAll('script').forEach(function(oldScript) {
                document.querySelectorAll('.category-tab').forEach(function(el) {
                    el.classList.remove('frame-58');
                    el.classList.add('frame-59');
                  });

                  // Add frame-58 to the clicked one
                  clickedElement.classList.remove('frame-59');
                  clickedElement.classList.add('frame-58');
                          if (oldScript.src) {
                              const newScript = document.createElement('script');
                              newScript.src = oldScript.src;
                              newScript.async = oldScript.async;
                              document.body.appendChild(newScript);
                          }
                      });
          },
          error: function(xhr, status, error) {
              console.error("Error fetching products:", error);
          }
      });
  }
  </script>

</html>

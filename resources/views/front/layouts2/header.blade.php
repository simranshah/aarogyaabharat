<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-D1GEF2BB22"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-TEY1CCE82S');
    </script>
    <script>
        window.dataLayer = window.dataLayer || [];
    </script>
    <!-- Google tag-manger (gtag.js) -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-P8QHT45N');
    </script>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui">
    @if (isset($seoMetaTagTitle))
        <meta name="title" content="{{ $seoMetaTagTitle }}">
    @endif
    @if (isset($seoMetaTag))
        <meta name="description" content="{{ $seoMetaTag }}">
    @endif
    <title>
        @if (isset($pageTitle))
            {{ $pageTitle }}
        @endif
    </title>

    {{-- <link rel="stylesheet" href="{{ asset('front/css/slick.css') }}?v={{ time() }}" type="text/css"
        media="screen" />
    <link rel="stylesheet" href="{{ asset('front/css/slick-theme.css') }}?v={{ time() }}" type="text/css"
        media="screen" /> --}}
       
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}?v={{ time() }}" type="text/css"
        media="screen" />
        <link rel="stylesheet" href="{{ asset('front/css/new-home.css') }}?v={{ time() }}" type="text/css" media="screen" />
    <link rel="stylesheet" href="{{ asset('front/css/sweetalert.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('front/css/toaster.css') }}?v={{ time() }}">
    <link rel="icon" href="{{ asset('front/images/Favicon-new.svg') }}" type="image/x-icon">
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-16811101057"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'AW-16811101057');
    </script>
    <link rel="preload" href="{{ asset('front/images/pentagon_img.png') }}" as="image" type="image/webp">
    <link rel="preload" href="{{ asset('front/images/qtback.png') }}" as="image" type="image/svg+xml">
    <link rel="preload" href="{{ asset('front/images/qtback.png') }}" as="image" type="image/svg+xml">
    <link rel="preload" href="{{ asset('front/images/slider_orange_arrow.svg') }}" as="image"
        type="image/svg+xml">
    <link rel="preload" href="{{ asset('front/images/slider_orange_arrow_2.svg') }}" as="image"
        type="image/svg+xml">
    <link rel="preload" href="{{ asset('front/images/grean_tick.png') }}" as="image" type="image/svg+xml">
    <link rel="preload" href="{{ asset('front/images/carbon_view.svg') }}" as="image" type="image/svg+xml">
    <link rel="preload" href="{{ asset('front/images/ri_share-line.svg') }}" as="image" type="image/svg+xml">
    <link rel="preload" href="{{ asset('front/images/pin.svg') }}" as="image" type="image/svg+xml">
    <link rel="preload" href="{{ asset('front/images/notification.svg') }}" as="image" type="image/svg+xml">
    <link rel="preload" href="{{ asset('front/images/arogya_bharat.svg') }}" as="image" type="image/svg+xml">
    <link rel="preload" href="{{ asset('front/images/orange_arrow.svg') }}" as="image" type="image/svg+xml">
    <link rel="preload" href="{{ asset('front/images/samll_chat_gpt.svg') }}" as="image" type="image/svg+xml">
    <link rel="preload" href="{{ asset('front/images/empty_star.svg') }}" as="image" type="image/svg+xml">
    <link rel="preload" href="{{ asset('front/images/cart.svg') }}" as="image" type="image/svg+xml">
    <link rel="preload" href="{{ asset('front/images/cross.svg') }}" as="image" type="image/svg+xml">
    <link rel="preload" href="{{ asset('front/images/search.svg') }}" as="image" type="image/svg+xml">
    <link rel="preload" href="{{ asset('front/images/downArrow.svg') }}" as="image" type="image/svg+xml">
    <link rel="preload" href="{{ asset('front/images/Wp_me.png') }}" as="image" type="image/svg+xml">
    <link rel="preload" href="{{ asset('front/images/chat_bot_img.png') }}" as="image" type="image/svg+xml">
    <link rel="preload" href="{{ asset('front/images/calendar.svg') }}" as="image" type="image/svg+xml">
    <link rel="preload" href="{{ asset('front/images/logo_mini.svg') }}" as="image" type="image/svg+xml">
    <link rel="preload" href="{{ asset('front/fonts/NunitoSans_10pt-Regular.ttf') }}" as="font"
        type="font/ttf" crossorigin="anonymous">
    <link rel="preload" href="{{ asset('front/fonts/NunitoSans_10pt-Medium.ttf') }}" as="font"
        type="font/ttf" crossorigin="anonymous">
    <link rel="preload" href="{{ asset('front/fonts/NunitoSans_10pt-Bold.ttf') }}" as="font" type="font/ttf"
        crossorigin="anonymous">
        
        @php
        $isMobile =
            request()->header('User-Agent') &&
            preg_match('/mobile|android|iphone|ipad|phone/i', request()->header('User-Agent'));
    @endphp

</head>
  <body>
    <div class="home-d">
     
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
                  @if (Auth::check() && Auth::user()->hasRole('Customer'))
                  <a href="{{ route('customers.profile') }}">
                    <div class="profile-inline-vertical">
                      <img src="{{ asset('front/images/Profile_img.svg') }}" alt="Profile" class="profile_fil" />
                      <span class="profile-name">{{ ucfirst(strtolower(explode(' ', Auth::user()->name)[0])) }}</span>
                    </div>
                  </a>
                  @else
                  <a href="{{ route('login') }}">Sign in</a> |
                  <a href="{{ route('register') }}">Register</a>
                  @endif
                </div>
                <ul class="menu-section">
                  <li>
                    <a href="{{ route('products.list') }}"> <strong>Products</strong></a>
                    {{-- <span class="toggle">+</span> --}}
                  </li>
                  <li>
                    <strong>Offers</strong>
                  </li>
                  <li class="category-toggle">
                    <strong>Category</strong>
                    <span class="toggle" id="categoryToggleBtn">+</span>
                  </li>
                  <ul class="sub-menu" id="categorySubMenu" style="display: none;">
                    @foreach ($categories as $category)
  @if (is_object($category) && isset($category->slug))
    <a href="{{ route('products.category.wise', ['slug' => $category->slug]) }}" style="text-decoration: none;">
      <li class="sub-item">{{ $category->name }}<span class="arrow">›</span></li>
    </a>
  @endif
@endforeach

                  </ul>
                </ul>
              </div>
              <!-- Overlay -->
              <div class="overlay" id="overlay" onclick="toggleSidebar()"></div>
             @endif

              <div class="">
               <a href="{{ url('/new-home') }}"> <img src="{{ asset('front/images/arogya_bharat.svg') }}" class="logo-AB" /></a>
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
                  <input type="text" id="searchInput" class="text-wrapper-3" placeholder="" />
                </div>
              </div>
              <div class="recent-search-dropdown" id="recentSearch">
                <ul id="searchResultList"></ul>
              </div>
              @if (!$isMobile)
<div class="notificationpopupjs">
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
            </div>
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

            @if (Auth::check() && Auth::user()->hasRole('Customer'))
            <a href="{{ route('customers.profile') }}">
              <img src="{{ asset('front/images/Profile_img.svg') }}" alt="Profile"
                  class="profile_fil">
              <div class="text-center mt-1 text-sm font-low" style="font-size: 9px;font-weight: bold;">
                  {{ ucfirst(strtolower(explode(' ', Auth::user()->name)[0])) }}
              </div>
          </a>
            @else
                <button class="login-button">
                  <a href="{{ route('login') }}">
                    <div class="text-wrapper-4">Login</div>
                  </a>
                </button>
                @endif
                @endif
            {{-- @endif --}}

              </div>
            </div>
          </div>


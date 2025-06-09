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

    <link rel="stylesheet" href="{{ asset('front/css/slick.css') }}?v={{ time() }}" type="text/css"
        media="screen" />
    <link rel="stylesheet" href="{{ asset('front/css/slick-theme.css') }}?v={{ time() }}" type="text/css"
        media="screen" />
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}?v={{ time() }}" type="text/css"
        media="screen" />
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

</head>

<body class="bodyback">
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P8QHT45N" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>

    <header>
        <div class="container">
            <div class="headerBlock">
                <a href="{{ route('home') }}" class="logoPart">
                    <img src="{{ asset('front/images/arogya_bharat.svg') }}" alt="Logo">
                </a>
                <ul class="menuList">
                    <li id="home" class="{{ Route::currentRouteName() == 'home' ? 'active' : '' }}"><a
                            href="{{ route('home') }}">Home</a></li>
                    <li class="{{ Route::currentRouteName() == 'products' ? 'active' : '' }}"><a
                            href="{{ route('products') }}">Products</a></li>
                    <li id="offerLink"><a href="{{ route('products.flash.sale') }}">Offers</a></li>
                    <li class="{{ Route::currentRouteName() == 'blogs' ? 'active' : '' }}"><a
                            href="{{ route('blogs') }}">Blogs</a></li>
                    {{-- <li class="{{ Route::currentRouteName() == 'customer.about.us' ? 'active' : '' }}"><a href="{{route('customer.about.us')}}">About</a></li> --}}
                </ul>
                @if (Auth::check() && Auth::user()->hasRole('Customer'))
                    {{-- <div class="loginBtn"> --}}
                    @php
                        $fullName = Auth::user()->name;
                        $nameParts = explode(' ', $fullName);
                        $firstName = ucfirst(strtolower($nameParts[0]));
                    @endphp
                    {{-- <a href="{{route('customers.profile')}}"><img src="{{ asset('front/images/Profile_img.svg') }}" alt="notification"></a>
                </div> --}}
                @else
                    <div class="loginBtn1">
                        <a href="{{ route('login') }}"><button>Login</button></a>
                    </div>
                @endif
                <ul class="cartsUl">
                    <li>
                        <a href="https://wa.me/+919921407039">
                            <img src="/front/images/Wp_me.png" alt="whatsapp">
                        </a>
                    </li>
                    <li>
                        <a class="notificationpopupjs"> <img src="{{ asset('front/images/notification.svg') }}"
                                alt="notification">
                            @if (auth()->check() && auth()->user()->notifications->count() > 0)
                                <span id="notify-count"></span>
                            @endif

                        </a>
                    </li>
                     <div class="cart-popup" id="cartPopup">
                                     <p class="popup-text">Item Added to Cart</p>
                                    </div>
                    <li>
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

                        @if (Auth::check() && Auth::user()->hasRole('Customer'))
                            <!-- Display Cart Link -->
                            <a href="{{ route('cart') }}"><img src="{{ asset('front/images/cart.svg') }}"
                                    alt="Cart"><span>{{ $cartProductCount1 ?? 0 }}</span></a>
                        @else
                            <!-- Trigger Login Popup -->
                            <a href="javascript:void(0)" class="trigger-login-popup"><img
                                    src="{{ asset('front/images/cart.svg') }}"
                                    alt="cart"><span>{{ $cartProductCount1 ?? 0 }}</span></a>
                                    
                        @endif
                    </li>
                   
                    @if (Auth::check() && Auth::user()->hasRole('Customer'))
                        <li>
                            <a href="{{ route('customers.profile') }}">
                                <img src="{{ asset('front/images/Profile_img.svg') }}" alt="Profile"
                                    class="profile_fil">
                                <div class="text-center mt-1 text-sm font-low" style="font-size: 9px;font-weight: bold;">
                                    {{ ucfirst(strtolower(explode(' ', Auth::user()->name)[0])) }}
                                </div>
                            </a>
                        </li>
                    @endif
                </ul>
                {{-- <div id="customerlocationPin">
                    @include('front.common.customer-pin')
                </div> --}}
                <div class="SearchBlock">
                    <div>
                        <button><img src="{{ asset('front/images/search.svg') }}" alt="search"></button>
                        <input type="text" id="searchInput" placeholder=""
                            onkeydown="
                        if (event.keyCode === 13) {
                          searchproductinput(this.value);
                         }
                        ">
                        <a href="#"><img src="{{ asset('front/images/search_arrow.svg') }}"
                                alt="search_arrow"> </a>
                    </div>
                    <a href="#;"><img src="{{ asset('front/images/cross.svg') }}" alt="cross" /> </a>
                </div>
            </div>
            
        </div>
        {{-- <div class="headerBlock" style="padding: 1px;background-color: #220D6D;color: white; text-align: right;">
            <div class="nav-emg-header-inner">
                <div class="nav-emg-container">
                    <div class="nav-emg-header-text">
                        <p class="nav-emg-contact-label" style="font-weight: bold;">Need Help ?</p>
                        <a href="https://wa.me/+919921407039" class="nav-emg-contact-link" target="_blank">
                            <img src="/front/images/Wp_me.png" alt="Call" class="nav-emg-contact-icon">
                            <p class="nav-emg-contact-info" style="font-weight: bold;">+91 9921407039</p>
                        </a>
                    </div>
                </div>
            </div>
        </div> --}}
    </header>
    @php
        $isMobile =
            request()->header('User-Agent') &&
            preg_match('/mobile|android|iphone|ipad|phone/i', request()->header('User-Agent'));
    @endphp
    {{-- @if (!Route::is('products.flash.sale') && !Route::is('cart'))
        @if ($isMobile)
            <button class="flash-sale-flash-button"
                onclick="document.querySelector('.flash-sale-popup-overlay').style.display='flex'">
                🎉 70% OFF!
            </button>
        @else
            <button class="flash-sale-flash-button"
                onclick="document.querySelector('.flash-sale-popup-overlay').style.display='flex'">
                🎉 70% OFF! Click Here
            </button>
        @endif
    @endif --}}

    <!-- Popup -->
    <div class="flash-sale-popup-overlay" onclick="this.style.display='none'" id="flash-sale-popup-overlay">
        <div class="flash-sale-popup" onclick="event.stopPropagation()">
            <div class="flash-sale-popup-header">
                <div class="flash-sale-close-btn"
                    onclick="document.querySelector('.flash-sale-popup-overlay').style.display='none'">&times;</div>
                <h2>FLASH Offer</h2>
                <p>Limited Time Offer</p>
            </div>
            <div class="flash-sale-popup-body">
                <h3>Introductory Special Discount</h3>
                <div class="flash-sale-discount">70% OFF</div>
                <p class="flash-sale-desc">On Bestselling medical equipment</p>
                <div class="flash-sale-timer">
                    <div class="flash-sale-timer-box">
                        <span id="hrs">12</span>
                        <small>Hours</small>
                    </div>
                    <div class="flash-sale-timer-box">
                        <span id="mins">00</span>
                        <small>Minutes</small>
                    </div>
                    <div class="flash-sale-timer-box">
                        <span id="secs">00</span>
                        <small>Seconds</small>
                    </div>
                </div>
                <a href="{{ route('products.flash.sale') }}"><button class="flash-sale-shop-btn">Shop
                        Now</button></a>
            </div>
        </div>
    </div>
    <div id="chat-toggle">
        <img src="{{ asset('front/images/chat_bot_img.png') }}" alt="Chat Icon">
    </div>
<div class="log-out">
<div class="popup-overlay" id="logoutPopup3" style="display: none;">
    <div class="popup">
      <button class="close-btn" onclick="document.getElementById('logoutPopup3').style.display='none';">&times;</button>
      <img src="{{asset('front/images/server_isuue.svg')}}" alt="Logout" class="popup-image1" />
      {{-- <h2 class="popup-title">Come back soon!</h2> --}}
      <p class="popup-text">Something Went Wrong !</p>
      <div class="popup-buttons">
        <a href="{{route('raise.query')}}"><button class="btn yes-btn" style="padding: 10px 1px;" >Raise Query</button></a>
        <button class="btn cancel-btn" onclick="document.getElementById('logoutPopup3').style.display='none';">Cancel</button>
      </div>
    </div>
  </div>
 </div>
    <!-- Chat Popup -->
    <div class="chat-popup" id="chatbox">
        <div class="chat-header">
            <img src="{{ asset('front/images/samll_chat_gpt.svg') }}" alt="Bot">
            <span>Aarogyaa</span>
            <div class="close-btn" id="close-chat">✕</div>
        </div>
        <div class="chat-body" id="chat-body"></div>
        <div class="chat-input">
            <button id="add-btn">+</button>
            <input type="text" id="chat-input" placeholder="Ask Aarogyaa..." />
            <button id="send-btn">➤</button>
        </div>
    </div>
    <div class="searchPop winScrollStop">
        <div class="searchPopBlock">
            <strong>Recent Search</strong>
            <p>Our highest rented or buying products.</p>
            <ul id="searchResultList">
                @include('front.common.search-product-result')
            </ul>
        </div>
    </div>
    <div id="notification-pop">

    </div>

    <!-- use re-captcha route  -->
    {{-- <form id="demo-form">

    @csrf
    <button class="g-recaptcha" 
            data-sitekey="{{ env('GOOGLE_RECATCHA_SITE_KEY') }}" 
            data-callback="onSubmit" style="display: none;">Submit
    </button>
</form> --}}
    <script src="{{ asset('front/js/jquery.min.js') }}"></script>
    <script src="{{ asset('front/js/script.js') }}"></script>
    <script src="{{ asset('front/js/sweetalert.js') }}"></script>
    <script src="{{ asset('front/js/toaster.js') }}"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
     <script>
        // Check if countdown end time is already in localStorage
        let countdownDate = localStorage.getItem("countdownEndTime");

        if (!countdownDate) {
            // Set countdown to 99 hours from now and store it
            countdownDate = new Date().getTime() + 99 * 60 * 60 * 1000;
            localStorage.setItem("countdownEndTime", countdownDate);
        } else {
            countdownDate = parseInt(countdownDate);
        }

        const updateTimer = () => {
            const now = new Date().getTime();
            const distance = countdownDate - now;

            if (distance <= 0) {
                document.getElementById("hrs").innerText = "00";
                document.getElementById("mins").innerText = "00";
                document.getElementById("secs").innerText = "00";
                localStorage.removeItem("countdownEndTime"); // Optional: reset after end
                return;
            }

            const hrs = Math.floor((distance / (1000 * 60 * 60)));
            const mins = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const secs = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("hrs").innerText = hrs.toString().padStart(2, '0');
            document.getElementById("mins").innerText = mins.toString().padStart(2, '0');
            document.getElementById("secs").innerText = secs.toString().padStart(2, '0');
        };
        
        const toggleBtn = document.getElementById('chat-toggle');
        const closeBtn = document.getElementById('close-chat');
        const chatbox = document.getElementById('chatbox');
        const chatBody = document.getElementById('chat-body');
        const input = document.getElementById('chat-input');
        const sendBtn = document.getElementById('send-btn');

        let lastQuery = "";
        let typingEl;

        function formatMarkdown(text) {
            return text.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
        }

        function addMessage(text, sender = "user") {
            const wrapper = document.createElement("div");
            wrapper.className = `message-wrapper ${sender}`;

            const name = document.createElement("div");
            name.className = "sender-name";
            name.textContent = sender === "user" ? "You :" : "Aarogya :";

            const msg = document.createElement("div");
            msg.className = "message";
            msg.innerHTML = formatMarkdown(text);

            wrapper.appendChild(name);
            wrapper.appendChild(msg);
            chatBody.appendChild(wrapper);
            chatBody.scrollTop = chatBody.scrollHeight;
        }

        function showTypingIndicator() {
            typingEl = document.createElement("div");
            typingEl.className = "message-wrapper bot";

            const name = document.createElement("div");
            name.className = "sender-name";
            name.textContent = "";

            const typingText = document.createElement("div");
            typingText.className = "typing-indicator";
            typingText.innerHTML = `
  <div class="typing-wrapper">
    <span class="typing-dots">
      <span class="dot"></span>
      <span class="dot"></span>
      <span class="dot"></span>
    </span>
  </div>`;



            typingEl.appendChild(name);
            typingEl.appendChild(typingText);
            chatBody.appendChild(typingEl);
            chatBody.scrollTop = chatBody.scrollHeight;
        }

        function hideTypingIndicator() {
            if (typingEl) {
                chatBody.removeChild(typingEl);
                typingEl = null;
            }
        }

        async function handleSend() {
            const userInput = input.value.trim();
            if (!userInput) return;

            addMessage(userInput, "user");
            input.value = "";

            showTypingIndicator();

            try {
                const payload = {
                    query: userInput
                };
                if (lastQuery) payload.old_query = lastQuery;

                const response = await fetch("https://chatbot-abl-1.onrender.com/chat", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify(payload)
                });

                const data = await response.json();
                const reply = data.response;

                hideTypingIndicator();
                addMessage(reply, "bot");

                if (reply.includes("I couldn’t find a matching product")) {
                    lastQuery = userInput;
                } else {
                    lastQuery = "";
                }

            } catch (err) {
                hideTypingIndicator();
                addMessage("⚠️ Could not connect to server.", "bot");
            }
        }

        sendBtn.addEventListener("click", handleSend);
        input.addEventListener("keypress", (e) => {
            if (e.key === "Enter") handleSend();
        });

        toggleBtn.addEventListener("click", () => {
            chatbox.style.display = "flex";
            toggleBtn.style.display = "none";
        });

        closeBtn.addEventListener("click", () => {
            chatbox.style.display = "none";
            toggleBtn.style.display = "block";
        });

        function addMessage(text, sender = "user") {
            const wrapper = document.createElement("div");
            wrapper.className = `message-wrapper ${sender}`;
            if (sender === "bot") {
                document.getElementById("chat-input").disabled = false; // Disable input for bot messages
                // Place bot image and message in a flex row
                const botRow = document.createElement("div");
                botRow.className = "bot-row";
                botRow.style.display = "flex";
                botRow.style.alignItems = "center";
                botRow.style.gap = "8px";

                const botImage = document.createElement("img");
                botImage.src = "{{ asset('front/images/msg_chat_bot.svg') }}";
                botImage.style.alignSelf = "flex-start";
                botImage.alt = "Bot";
                botImage.className = "bot-image";

                const msg = document.createElement("div");
                msg.className = "message";
                msg.innerHTML = formatMarkdown(text);

                botRow.appendChild(botImage);
                botRow.appendChild(msg);
                wrapper.appendChild(botRow);
                chatBody.appendChild(wrapper);
                chatBody.scrollTop = chatBody.scrollHeight;
                return;
            } else {
                document.getElementById("chat-input").disabled = true; // Enable input for user messages
            }
            const msg = document.createElement("div");
            msg.className = "message";
            msg.innerHTML = formatMarkdown(text);
            // msg.appendChild(botImage); // Append the image to the message

            wrapper.appendChild(msg);
            chatBody.appendChild(wrapper);
            chatBody.scrollTop = chatBody.scrollHeight;
        }
        addMessage("Hi! I'm Aarogyaa. How can I help you today?", "bot");
    </script>
     <script>
        const input = document.getElementById('searchInput');
        const placeholderText = "Search best deals on medical equipment...";
        let i = 0;
        
        function typePlaceholder() {
            if (i < placeholderText.length) {
                input.placeholder += placeholderText.charAt(i);
                i++;
                setTimeout(typePlaceholder, 100); // Adjust speed here (milliseconds)
            }
        }
        // Start the animation
        typePlaceholder();
    </script>
    <script>
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
                                $('#searchResultList').html('<li>No products found.</li>');
                            } else {
                                $('#searchResultList').html(response); // Render the results
                            }
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
        //notifications get
        $('.notificationpopupjs').click(function() {
            $.ajax({
                url: '{{ route('customer.notification') }}',
                method: 'GET',
                success: function(data) {
                    if (data.notificationHtml) {
                        $('#notification-pop').html(data.notificationHtml);
                        $('.notificationPop').css('display', 'flex');
                    } else {
                        // toastr.error('No notifications found.');
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 401) {
                        // toastr.error('Please log to see your notifications.');
                    } else {
                        // toastr.error('No notifications found.');
                    }
                }
            });
        });
        $('.notificationBlock > a').click(function() {
            $('.notificationPop').hide();
        });

        function closeonotificationPopUp() {
            $('.notificationPop').hide();
        }
        // $('.trigger-login-popup').click(function(e) {
        //     e.preventDefault();
        //     $('.LoginPop').show();
        // });

        document.addEventListener("DOMContentLoaded", function() {
            if (window.location.hash === "#offer_Part") {
                document.getElementById("offerLink").classList.add("active");
                document.getElementById("home").classList.remove("active");
            }
        });
    </script>
    <script>
        $(document).on('click', '.notidelete', function() {
            let notificationId = $(this).data('id');

            $.ajax({
                url: `/customer/notification/delete/${notificationId}`,
                type: 'GET',
                success: function(response) {
                    if (response.success) {
                        if (response.notificationHtml) {
                            $('#notification-pop').html(response.notificationHtml);
                            if (response.count != 0) {
                                $('#notify-count').text('');
                            } else {
                                $('#notify-count').css('display', 'none');
                            }

                            $('.notificationPop').css('display', 'flex');
                        } else {
                            // toastr.error('No notifications found.');
                        }
                        // toastr.success(response.message); // Show success message
                    } else {
                        // toastr.error('Failed to delete notification');
                    }
                },
                error: function() {
                    if (xhr.status === 401) {
                        // toastr.error('Please log to see your notifications.');
                    } else {
                        // toastr.error('No notifications found.');
                    }
                }
            });
        });

        function searchproductinput(searchvalue) {
            // var checkworld= checkSpelling(searchvalue);
            var url = '{{ url('/search/products/results/') }}/' + searchvalue;
            window.location.href = url;
        }

        function getmoreSearchResult(query, offset) {
            $.ajax({
                url: '{{ url('/search/products/results/') }}/' + query + '/' +
                offset, // Your route to search products
                type: 'GET',

                success: function(response) {
                    $('#searchlist').html(response);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    $('#searchlist').html('<li>Something went wrong.</li>');
                }
            });
        }
         function cartPopup() {
        // const cartBtn = document.getElementById('cartBtn');
        const cartPopup = document.getElementById('cartPopup');

        // cartCount++;
        // cartBtn.textContent = `Cart (${cartCount})`;

        cartPopup.classList.add('show');

        // Hide the popup after 3 seconds
        setTimeout(() => {
            cartPopup.classList.remove('show');
        }, 3000);
    }
    </script>
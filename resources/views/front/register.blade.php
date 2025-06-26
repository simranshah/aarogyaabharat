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
    <script src="{{ asset('front/js/jquery.min.js') }}"></script>
    <script src="{{ asset('front/js/script.js') }}"></script>
    <script src="{{ asset('front/js/sweetalert.js') }}"></script>
    <script src="{{ asset('front/js/toaster.js') }}"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
    <!-- Google tag (gtag.js) -->
</head>
@php
    $isMobile = request()->header('User-Agent') && preg_match('/mobile|android|iphone|ipad|phone/i', request()->header('User-Agent'));
@endphp
<body class="bodyback">
<div class="container">

    <div class="LoginPop winScrollStop" style="display: block;">
        <div class="LoginPopMiddle">
            <div class="LoginPopInner">
                 <div style="position: absolute;top: 37px; z-index: 10;" class="close-login-pop" id="closebtnid">
                    <a href="{{ url('/') }}" class="close-login-pop"><img
                            src="{{ asset('front/images/cross.svg') }}" alt="cross" /></a>
                </div>  
                <div class="Sign_up_form_container">
                    @if(!$isMobile)
                    <div class="Sign_up_form info-box" style="padding: 0px;">
                        <div class="Login_right_container">
                            <div class="Login_right_header">
                                <h1 class="Login_right">Aarogyaa Bharat</h1>
                                <div class="Login_right_tagline">AFFORDABLE - ACCESSIBLE - RELIABLE</div>
                                <div class="Login_right_divider"></div>
                            </div>

                            <div class="Login_right_services">
                                <div class="Login_right_service-card">
                                    <div class="Login_right_icon">
                                        <svg viewBox="0 0 24 24">
                                            <path
                                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                                        </svg>
                                    </div>
                                    <div class="Login_right_service-content">
                                        <h3 class="Login_right">Buy or Rent Medical Equipment:</h3>
                                        <p class="Login_right">Affordable solutions for every need</p>
                                    </div>
                                </div>

                                <div class="Login_right_service-card">
                                    <div class="Login_right_icon">
                                        <svg viewBox="0 0 24 24">
                                            <path
                                                d="M19 7h-3V6a4 4 0 0 0-8 0v1H5a1 1 0 0 0-1 1v11a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V8a1 1 0 0 0-1-1zM10 6a2 2 0 0 1 4 0v1h-4V6zm8 13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V9h2v1a1 1 0 0 0 2 0V9h4v1a1 1 0 0 0 2 0V9h2v10z" />
                                        </svg>
                                    </div>
                                    <div class="Login_right_service-content">
                                        <h3 class="Login_right">Fast Doorstep Delivery:</h3>
                                        <p class="Login_right">Nationwide reach for hassle-free access</p>
                                    </div>
                                    <div class="Login_right_delivery-icon">
                                        
                                    </div>
                                </div>

                                <div class="Login_right_service-card">
                                    <div class="Login_right_icon">
                                        <svg viewBox="0 0 24 24">
                                            <path
                                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                        </svg>
                                    </div>
                                    <div class="Login_right_service-content">
                                        <h3 class="Login_right">High-Quality Healthcare Products:</h3>
                                        <p class="Login_right">Oxygen, hospital beds & wheelchairs</p>
                                    </div>
                                </div>

                                <div class="Login_right_service-card">
                                    <div class="Login_right_icon">
                                        <svg viewBox="0 0 24 24">
                                            <path
                                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.94-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z" />
                                        </svg>
                                    </div>
                                    <div class="Login_right_service-content">
                                        <h3 class="Login_right">Trusted by Caregivers & Hospitals:</h3>
                                        <p class="Login_right">Reliable equipment for home & clinicals</p>
                                    </div>
                                </div>

                                <div class="Login_right_service-card">
                                    <div class="Login_right_icon">
                                        <svg viewBox="0 0 24 24">
                                            <path
                                                d="M20 15.5c-1.25 0-2.45-.2-3.57-.57-.35-.11-.74-.03-1.02.24l-2.2 2.2c-2.83-1.44-5.15-3.75-6.59-6.59l2.2-2.2c.27-.27.35-.67.24-1.02C8.7 6.45 8.5 5.25 8.5 4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1 0 9.39 7.61 17 17 17 .55 0 1-.45 1-1v-3.5c0-.55-.45-1-1-1z" />
                                        </svg>
                                    </div>
                                    <div class="Login_right_service-content">
                                        <h3 class="Login_right">24/7 Customer Support:</h3>
                                        <p class="Login_right">Expert guidance for all medical needs</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="Sign_up_form form-box">
                        <div class="registerFormPart" style="display: block;">
                            <h2>Register</h2>
                            <form id="register_form" method="post" action="{{ route('customers.store') }}">
                                @csrf
                                <input type="text" id="name" name="full_name" placeholder="Enter your name"
                                    required value="{{ old('full_name') }}">
                                @error('full_name')
                                    <div class="error-message" style="color:red;">{{ $message }}</div>
                                @enderror

                                <input type="email" id="email" name="email" placeholder="Enter your email"
                                    required value="{{ old('email') }}">
                                @error('email')
                                    <div class="error-message" style="color:red;">{{ $message }}</div>
                                @enderror

                                <input type="text" id="mobile" name="mobile"
                                    placeholder="Enter your mobile number" required value="{{ old('mobile') }}">
                                @error('mobile')
                                    <div class="error-message" style="color:red;">{{ $message }}</div>
                                @enderror

                                {{-- <input type="text" id="pincode" name="pincode" placeholder="Enter your Pincode"
                                    required value="{{ old('pincode') }}" onkeyup="chekPincodeAvil(this.value);"> --}}
                                <input type="text" id="pincode" name="pincode" placeholder="Enter your Pincode"
                                    required maxlength="6" pattern="\d{6}" value="{{ old('pincode') }}" onkeyup="chekPincodeAvil(this.value);">
                                <div id="error-message_pin" class="error-message"></div>
                                @error('pincode')
                                    <div class="error-message" style="color:red;">{{ $message }}</div>
                                @enderror

                                <div class="Sign_up_form report-fields">
                                    <input type="text" id="city" name="city" placeholder="Enter your City"
                                        readonly required value="{{ old('city') }}">
                                    @error('city')
                                        <div class="error-message" style="color:red;">{{ $message }}</div>
                                    @enderror
                                    <input type="text" id="state" name="state" placeholder="Enter your State"
                                        readonly required value="{{ old('state') }}">
                                    @error('state')
                                        <div class="error-message" style="color:red;">{{ $message }}</div>
                                    @enderror
                                    
                                </div>
                                    <div class="checkboxPart">
                                        <div class="">
                                            <label>
                                                <input type="checkbox" checked="" id="agree" name="agree"
                                                   required>
                                                <i></i>
                                                <span>I read and understand <a href="{{ route('terms.and.conditions') }}">T&C</a>.</span>
                                            </label>
                                               
                                        </div>
                                       
                                    </div>
                                <button type="submit">Sign Up</button>
                            </form>
                            <div class="Sign_up_form login-link">
                                Already have an account? <a href="{{ route('login') }}" style="color: #F2A602;">Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        <script src="{{ asset('front/js/jquery.min.js') }}"></script>
        <script src="{{ asset('front/js/slick.js') }}"></script>
        <script src="{{ asset('front/js/script.js') }}"></script>
        <script>
              const element = document.querySelector('.LoginPopInner');
            const width = element.offsetWidth;
            console.log(width);
            document.getElementById('closebtnid').style.marginLeft = width-18 + 'px';
            document.getElementById("register_form").addEventListener("submit", function(event) {
                let name = document.getElementById("name").value.trim();
                let email = document.getElementById("email").value.trim();
                let mobile = document.getElementById("mobile").value.trim();
                let pincode = document.getElementById("pincode").value.trim();
                let state = document.getElementById("state").value.trim();
                let city = document.getElementById("city").value.trim();
                let agree = document.getElementById("agree").checked;

                let errors = [];
                if (!name) errors.push("Name is required.");
                if (!email || !/^\S+@\S+\.\S+$/.test(email)) errors.push("Valid email is required.");
                if (!/^\d{10}$/.test(mobile)) errors.push("Valid 10-digit mobile number is required.");
                if (!pincode) errors.push("Pincode is required.");
                if (!state) errors.push("State is required.");
                if (!city) errors.push("City is required.");
                if (!agree) errors.push("You must agree to the terms.");

                if (errors.length > 0) {
                    alert(errors.join("\n"));
                    event.preventDefault();
                }
            });

            function chekPincodeAvil(pincode) {
                document.getElementById('error-message_pin').innerHTML = 'Searching...';
                document.getElementById('error-message_pin').style.color = 'black';
                $.ajax({
                    url: "{{ url('/get-city-state') }}/" + pincode, // Change this to your actual endpoint
                    method: 'GET', // Use POST or GET as needed

                    success: function(response) {
                        if (response.success) {
                            document.getElementById('error-message_pin').innerHTML = '';
                            document.getElementById('state').value = response.state;
                            document.getElementById('city').value = response.city;
                        } else {
                            document.getElementById('state').value = '';
                            document.getElementById('city').value = '';
                            document.getElementById('error-message_pin').innerHTML = response.message;
                             document.getElementById('error-message_pin').style.color = 'red';
                        }
                    }
                });
            }
        </script>
</body>
</html>
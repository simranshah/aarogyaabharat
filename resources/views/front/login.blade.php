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
    <div class="LoginPop winScrollStop" style="display: block;">
        <div class="LoginPopMiddle">
            <div class="LoginPopInner">
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
                        <div class="mobForm">
                            <div class="title1">
                                <strong>Lets’ Login</strong>
                                <p>Please fill below details to get account access.</p>
                            </div>
                            <div class="socialLogos">
                                <div>
                                    <a href="{{ route('google.login') }}"><img
                                            src="{{ asset('front/images/logos_google.svg') }}"
                                            alt="logos_google" /></a>
                                </div>
                                <div>
                                    <a href="{{ route('facebook.login') }}"><img
                                            src="{{ asset('front/images/facebook_logo.svg') }}"
                                            alt="facebook_logo" /></a>
                                </div>
                            </div>
                            <div class="orLine">
                                <span>OR</span>
                            </div>
                            <form id="loginMo" method="post" action="{{ route('customer.login') }}">
                                @csrf
                                <div class="inputMainBlock fullwidth">
                                    <span>Mobile number</span>
                                    <input type="tel" name="mobile" class="mobileVD" placeholder="9921407039"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')" autocomplete="off">
                                    <div class="errormsg"></div>
                                    <div class="addressNote2">
                                        <img src="{{ asset('front/images/info-circle.svg') }}" alt="info-circle">
                                        <p>Enter your 10-digit mobile number</p>
                                    </div>
                                </div>
                                <div class="checkboxPart fullwidth">
                                    <button type="button" class="submitBTN">Login with OTP</button>
                                </div>
                            </form>
                            <p>Don’t have an account ? <a href="{{ route('register') }}">Register Now</a> </p>
                        </div>
                        <div class="optForm">
                            <div class="title1">
                                <strong>Verify with OTP</strong>
                                <p>Enter the OTP sent to <span id="number-section"><strong>XXXXXX9898</strong></span>
                                    <br> <a href="#;">Change Number</a> </p>
                            </div>
                            <form id="otp_form">
                                <div class="a_otpPart">
                                    <div class="inputMainBlock fullwidth">
                                        <div class="form-group">
                                            <div class="otp-wrap" id="otp-inputs">
                                                <input type="number" id="codeBox1" maxlength="1" title="OTP"
                                                    onfocus="onFocusEvent(1)" autocomplete="one-time-code" />
                                                <input type="number" id="codeBox2" maxlength="1" title="OTP"
                                                    onfocus="onFocusEvent(2)" autocomplete="one-time-code" />
                                                <input type="number" id="codeBox3" maxlength="1" title="OTP"
                                                    onfocus="onFocusEvent(3)" autocomplete="one-time-code" />
                                                <input type="number" id="codeBox4" maxlength="1" title="OTP"
                                                    onfocus="onFocusEvent(4)" autocomplete="one-time-code" />
                                                <input type="number" id="codeBox5" maxlength="1" title="OTP"
                                                    onfocus="onFocusEvent(5)" autocomplete="one-time-code" />
                                                <input type="number" id="codeBox6" maxlength="1" title="OTP"
                                                    onfocus="onFocusEvent(6)" autocomplete="one-time-code" />
                                                <div class="errormsg">You have entered incorrect OTP</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="a_resendOtp">
                                        <p><a href="javascript:void(0)">Resend OTP</a></p>
                                    </div>
                                    <div class="a_countText">
                                        <p> <i>00:60</i> secs</p>
                                    </div>
                                    <div class="checkboxPart fullwidth">
                                        <div class="">
                                            <label>
                                                <input type="checkbox" checked />
                                                <i></i>
                                            </label>
                                            I read and understand <a href="{{ route('terms.and.conditions') }}">Terms
                                                and
                                                Conditions</a>.
                                        </div>
                                        <button class="submitBTN">Submit</button>
                                    </div>
                                    <a href="#;">Need Help!</a>
                                </div>
                            </form>
                        </div>
                        {{-- <div class="registerFormPart">
                <div class="title1">
                    <strong>Register</strong>
                    <p>Please enter below details to get register</p>
                </div>
                <form id="register_form" method="post" action="{{ route('customers.store') }}">
                    @csrf
                    <div class="inputMainBlock fullwidth">
                        <span>Enter Your Full Name<i>*</i></span>
                        <input type="text" name="full_name" class="FullNameVD" placeholder="Full Name">
                        <div class="errormsg"></div>
                    </div>
                    <div class="inputMainBlock fullwidth">
                        <span>Enter Your E-mail ID<i>*</i></span>
                        <input type="email" name="email" class="emailVD" placeholder="E-mail ID"
                            autocomplete="off">
                        <div class="errormsg"></div>
                    </div>
                    <div class="inputMainBlock fullwidth">
                        <span>Enter Your Mobile Number<i>*</i></span>
                        <input type="text" name="mobile" class="mobileVD" placeholder="Mobile Number" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            autocomplete="off">
                        <div class="errormsg"></div>
                    </div>

                    <div class="inputMainBlock fullwidth">
                        <span>Enter Your Pincode<i>*</i></span>
                        <input type="text" name="pincode" class="AnyValueVD" placeholder="Pincode" maxlength="6" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            autocomplete="off">
                        <div class="pinmsg"></div>
                        <div class="errormsg"></div>
                    </div>

                    <div class="inputMainBlock fullwidth">
                        <span>Enter Your City / Area<i>*</i></span>
                        <input type="text" name="city" class="AnyValueVD" placeholder="City - Area" readonly>
                        <div class="errormsg"></div>
                    </div>

                    <div class="inputMainBlock fullwidth">
                        <span>Enter Your State<i></i></span>
                        <input type="text" name="state" class="AnyValueVD" placeholder="State" readonly>
                        <div class="errormsg"></div>
                    </div>
                    <div class="checkboxPart fullwidth">
                        <button type="button" class="submitBTN">Submit</button>
                    </div>
                </form>
                <p>Have an account on Aarogya Bharat? <a href="#;">Login Now</a> </p>
            </div> --}}
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('front/js/jquery.min.js') }}"></script>
        <script src="{{ asset('front/js/slick.js') }}"></script>
        <script src="{{ asset('front/js/script.js') }}"></script>
        <script>
            $("#loginMo .submitBTN").click(function(e) {
                e.preventDefault();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                var formData = $('#loginMo').serialize();
                formData += '&_token=' + "{{ csrf_token() }}";

                $.ajax({
                    url: "{{ route('customer.login') }}",
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        $('.errormsg').html('');
                        if (response.errors) {
                            $.each(response.errors, function(key, value) {
                                $('input[name="' + key + '"]').next('.errormsg').html(
                                    value[0]).css("display", "block");
                            });
                        } else {
                            toastr.success(response.success);
                            $('.mobForm').hide();
                            $('.optForm').show();
                            count3minut('otp_form');
                            mobileNumber = response.number;
                            otpUrl = "{{ route('verify.otp', ['number' => ':number']) }}"
                                .replace(':number', mobileNumber);
                            let maskedNumber = 'XXXXXX' + mobileNumber.slice(-4);
                            $('#number-section').text(maskedNumber);
                        }
                    },
                    error: function(xhr) {
                        $('.errormsg').html('');
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            $('input[name="' + key + '"]').next('.errormsg').html(value[
                                0]).css("display", "block");
                        });
                    }
                });
            });
            var interval;

            function count3minut(otpFid) {
                var timer2 = "1:00";
                interval = setInterval(function() {
                    var timer = timer2.split(':');
                    var minutes = parseInt(timer[0], 10);
                    var seconds = parseInt(timer[1], 10);
                    --seconds;
                    minutes = (seconds < 0) ? --minutes : minutes;
                    seconds = (seconds < 0) ? 59 : seconds;
                    seconds = (seconds < 10) ? '0' + seconds : seconds;

                    $('#' + otpFid + ' .a_otpPart .a_countText p i').html('0' + minutes + ':' + seconds);
                    if (minutes < 0) clearInterval(interval);
                    if ((seconds <= 0) && (minutes <= 0)) clearInterval(interval);
                    timer2 = minutes + ':' + seconds;

                    if ((seconds <= 0) && (minutes <= 0)) {
                        $('#' + otpFid + ' .a_otpPart .a_countText').hide();
                        $('#' + otpFid + ' .a_otpPart .a_resendOtp').show();
                    }

                }, 1000);
            }
            //open login popup
            function openLoginPop() {
                $('.LoginPop').show();
            }
            document.getElementById("signupForm").addEventListener("submit", function(event) {
                let mobileNumber = document.getElementById("mobileNumber").value;
                if (!/^\d{10}$/.test(mobileNumber)) {
                    alert("Please enter a valid 10-digit mobile number.");
                    event.preventDefault();
                }
            });
        </script>
</body>

</html>

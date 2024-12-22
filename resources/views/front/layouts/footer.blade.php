<footer class="myfooter">
    <div class="container">
        <div class="all_footer_parts">
            <div class="footer_acco_box">
                <div class="acco_click"><a href="#;">
                        <p>Quick links</p><img src="{{ asset('front/images/upArrow.svg') }}" alt="" />
                    </a></div>
                <div class="acco_text">
                    <div class="footer_links">
                        <div class="links_text">
                            <ul>
                                <li><a href="{{ route('customer.about.us') }}">About</a></li>
                                <li><a href="{{ route('privacy.policy') }}">Privacy Policy</a></li>
                                <li><a href="{{ route('terms.and.conditions') }}">Terms and Condtions</a></li>
                            </ul>
                        </div>
                        <div class="links_text">
                            <ul>
                                <li><a href="{{ route('blogs') }}">Blogs</a></li>
                                <li><a href="{{ route('faqs') }}">Frequently Asked Questions</a></li>
                                <li><a href="{{ route('front.contact') }}">Contact us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer_acco_box">
                <div class="acco_click"><a href="#;">
                        <p>Popular Products</p><img src="{{ asset('front/images/upArrow.svg') }}" alt="" />
                    </a></div>
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
                <div class="acco_click"><a href="#;">
                        <p>Social connects</p><img src="{{ asset('front/images/upArrow.svg') }}" alt="" />
                    </a></div>
                <div class="acco_text">
                    <div class="social_connects">
                        <ul>
                            <li><a href="{{ env('FACEBOOK_PAGE_URI') }}"><img
                                        src="{{ asset('front/images/facebook.svg') }}" alt="Facebook" /></a></li>
                            <li><a href="{{ env('INSTA_PAGE_URI') }}"><img src="{{ asset('front/images/insta.svg') }}"
                                        alt="Insta" /></a></li>
                            <li><a href="{{ env('X_PAGE_URI') }}"><img src="{{ asset('front/images/Xtwit.svg') }}"
                                        alt="X" /></a></li>
                             <li><a href="{{ env('YOUTUBE_PAGE_URL') }}" target="_blank"><img 
                                src="{{ asset('front/images/youtube.png') }}" alt="youtube" /></a></li>
                            <li><a href="https://wa.me/{{ env('HELP_LINE_NO') }}" target="_blank"><img
                                        src="{{ asset('front/images/whatsapp.svg') }}" alt="WhatsApp" /></a></li>
                        </ul>
                    </div>
                    <!-- <div class="emergency_help">
                        <h2>Need an emergency help</h2>
                        <ul>
                            <li><a href="tel:{{ env('HELP_LINE_NO') }}"><img src="{{ asset('front/images/phone_call.svg') }}" alt="" />
                                    <p>{{ env('HELP_LINE_NO') }}</p><span>Call Now</span>
                                </a></li>
                            <li><a href="mailto:{{ env('HELP_LINE_EMAIL') }}"><img src="{{ asset('front/images/mail.svg') }}" alt="" />
                                    <p>{{ env('HELP_LINE_EMAIL') }}</p>
                                </a></li>
                        </ul>
                    </div> -->
                </div>
                <div class="emergency_help">
                    <h2>Need an emergency help</h2>
                    <ul>
                        <li><a href="tel:{{ env('HELP_LINE_NO') }}"><img
                                    src="{{ asset('front/images/phone_call.svg') }}" alt="" />
                                <p>{{ env('HELP_LINE_NO') }}</p><span>Call Now</span>
                            </a></li>
                        <li><a href="mailto:{{ env('HELP_LINE_EMAIL') }}"><img
                                    src="{{ asset('front/images/mail.svg') }}" alt="" />
                                <p>{{ env('HELP_LINE_EMAIL') }}</p>
                            </a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="copyrights">
    <p>Copyrights © 2020 Aarogyaa Bharat | <a href="https://webxds.com" target="_blank" class="designer-link">Designed
            by WebXDS</a></p>
</div>


<div class="bottomBar">
    {{-- <ul>
        <li id="home">
            <a href="{{ route('home') }}">
                <img src="{{ Route::currentRouteName() == 'home' ? asset('front/images/home_active.svg') : asset('front/images/home-inactive.svg') }}"
                    alt="Home" />
                Home
            </a>
        </li>
        <li>
            <a href="{{ route('products') }}">
                <img src="{{ Request::is('products') ? asset('front/images/productbar-active.svg') : asset('front/images/productbar.svg') }}"
                    alt="Product" />
                Product
            </a>
        </li>
        <li id="offerLink">
            <a href="{{ route('home') }}#offer_Part">
                <img id="offerImage"
                    src="{{ Route::currentRouteName() == 'home#offer_Part' ? asset('front/images/offerbar-active.svg') : asset('front/images/offerbar.svg') }}"
                    alt="Offers" />
                Offers
            </a>
        </li>
        <li>
            @if (Auth::check() && Auth::user()->hasRole('Customer'))
                <a href="{{ route('customers.profile') }}">
                    <img src="{{ Request::is('profile') ? asset('front/images/profilebar-active.svg') : asset('front/images/profilebar.svg') }}"
                        alt="Profile" />
                    Profile</a>
            @else
                <a href="javascript:void(0)" onclick="openLoginPop()"><img
                        src="{{ asset('front/images/profilebar.svg') }}" alt="">Profile</a>
            @endif
        </li>
    </ul> --}}

    <ul>
        <li id="home">
            <a href="{{ route('home') }}">
                <img id="home-image"
                    src="{{ Route::currentRouteName() == 'home' ? asset('front/images/home_active.svg') : asset('front/images/home-inactive.svg') }}"
                    alt="Home" />
                Home
            </a>
        </li>
        <li>
            <a href="{{ route('products') }}">
                <img src="{{ Request::is('products') ? asset('front/images/productbar-active.svg') : asset('front/images/productbar.svg') }}"
                    alt="Product" />
                Product
            </a>
        </li>
        <li id="offerLink" data-active-img="{{ asset('front/images//offerbar-active.svg') }}"
            data-inactive-img="{{ asset('front/images/offerbar.svg') }}">
            <a href="{{ route('home') }}#offer_Part">
                <img id="offerImage" src="{{ asset('front/images/offerbar.svg') }}" alt="Offers" />
                Offers
            </a>
        </li>
        <li>
            @if (Auth::check() && Auth::user()->hasRole('Customer'))
                <a href="{{ route('customers.profile') }}">
                    <img src="{{ Request::is('profile') ? asset('front/images/profilebar-active.svg') : asset('front/images/profilebar.svg') }}"
                        alt="Profile" />
                    Profile
                </a>
            @else
                <a href="javascript:void(0)" onclick="openLoginPop()">
                    <img src="{{ asset('front/images/profilebar.svg') }}" alt="">
                    Profile
                </a>
            @endif
        </li>
    </ul>

</div>


<div class="locationPop winScrollStop">
    <div class="locationBlock">
        <a href="#;"><img src="{{ asset('front/images/cross.svg') }}" alt="" /></a>
        <h4>Select Delivery Location</h4>
        <p>Please enter pin code to get current location.</p>
        <div class="inputPart">
            <input type="text" placeholder="Enter pin code" name="pin" maxlength="6" oninput="this.value = this.value.replace(/[^0-9]/g, '')" id="pinCode" />
            <a href="javascript:void(0)" id="checkPin">Check</a>
            <div id="success" style="color: green;">

            </div>
            <div id="fail" style="color: red;">

            </div>

        </div>
        <div class="currLoc">
            <img src="{{ asset('front/images/pin.svg') }}" alt="" />
            <a href="#;">Select Current Location</a>
        </div>
        <button id="getLocationBtn">Get Location</button>
    </div>
</div>

<div class="LoginPop winScrollStop">
    <div class="LoginPopMiddle">
        <div class="LoginPopInner">
            <a href="#;"><img src="{{ asset('front/images/cross.svg') }}" alt="" /> </a>
            <div class="mobForm">
                <div class="title1">
                    <strong>Lets’ Login</strong>
                    <p>Please fill below details to get account access.</p>
                </div>
                <div class="socialLogos">
                    <div>
                        <a href="{{ route('google.login') }}"><img
                                src="{{ asset('front/images/logos_google.svg') }}" alt="" /></a>
                    </div>
                    <div>
                        <a href="{{ route('facebook.login') }}"><img
                                src="{{ asset('front/images/facebook_logo.svg') }}" alt="" /></a>
                    </div>
                </div>
                <div class="orLine">
                    <span>OR</span>
                </div>
                <form id="loginMo" method="post" action="{{ route('customer.login') }}">
                    @csrf
                    <div class="inputMainBlock fullwidth">
                        <span>Mobile number</span>
                        <input type="tel" name="mobile" class="mobileVD" placeholder="9921407039" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            autocomplete="off">
                        <div class="errormsg"></div>
                        <div class="addressNote2">
                            <img src="{{ asset('front/images/info-circle.svg') }}" alt="">
                            <p>Enter your 10-digit mobile number</p>
                        </div>
                    </div>
                    <div class="checkboxPart fullwidth">
                        <button type="button" class="submitBTN">Login with OTP</button>
                    </div>
                </form>
                <p>Don’t have an account ? <a href="#;">Register Now</a> </p>
            </div>
            <div class="optForm">
                <div class="title1">
                    <strong>Verify with OTP</strong>
                    <p>Enter the OTP sent to <span id="number-section"><strong>XXXXXX9898</strong></span> <br> <a
                            href="#;">Change Number</a> </p>
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
                                I read and understand <a href="{{ route('terms.and.conditions') }}">Terms and
                                    Conditions</a>.
                            </div>
                            <button class="submitBTN">Submit</button>
                        </div>
                        <a href="#;">Need Help!</a>
                    </div>
                </form>
            </div>
            <div class="registerFormPart">
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
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('front/js/jquery.min.js') }}"></script>
<script src="{{ asset('front/js/slick.js') }}"></script>
<script src="{{ asset('front/js/script.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<script>
    var mobileNumber;
    var otpUrl;
    $(document).ready(function() {

        $("#register_form .submitBTN").click(function(e) {
            e.preventDefault();
            var formData = $('#register_form').serialize();
            console.log('formData', formData);
            $.ajax({
                url: "{{ route('customers.store') }}",
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
                        $('#register_form')[0].reset();
                        $('.registerFormPart').hide();
                        $('.LoginPop').show();
                        $('.mobForm').show();
                        $('body').css('overflow-y', 'auto');
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
        $('#checkPin').on('click', function() {
            var pinCode = $('#pinCode').val();
            // Simple validation for empty input
            if (pinCode === '') {
                $('#fail').text('Please enter a pin code.');
                $('#success').text('');
                return;
            }

            $.ajax({
                url: "{{ route('checkpin') }}", // Change this to your actual endpoint
                method: 'GET', // Use POST or GET as needed
                data: {
                    pin: pinCode,
                },
                success: function(response) {
                    if (response.available) {
                        $('#fail').text('');
                        $('#success').text('Pincode is match.');
                        // $('#pincodeContainer').html(response.userPincodeHtml);
                    } else {
                        $('#success').text('');
                        $('#fail').text('Pincode not match.');
                        if (response.redirect) {
                            window.location.href = response.redirect;
                        }
                    }
                },
                error: function() {
                    $('#result').text('An error occurred while checking the pin code.');
                }
            });
        });
    });

    //get adress from current location start
    $('#getLocationBtn').click(function() {
        if (navigator.geolocation) {
            // Use geolocation to get the current position
            navigator.geolocation.getCurrentPosition(function(position) {
                // Get the latitude and longitude
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;

                var geocodeUrl = 'https://nominatim.openstreetmap.org/reverse?lat=' + latitude +
                    '&lon=' + longitude + '&format=json';

                $.get(geocodeUrl, function(data) {
                    if (data) {
                        var address = data.address;
                        $.ajax({
                            url: "{{ route('save.location') }}",
                            method: 'GET',
                            data: {
                                address: address,
                            },
                            success: function(response) {
                                console.log('response', response);
                                if (response.success) {
                                    if (response.userPincodeHtml) {
                                        $('#pincodeContainer').html(response
                                            .userPincodeHtml);
                                    }
                                    toastr.success(response.message);
                                } else {
                                    toastr.error(response.message);
                                }
                                $('.locationPop').hide();
                            },
                            error: function(xhr, status, error) {
                                toastr.error(error);
                            }
                        });
                    }
                }).fail(function() {
                    toastr.error('Address could not be retrieved');
                });
            }, function(error) {
                toastr.error(error.message);
            });
        } else {
            toastr.error('Geolocation is not supported by this browser.');
        }
    });

    //get adress from current location end

    // otp timer
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
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const pincodeInput = document.querySelector("input[name='pincode']");
        const cityInput = document.querySelector("input[name='city']");
        const stateInput = document.querySelector("input[name='state']");
        const errorMsg = document.querySelector(".pinmsg");

        let timer;

        pincodeInput.addEventListener("input", function() {
            const pincode = this.value;

            // Clear previous timer
            clearTimeout(timer);

            if (pincode.length >= 4) {
                errorMsg.innerHTML = "Searching...";

                timer = setTimeout(() => {
                    fetch(`/get-city-state/${pincode}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                $(this).parents('.inputMainBlock').addClass("valid").removeClass("invalid");
                                cityInput.value = data.city;
                                stateInput.value = data.state;
                                errorMsg.innerHTML = ""; // Clear error message
                            } else {
                    
                                cityInput.value = "";
                                stateInput.value = "";
                                errorMsg.innerHTML = data.message;
                                $(this).parents('.inputMainBlock').removeClass("valid").addClass("invalid"); 
                                                           
                            }
                        })
                        .catch(() => {
                            cityInput.value = "";
                            stateInput.value = "";
                            errorMsg.innerHTML = "Something went wrong";
                        });
                }, 500); // Delay search to avoid too many requests
            } else {
                cityInput.value = "";
                stateInput.value = "";
                errorMsg.innerHTML = "";
            }
        });
    });
</script>

<script>
    function updateBannerImages() {
        let isMobile = window.innerWidth <= 768; // Adjust breakpoint if needed
        // document.getElementById("mobile").style.display = isMobile ? "block" : "none";
        // document.getElementById("desk").style.display = isMobile ? "none" : "block";
        // document.querySelectorAll('.bannerImage').forEach(img => {
        //     let isImageMobile = img.dataset.isMobile === "1" || img.dataset.isMobile === "true"; // Convert string to boolean

        //     // Show the image only if it matches the screen type
        //     if ((isMobile && isImageMobile) || (!isMobile && !isImageMobile)) {
        //         img.style.display = "block";
        //     } else {
        //         img.style.display = "none";
        //     }
        // });
    }

    // Run on page load
    window.addEventListener('load', updateBannerImages);

    // Run on window resize
    window.addEventListener('resize', updateBannerImages);
</script>
<script defer>
    document.addEventListener("DOMContentLoaded", function() {
        let offerImage = document.getElementById("offerImage");
        let homeImage = document.getElementById("home-image");
        let offerLink = document.getElementById("offerLink");
        let homeLink = document.getElementById("home"); // Get the home tab

        if (offerLink && offerImage && homeLink) {
            if (window.location.hash === "#offer_Part") {
                offerLink.classList.add("active");
                homeLink.classList.remove("active"); // Ensure home is NOT active
                homeImage.src = "{{ asset('front/images/home-inactive.svg') }}";
                offerImage.src = "{{ asset('front/images/offerbar-active.svg') }}";
            } else {
                offerLink.classList.remove("active");
                offerImage.src = "{{ asset('front/images/offerbar.svg') }}";
            }
        }
    });
    $(document).ready(function () {
    $('img').each(function () {
        var $img = $(this);

        // Check if alt attribute is missing or empty
        if (!$img.attr('alt') || $img.attr('alt').trim() === '') {
            var src = $img.attr('src');

            // Extract the image name from the src
            if (src) {
                var imageName = src.split('/').pop().split('.')[0]; // Get the file name without extension

                // Replace spaces with underscores and convert to lowercase
                imageName = imageName.replace(/\s+/g, '_').toLowerCase();

                // Set the alt attribute
                $img.attr('alt', imageName);
            }
        }
    });
});


</script>
</body>
</html>

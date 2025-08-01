@php
    $isMobile =
        request()->header('User-Agent') &&
        preg_match('/mobile|android|iphone|ipad|phone/i', request()->header('User-Agent'));
@endphp
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
                                    <a href="{{ route('terms.and.conditions') }}">Terms and Conditions</a>
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
                                        <a
                                            href="{{ route('products.sub.category.wise', ['slug' => $product->category->slug, 'subSlug' => $product->slug]) }}">
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
                                <a href="https://www.facebook.com/people/Aarogyaabharat/61572967197556/"
                                    target="_blank">
                                    <img src="{{ asset('front/images/facebook.svg') }}" alt="Facebook" />
                                </a>
                            </li>
                            <li>
                                <a href="https://www.instagram.com/aarogyaabharat/" target="_blank">
                                    <img src="{{ asset('front/images/insta.svg') }}" alt="Insta" />
                                </a>
                            </li>
                            <li>
                                <a href="https://x.com/aarogyaabharat" target="_blank">
                                    <img src="{{ asset('front/images/Xtwit.svg') }}" alt="X" />
                                </a>
                            </li>
                            <li>
                                <a href="https://youtube.com/@aarogyaabharatlimited?si=uboxRLNmuqQB3vyj "
                                    target="_blank">
                                    <img src="{{ asset('front/images/youtube.png') }}" alt="youtube" />
                                </a>
                            </li>
                            <li>
                                <a href="https://wa.me/{{ env('HELP_LINE_NO') }}" target="_blank">
                                    <img src="{{ asset('front/images/whatsapp.svg') }}" alt="WhatsApp" />
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
                                <img src="{{ asset('front/images/phone_call.svg') }}" alt="phone_call" />
                                <p>{{ env('HELP_LINE_NO') }}</p>
                                <span>Call Now</span>
                            </a>
                        </li>
                        <li>
                            <a href="mailto:{{ env('HELP_LINE_EMAIL') }}">
                                <img src="{{ asset('front/images/mail.svg') }}" alt="mail" />
                                <p>{{ env('HELP_LINE_EMAIL') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div
            style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; margin-top:0; width: 100%;">
            <!-- Left-side payment logos -->
            <div class="footer-payment-row" style="display: flex; align-items: center;">
                <img src="{{ asset('front/images/Visa.svg') }}" alt="Visa"
                    style="height: 40px; margin-right: 10px;">
                <img src="{{ asset('front/images/MasterCardLogo.svg') }}" alt="Rupay"
                    style="height: 40px; margin-right: 10px;">
                <img src="{{ asset('front/images/UPI.svg') }}" alt="MasterCard" style="height: 40px;">
                <img src="{{ asset('front/images/Gpay.svg') }}" alt="MasterCard" style="height: 40px;">
                <img src="{{ asset('front/images/Phonepe.svg') }}" alt="MasterCard" style="height: 40px;">
                <img src="{{ asset('front/images/NetBanking.svg') }}" alt="MasterCard" style="height: 40px;">
            </div>

            <!-- Right-side PCI logo -->
            {{-- <div style="margin-left: auto;     margin-top: 20px;
">
    <img src="{{ asset('front/images/pci.webp') }}" alt="PCI certified" style="height: 50px;">
    <img src="{{ asset('front/images/iso_certified.png') }}" alt="iso_certified" style="height: 50px;">
  </div> --}}
        </div>


</footer>

</div>
<div class="frame-120">
    <p class="text-wrapper-67">Copyrights © {{ date('Y') }} Aarogyaa Bharat</p>
</div>

<div id="notification-pop">

</div>
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
@if (!Route::is('products.sub.category.wise'))
    <div id="chat-toggle">
        <img src="{{ asset('front/images/chat_bot_img.png') }}" alt="Chat Icon">
    </div>
@endif
<div class="log-out">
    <div class="popup-overlay" id="logoutPopup3" style="display: none;">
        <div class="popup">
            <button class="close-btn"
                onclick="document.getElementById('logoutPopup3').style.display='none';">&times;</button>
            <img src="{{ asset('front/images/server_isuue.svg') }}" alt="Logout" class="popup-image1" />
            {{-- <h2 class="popup-title">Come back soon!</h2> --}}
            <p class="popup-text">Something Went Wrong !</p>
            <div class="popup-buttons">
                <a href="{{ route('raise.query') }}"><button class="btn yes-btn" style="padding: 10px 1px;">Raise
                        Query</button></a>
                <button class="btn cancel-btn"
                    onclick="document.getElementById('logoutPopup3').style.display='none';">Cancel</button>
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
<div class="get-in-touch-popup-background">
    <div class="get-in-touch-popup-container">
        <button class="get-in-touch-close-btn" onclick="getInTouchClosePopup()">×</button>

        <div class="get-in-touch-left-section">
            <div class="get-in-touch-get-in-touch-section">
                <div class="get-in-touch-get-in-touch">
                    <h2>Get In Touch</h2>
                    <div class="get-in-touch-contact-info">
                        <div class="get-in-touch-contact-item">
                            <div class="get-in-touch-contact-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32px" height="32px"
                                    viewBox="0 0 24 24" fill="none">
                                    <path
                                        d="M5.13641 12.764L8.15456 9.08664C8.46255 8.69065 8.61655 8.49264 8.69726 8.27058C8.76867 8.07409 8.79821 7.86484 8.784 7.65625C8.76793 7.42053 8.67477 7.18763 8.48846 6.72184L7.77776 4.9451C7.50204 4.25579 7.36417 3.91113 7.12635 3.68522C6.91678 3.48615 6.65417 3.35188 6.37009 3.29854C6.0477 3.238 5.68758 3.32804 4.96733 3.5081L3 4C3 14 9.99969 21 20 21L20.4916 19.0324C20.6717 18.3121 20.7617 17.952 20.7012 17.6296C20.6478 17.3456 20.5136 17.0829 20.3145 16.8734C20.0886 16.6355 19.7439 16.4977 19.0546 16.222L17.4691 15.5877C16.9377 15.3752 16.672 15.2689 16.4071 15.2608C16.1729 15.2536 15.9404 15.3013 15.728 15.4001C15.4877 15.512 15.2854 15.7143 14.8807 16.119L11.8274 19.1733M12.9997 7C13.9765 7.19057 14.8741 7.66826 15.5778 8.37194C16.2815 9.07561 16.7592 9.97326 16.9497 10.95M12.9997 3C15.029 3.22544 16.9213 4.13417 18.366 5.57701C19.8106 7.01984 20.7217 8.91101 20.9497 10.94"
                                        stroke="#000000" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </div>
                            <div class="get-in-touch-contact-text"><a href="tel:+919921407039">
                                    <p>+919921407039</p>
                                </a></div>
                        </div>
                        <div class="get-in-touch-contact-item">
                            <div class="get-in-touch-contact-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32px" height="32px"
                                    viewBox="0 0 24 24" fill="none">
                                    <path
                                        d="M10 19H6.2C5.0799 19 4.51984 19 4.09202 18.782C3.71569 18.5903 3.40973 18.2843 3.21799 17.908C3 17.4802 3 16.9201 3 15.8V8.2C3 7.0799 3 6.51984 3.21799 6.09202C3.40973 5.71569 3.71569 5.40973 4.09202 5.21799C4.51984 5 5.0799 5 6.2 5H17.8C18.9201 5 19.4802 5 19.908 5.21799C20.2843 5.40973 20.5903 5.71569 20.782 6.09202C21 6.51984 21 7.0799 21 8.2V10M20.6067 8.26229L15.5499 11.6335C14.2669 12.4888 13.6254 12.9165 12.932 13.0827C12.3192 13.2295 11.6804 13.2295 11.0677 13.0827C10.3743 12.9165 9.73279 12.4888 8.44975 11.6335L3.14746 8.09863M14 21L16.025 20.595C16.2015 20.5597 16.2898 20.542 16.3721 20.5097C16.4452 20.4811 16.5147 20.4439 16.579 20.399C16.6516 20.3484 16.7152 20.2848 16.8426 20.1574L21 16C21.5523 15.4477 21.5523 14.5523 21 14C20.4477 13.4477 19.5523 13.4477 19 14L14.8426 18.1574C14.7152 18.2848 14.6516 18.3484 14.601 18.421C14.5561 18.4853 14.5189 18.5548 14.4903 18.6279C14.458 18.7102 14.4403 18.7985 14.405 18.975L14 21Z"
                                        stroke="#000000" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </div>
                            <div class="get-in-touch-contact-text"><a href="mailto:help@aarogyaabharat.com">
                                    <p>help@aarogyaabharat.com</p>
                                </a></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="social-section">
                <div class="social-item">
                    <a href="https://wa.me/+919921407039" target="_blank">
                        <div class="social-icon whatsapp">
                            <svg viewBox="0 0 24 24">
                                <path
                                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.485 3.287" />
                            </svg>
                        </div>
                    </a>
                    <span class="social-name">WhatsApp</span>

                </div>
                <div class="social-item">
                    <a href="https://www.instagram.com/aarogyaabharat">
                        <div class="social-icon instagram">
                            <svg viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                        </div>
                    </a>
                    <span class="social-name">Instagram</span>

                </div>
                <div class="social-item">
                    <a href="https://x.com/AarogyaaBharat">
                        <div class="social-icon twitter">
                            <svg viewBox="0 0 24 24">
                                <path
                                    d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                            </svg>
                        </div>
                    </a>
                    <span class="social-name">Twitter</span>

                </div>
                <div class="social-item">
                    <a href="https://facebook.com/AarogyaaBharat">
                        <div class="social-icon facebook">
                            <svg viewBox="0 0 24 24">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </div>
                    </a>
                    <span class="social-name">Facebook</span>

                </div>
            </div>
        </div>

        <div class="get-in-touch-right-section">
            <h2 class="get-in-touch-form-title">Want a Callback? You Got It.</h2>
            <form id="getInTouchCallbackForm">
                <div class="get-in-touch-form-row">
                    <div class="get-in-touch-form-group get-in-touch-half">
                        <label class="get-in-touch-form-label">Full Name<span
                                class="get-in-touch-required">*</span></label>
                        <input type="text" name="name" class="get-in-touch-form-input"
                            placeholder="Enter your name" required>
                    </div>
                    <div class="get-in-touch-form-group get-in-touch-half">
                        <label class="get-in-touch-form-label">Mobile Number<span
                                class="get-in-touch-required">*</span></label>
                        <input type="tel" name="phone" class="get-in-touch-form-input"
                            placeholder="Enter Number" required>
                    </div>
                </div>

                <div class="get-in-touch-form-group">
                    <label class="get-in-touch-form-label">Email
                      <span
                                class="get-in-touch-required">*</span>
                    </label>
                    <input type="email" name="email" class="get-in-touch-form-input"
                        placeholder="Enter your email" required>
                </div>

                <div class="get-in-touch-form-group">
                    <label class="get-in-touch-form-label">Message
                      <span
                                class="get-in-touch-required">*</span>
                    </label>
                    <textarea class="get-in-touch-form-input get-in-touch-message-input" name="message"
                        placeholder="Tell us how we can help you..." required></textarea>
                </div>

                <div style="display: flex; justify-content: center; align-items: center;">
                    <button type="submit" class="get-in-touch-submit-btn">Let's Talk</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="log-out">
  <div class="popup-overlay" id="sucess-popup" style="display: none;">
      <div class="popup">
        <button class="close-btn" onclick="document.getElementById('sucess-popup').style.display='none';">&times;</button>
        <img src="{{asset('front/images/add_adress_success.svg')}}" alt="Logout" class="popup-image1" />
        <h2 class="popup-title">Thank you !</h2>
        <p class="popup-text">We will get back to you soon.</p>
        <div class="popup-buttons">
          <button class="btn cancel-btn" onclick="document.getElementById('sucess-popup').style.display='none';">OK</button>
        </div>
      </div>
    </div>
   </div>
</body>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
<script src="{{ asset('front/js/jquery.min.js') }}"></script>
{{-- <script src="{{ asset('front/js/slick.js') }}"></script> --}}
<script src="{{ asset('front/js/script.js') }}"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
<script src="https://code.jquery.com/jquery-3.7.0.min.js" data-reload="true"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js" data-reload="true"></script>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-D1GEF2BB22"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-D1GEF2BB22');
</script>
<script>
    function reloadAllScripts() {
        $('script[data-reload="true"]').each(function() {
            var oldScript = $(this);
            var newScript = document.createElement('script');
            newScript.src = oldScript.attr('src') + '?v=' + new Date().getTime(); // cache-buster
            newScript.setAttribute('data-reload', 'true');
            document.body.appendChild(newScript);
            oldScript.remove();
        });
    }
    $(document).ready(function() {
        $('.recent-product-products-slider').slick({
            infinite: false,
            slidesToShow: 7,
            slidesToScroll: 1,

            arrows: false, // 👈 hides next/prev buttons
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 5,
                        slidesToScroll: 1,
                    },
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                    },
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                    },
                },
            ],
        });
    });


    $(document).ready(function() {
        $('.frame-15').slick({
            infinite: false,
            slidesToShow: 5.5,
            slidesToScroll: 1,

            arrows: false, // 👈 hides next/prev buttons
            responsive: [{
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
    $(document).ready(function() {
        $('.categories').slick({
            infinite: false,
            slidesToShow: 6,
            slidesToScroll: 2,
            // autoplay: true,
            // autoplaySpeed: 2000,
            arrows: false, // 👈 hides next/prev buttons

            dots: true,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 5,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 4
                    }
                }
            ]
        });
    });
    $(document).ready(function() {
        // Count the number of direct child divs inside .frame-44
        var itemCount = $('.home-care-products > div').length;

        if (itemCount >= 6) {
            $('.home-care-products').slick({
                infinite: false,
                slidesToShow: 6,
                slidesToScroll: 2,
                autoplay: true,
                autoplaySpeed: 2000,
                arrows: false,
                responsive: [{
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
        }
    });
    $(document).ready(function() {
        // Count the number of direct child divs inside .frame-44
        var itemCount = $('.medical-equipment-products > div').length;

        if (itemCount >= 6) {
            $('.medical-equipment-products').slick({
                infinite: false,
                slidesToShow: 6,
                slidesToScroll: 2,
                autoplay: true,
                autoplaySpeed: 2000,
                arrows: false,
                responsive: [{
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
        }
    });
    $(document).ready(function() {
        var $carousel = $('.everyonebuying');
        var count = parseInt($carousel.data('count'));

        if (count > 1) {
            $carousel.slick({
                infinite: false,
                slidesToShow: count < 3.5 ? count : 3.5, // cap at count if fewer than 3.5
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
                arrows: false,
                responsive: [{
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: count < 3 ? count : 3,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: count < 1.5 ? count : 1.5,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        }
    });

    $(document).ready(function() {
        $('.blogsimage').slick({
            infinite: false,
            slidesToShow: 4,
            slidesToScroll: 2,
            autoplay: true,
            autoplaySpeed: 2000,
            arrows: false, // 👈 hides next/prev buttons
            responsive: [{
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
    @if ($isMobile)
        $(document).ready(function() {
            $('.middle').slick({
                infinite: false,
                slidesToShow: 5,
                slidesToScroll: 2,
                autoplay: true,
                autoplaySpeed: 2000,
                arrows: false, // 👈 hides next/prev buttons
                responsive: [{
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
    @endif
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
    $(document).ready(function() {
        $('.frame-95').slick({
            infinite: false,
            slidesToShow: 4,
            slidesToScroll: 2,
            autoplay: true,
            autoplaySpeed: 2000,
            arrows: false, // 👈 hides next/prev buttons
            responsive: [{
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
    // $(document).ready(function(){
    // $('.banner-container').slick({
    // infinite: false,
    // slidesToShow: 1,
    // slidesToScroll: 1,
    // autoplay: true,
    // autoplaySpeed: 2000,
    // arrows: false, // 👈 hides next/prev buttons
    // dots: true,
    // responsive: [
    // {
    // breakpoint: 1024,
    // settings: {
    // slidesToShow: 1,
    // slidesToScroll: 1
    // }
    // },
    // {
    // breakpoint: 768,
    // settings: {
    // slidesToShow: 1,
    // slidesToScroll: 1
    // }
    // }
    // ]
    // });
    // });
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
                            $('#searchResultList').html('<li>No products found.</li>');
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
                $("#recentSearch").hide();
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
    observer.observe(input1, {
        attributes: true,
        attributeFilter: ['placeholder']
    });
</script>
<script>
    const input = document.getElementById('searchInput');
    const dropdown = document.getElementById('recentSearch');

    //   input.addEventListener('focus', () => {
    //     dropdown.style.display = 'block';
    //   });

    // document.addEventListener('click', (e) => {
    // if (!document.querySelector('.search-bar').contains(e.target)) {
    // dropdown.style.display = 'none';
    // }
    // });
</script>

<script>
    $(document).ready(function() {
        $('.addtocart').on('click', function() {
            var productId = $(this).data('id');
            var $btn = $(this);
            // $btn.prop('disabled', true).addClass('disabled');
            $.ajax({
                url: "{{ route('cart.add', ['productId' => '__ID__']) }}".replace('__ID__',
                    productId),
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    // ✅ Handle success (e.g., update cart count, show toast, etc.)
                    if (response.success) {
                        document.getElementById('cartproductcount').innerHTML = response
                            .cartproductcount;
                        document.getElementById('text-btween-cartpopup').innerHTML =
                            response.message;
                        document.getElementById('text-btween-cartpopup').style.color =
                            '#2d5a2d';
                        cartPopup();
                    } else {
                        document.getElementById('text-btween-cartpopup').innerHTML =
                            response.message;
                        document.getElementById('text-btween-cartpopup').style.color =
                        'red';
                        cartPopup();
                    }
                    $btn.prop('disabled', false).removeClass('disabled');
                },
                error: function(xhr) {
                    // ❌ Handle error
                    $btn.prop('disabled', false).removeClass('disabled');
                    document.getElementById('logoutPopup3').style.display = 'flex';
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
    function changeProductsByCategory(categoryId, clickedElement) {
        console.log("Selected category ID:", categoryId);
        $.ajax({
            url: "{{ route('products.category') }}",
            type: 'GET',
            data: {
                Brand_id: categoryId
            },
            success: function(response) {
                // $('#category-products').inn(response);
                document.getElementById('category-products').innerHTML = response;

                // Now reload all JS
                // document.querySelectorAll('script').forEach(function(oldScript) {
                document.querySelectorAll('.category-tab').forEach(function(el) {
                    el.classList.remove('frame-58');
                    el.classList.add('frame-59');
                });

                // Add frame-58 to the clicked one
                clickedElement.classList.remove('frame-59');
                clickedElement.classList.add('frame-58');

                // });
                setTimeout(() => {
                    const $slider = $('.Brand-products');
                    const productCount = $slider.find('.frame-16')
                    .length; // 👈 replace with your actual item class
                    const isMobile = window.innerWidth <= 768;
                    // console.log(isMobile);
                    // console.log(productCount);
                    // Decide whether to initialize slick based on conditions
                    const shouldInitSlider = (isMobile && productCount >= 2) || (!isMobile &&
                        productCount >= 6);
                    // console.log(shouldInitSlider);
                    if (!shouldInitSlider) return; // 👈 don't init slick if not needed

                    // Destroy if already initialized
                    if ($slider.hasClass('slick-initialized')) {
                        $slider.slick('unslick');
                    }

                    // Initialize
                    $slider.slick({
                        infinite: false,
                        slidesToShow: 5.5,
                        slidesToScroll: 1,
                        arrows: false,
                        responsive: [{
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
                }, 0);

            },
            error: function(xhr, status, error) {
                console.error("Error fetching products:", error);
            }
        });
    }
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
</script>

<script>
    @if ($isMobile)
        document.addEventListener('DOMContentLoaded', function() {
            var toggleBtn1 = document.getElementById('categoryToggleBtn');
            var subMenu = document.getElementById('categorySubMenu');
            var isOpen = true;

            toggleBtn1.addEventListener('click', function() {
                isOpen = !isOpen;
                subMenu.style.display = isOpen ? 'block' : 'none';
                toggleBtn1.textContent = isOpen ? '-' : '+';
            });
        });
    @endif
</script>
<script>
    const toggleBtn = document.getElementById('chat-toggle') || document.getElementById('chat-toggle-button');
    const closeBtn = document.getElementById('close-chat');
    const chatbox = document.getElementById('chatbox');
    const chatBody = document.getElementById('chat-body');
    const chatInput = document.getElementById('chat-input'); // renamed from input
    const sendBtn = document.getElementById('send-btn');

    let lastQuery = "";
    let typingEl;

    function formatMarkdown(text) {
        return text
            .replace(/</g, "&lt;") // escape to prevent XSS
            .replace(/>/g, "&gt;")
            .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
    }

    function addMessage(text, sender = "user") {
        const wrapper = document.createElement("div");
        wrapper.className = `message-wrapper ${sender}`;

        if (sender === "bot") {
            chatInput.disabled = false;

            const botRow = document.createElement("div");
            botRow.className = "bot-row";
            botRow.style.display = "flex";
            botRow.style.alignItems = "center";
            botRow.style.gap = "8px";

            const botImage = document.createElement("img");
            botImage.src = "/front/images/msg_chat_bot.svg"; // Use actual path
            botImage.alt = "Bot";
            botImage.className = "bot-image";

            const msg = document.createElement("div");
            msg.className = "message";
            msg.innerHTML = formatMarkdown(text);

            botRow.appendChild(botImage);
            botRow.appendChild(msg);
            wrapper.appendChild(botRow);
        } else {
            chatInput.disabled = true;

            const name = document.createElement("div");
            name.className = "sender-name";
            name.textContent = "You :";

            const msg = document.createElement("div");
            msg.className = "message";
            msg.innerHTML = formatMarkdown(text);

            wrapper.appendChild(name);
            wrapper.appendChild(msg);
        }

        chatBody.appendChild(wrapper);
        chatBody.scrollTop = chatBody.scrollHeight;
    }

    function showTypingIndicator() {
        typingEl = document.createElement("div");
        typingEl.className = "message-wrapper bot";

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
        const userInput = chatInput.value.trim();
        if (!userInput) return;

        addMessage(userInput, "user");
        chatInput.value = "";

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

            if (reply.includes("I couldn't find a matching product")) {
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
    chatInput.addEventListener("keypress", (e) => {
        if (e.key === "Enter") handleSend();
    });

    toggleBtn.addEventListener("click", () => {
        chatbox.style.display = "flex";
        if (document.getElementById('chat-toggle') != null) {
            toggleBtn.style.display = "none";
        }
    });

    closeBtn.addEventListener("click", () => {
        chatbox.style.display = "none";
        if (document.getElementById('chat-toggle') != null) {
            toggleBtn.style.display = "block";
        }
    });

    // Initial bot greeting
    addMessage("Hi! I'm Aarogyaa. How can I help you today?", "bot");

    function searchproductinput(searchvalue) {
        // var checkworld= checkSpelling(searchvalue);
        var url = '{{ url('/search/products/results/') }}/' + searchvalue;
        window.location.href = url;
    }

    document.addEventListener("DOMContentLoaded", function() {
        const img = document.querySelector('.raise-query-img');

        if (!img) return;

        const deviceWidth = window.innerWidth;
        const isMobile = img.classList.contains('mobile');

        const adjustedWidth = isMobile ? deviceWidth - 20 : deviceWidth - 100;
        img.style.width = adjustedWidth + 'px';
    });
    window.addEventListener('load', function() {
        fetch('/get-banners')
            .then(response => response.json())
            .then(data => {
                // Insert the HTML into a specific element
                document.getElementById('bannerpart').innerHTML = data.html;

                // Use a small delay OR wait for DOM updates using requestAnimationFrame
                requestAnimationFrame(() => {
                    // Re-initialize Slick on newly added content
                    $('.banner-container').slick({
                        infinite: false,
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        autoplay: true,
                        autoplaySpeed: 2000,
                        arrows: false,
                        dots: true,
                        responsive: [{
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
            })
            .catch(error => console.error('Error fetching data:', error));
    });
</script>
<script>
  // Function to close the popup
  function getInTouchClosePopup() {
      document.querySelector('.get-in-touch-popup-background').classList.remove('active');
      // Set cookie to remember popup was closed
      setGetInTouchPopupCookie();
  }

  // Function to set cookie
  function setGetInTouchPopupCookie() {
      const date = new Date();
      date.setTime(date.getTime() + (3 * 24 * 60 * 60 * 1000)); // 3 days from now
      const expires = "expires=" + date.toUTCString();
      document.cookie = "getInTouchPopupClosed=true;" + expires + ";path=/";
  }

  // Function to check if cookie exists
  function checkGetInTouchPopupStorage() {
    if (sessionStorage.getItem('getInTouchPopupChecked') === 'true') {
        return false; // Already shown in this session
    }

    sessionStorage.setItem('getInTouchPopupChecked', 'true');
    return true; // First time in this session
}


  // Function to show popup after delay
  function showGetInTouchPopup() {
      // Only show if cookie doesn't exist (meaning it wasn't closed recently)
      if (checkGetInTouchPopupStorage()) {
          setTimeout(function() {
              document.querySelector('.get-in-touch-popup-background').classList.add('active');
          }, 10000); // 10 seconds delay
      }
  }

  // Close popup when clicking outside
  document.querySelector('.get-in-touch-popup-background').addEventListener('click', function(e) {
      if (e.target === this) {
          getInTouchClosePopup();
      }
  });

  // Form submission
  document.getElementById('getInTouchCallbackForm').addEventListener('submit', function(e) {
      e.preventDefault();
      // Collect form data
      const form = e.target;
      const formData = new FormData(form);

      fetch('/save-get-in-touch', {
              method: 'POST',
              headers: {
                  'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                      'content')
              },
              body: formData
          })
          .then(response => response.json())
          .then(data => {
            getInTouchClosePopup();
              // Optionally show a success message
              document.getElementById('sucess-popup').style.display = 'flex';
          })
          .catch(error => {
              // Optionally show an error message
          });
      
  });

  // ESC key to close
  document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
          getInTouchClosePopup();
      }
  });

  // Show popup when page loads
  window.addEventListener('DOMContentLoaded', showGetInTouchPopup);
</script>

</html>

@extends('front.layouts.layout')
@section('content')

<!-- @include('front.common.welcome-message') -->
@php
    $isMobile = request()->header('User-Agent') && preg_match('/mobile|android|iphone|ipad|phone/i', request()->header('User-Agent'));
@endphp
 {{-- <div class="preloader" id="preloader" style="display: none;">
    <div class="logo-container">
      <div class="spinner"></div>
      <div class="logo" style="align-content: center;align-items:center;justify-content: center;">
          <img src="{{ asset('front/images/logo_mini.svg') }}" alt="Logo" style="width: 60px; height: 60px;">
      </div>
      <div class="progress-bar">
        <div class="progress" id="progress"></div>
      </div>
      <div class="loading-text">
        Loading <span class="percent" id="percent">0%</span>
      </div>
    </div>
  </div> --}}
<section class="bannerPArt" style="margin-top: 8px" id="bannerpart">
    <div class="container">
        <div class="bannerSlider getprogressWidth arrowOnProgress">
            @if($isMobile)
                @foreach($mobileBannerImages as $banner)
                @if($loop->first)
                    <div class="bannerBlock">
                        <a href="{{ $banner->link }}" target="_blank">
                            <img class="bannerImage"
                                 src="{{ asset('storage/' . $banner->image) }}" 
                                 alt="Mobile Banner"  loading="lazy">
                        </a>    
                    </div>
                @endif
                @endforeach
            @else
                @foreach($bannerImages as $banner)
                 @if($loop->first)
                    <div class="bannerBlock">
                        <a href="{{ $banner->link }}" target="_blank">
                            <img class="bannerImage"
                                 src="{{ asset('storage/' . $banner->image) }}" 
                                 alt="Desktop Banner"  loading="lazy">
                        </a>    
                    </div>
                    @endif
                @endforeach
            @endif
        </div> 
        <div class="progressBar"></div>
    </div>
</section>

{{-- <section class="bannerPArt">
    <div class="container">
        <div class="bannerSlider getprogressWidth arrowOnProgress">
            @if(isset($bannerImages))
            @foreach($bannerImages as $banner)
                    <div class="bannerBlock">
                    <a href="{{$banner->link}}" target="_blank">
                        <img src="{{ asset('storage/' . $banner->image) }}" alt="Banner Image">
                    </a>    
                    </div>
            @endforeach
            @endif
        </div> 
        <div class="progressBar"></div>
    </div>
</section> --}}
<!-- caterory part  -->
<section class="category_part">
    <div class="container">
       <div class="titlePart">
            <h4>Category</h4>
            <a href="{{route('products.category')}}">View All <img src="{{ asset('front/images/orange_arrow.svg')}}" alt="orange_arrow"> </a>
        </div>
        <div class="category_all_box catgory_slider getprogressWidth arrowOnProgress">
            @foreach ($categories as $category)
                <div class="category_box">
                <a href="{{ route('products.category.wise', ['slug' => $category->slug]) }}" style="text-decoration: none;"> 
                    <div class="category_icon">
                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" />

                    </div>
                    <p style="color: black;">{{ $category->name }}</p>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="progressBar"></div>
        </div>
    </div>
</section>
@include('front.home-products.flash-sale')

@include('front.home-products.top-deals-products')

@include('front.home-products.top-pick for-you')

@include('front.home-products.newly-added')
@include('front.home-products.best-selling-products')
@include('front.home-products.product-for-you')

@include('front.home-products.sports-healthcare-more')
@if(isset($offerAndDiscounts)&& $offerAndDiscounts->isNotEmpty())
 <section class="offer_Part part-offer" id="offer_Part">
    <div class="container">
        <div class="titlePart">
            <h4>Special Offers & Discounts</h4>
            <!-- <a href="{{route('products')}}">View All <img src="{{ asset('front/images/orange_arrow.svg')}}" alt=""> </a> -->
        </div>
        <div class="rowMob">
        <div class="offer_slider getprogressWidth arrowOnProgress">
        @include('front.common.offer-discounts') 
        </div>
        <div class="progressBar"></div>
        </div>
    </div>
</section> 
@endif

<!-- product part  -->



<!-- <section class="product_Part">
    <div class="container">
        <div class="titlePart">
            <h4>Newly Product</h4>
            <a href="#;">View All <img src="images/orange_arrow.svg" alt=""> </a>
        </div>
        <div class="rowMob">
            <div class="product_slider getprogressWidth">
                <div class="product_slider_padd">
                    <div class="product_slider_block">
                        <div class="imagePart">
                            <img src="images/wheelchair_1.png" alt="" >
                        </div>
                        <h5>Wheelchair</h5>
                        <p>Dummy text for offer of product goes here just for placeholder..</p>
                        <strong>₹ 1200</strong><i>/ Per week</i>
                        <a href="#;">View Details <img src="images/orange_arrow.svg" alt=""> </a>
                    </div>
                </div>
                <div class="product_slider_padd">
                    <div class="product_slider_block">
                        <div class="imagePart">
                            <img src="images/wheelchair_1.png" alt="" >
                        </div>
                        <h5>Wheelchair</h5>
                        <p>Dummy text for offer of product goes here just for placeholder..</p>
                        <strong>₹ 1200</strong><i>/ Per week</i>
                        <a href="#;">View Details <img src="images/orange_arrow.svg" alt=""> </a>
                    </div>
                </div>
                <div class="product_slider_padd">
                    <div class="product_slider_block">
                        <div class="imagePart">
                            <img src="images/wheelchair_1.png" alt="" >
                        </div>
                        <h5>Wheelchair</h5>
                        <p>Dummy text for offer of product goes here just for placeholder..</p>
                        <strong>₹ 1200</strong><i>/ Per week</i>
                        <a href="#;">View Details <img src="images/orange_arrow.svg" alt=""> </a>
                    </div>
                </div>
                <div class="product_slider_padd">
                    <div class="product_slider_block">
                        <div class="imagePart">
                            <img src="images/wheelchair_1.png" alt="" >
                        </div>
                        <h5>Wheelchair</h5>
                        <p>Dummy text for offer of product goes here just for placeholder..</p>
                        <strong>₹ 1200</strong><i>/ Per week</i>
                        <a href="#;">View Details <img src="images/orange_arrow.svg" alt=""> </a>
                    </div>
                </div>
                <div class="product_slider_padd">
                    <div class="product_slider_block">
                        <div class="imagePart">
                            <img src="images/wheelchair_1.png" alt="" >
                        </div>
                        <h5>Wheelchair</h5>
                        <p>Dummy text for offer of product goes here just for placeholder..</p>
                        <strong>₹ 1200</strong><i>/ Per week</i>
                        <a href="#;">View Details <img src="images/orange_arrow.svg" alt=""> </a>
                    </div>
                </div>
                <div class="product_slider_padd">
                    <div class="product_slider_block">
                        <div class="imagePart">
                            <img src="images/wheelchair_1.png" alt="" >
                        </div>
                        <h5>Wheelchair</h5>
                        <p>Dummy text for offer of product goes here just for placeholder..</p>
                        <strong>₹ 1200</strong><i>/ Per week</i>
                        <a href="#;">View Details <img src="images/orange_arrow.svg" alt=""> </a>
                    </div>
                </div>
            </div>
            <div class="progressBar"></div>
        </div>
    </div>
</section> -->

<section class="raise_query">
    <div class="container">
    <a href="{{ route('raise.query')}}">
        <div class="raise_query_box">
            <div class="rise_text_box">
                 <img src="{{ asset('front/images/raise.png')}}" alt="raise" />
                <div class="rise_text_line">
                    <h4>Raise Query</h4>
                    <p>You can request anything by single click.</p>
                </div>
            </div>
        </div>
    </a>   
    </div>
</section>
<section class="why_arogya_bharat">
    <div class="container">
       <div class="titlePart">
            <h4>Why Aarogyaa Bharat?</h4>
            <p>We prioritize our clients, understanding their unique needs and preferences.</p>
        </div>
        <div class="why_arogya_bharat_all_box">
            <div class="why_arogya_bharat_box">
                <div class="arogya_icon"><img src="{{asset('front/images/Client_Centric_Approach.svg')}}" alt="Client_Centric_Approach" /></div>
                <div class="why_arogya_bharat_text">
                    <h3>Client-Centric Approach</h3>
                    <p>We prioritize our clients, understanding their unique needs and preferences. </p>
                </div>
            </div>
            <div class="why_arogya_bharat_box">
                <div class="arogya_icon"><img src="{{asset('front/images/well_equipped.svg')}}" alt="well_equipped" /></div>
                <div class="why_arogya_bharat_text">
                    <h3>Well-Equipped Infrastructural Setup</h3>
                    <p>We prioritize our clients, understanding their unique needs and preferences. </p>
                </div>
            </div>
            <div class="why_arogya_bharat_box">
                <div class="arogya_icon"><img src="{{asset('front/images/skilled_team.svg')}}" alt="skilled_team" /></div>
                <div class="why_arogya_bharat_text">
                    <h3>Skilled Team of Professionals</h3>
                    <p>Our success is attributed to a team of skilled and dedicated professionals </p>
                </div>
            </div>
            <div class="why_arogya_bharat_box">
                <div class="arogya_icon"><img src="{{asset('front/images/wide_distribution_network.svg')}}" alt="wide_distribution_network" /></div>
                <div class="why_arogya_bharat_text">
                    <h3>Wide Distribution Network</h3>
                    <p>With a wide-reaching distribution network, we are capable of delivering our products </p>
                </div>
            </div>
            <div class="why_arogya_bharat_box">
                <div class="arogya_icon"><img src="{{asset('front/images/Work-Ethics.svg')}}" alt="Work-Ethics" /></div>
                <div class="why_arogya_bharat_text">
                    <h3>Ethical Business Practices</h3>
                    <p>Integrity and ethics are at the core of our business operations. </p>
                </div>
            </div>
            <div class="why_arogya_bharat_box">
                <div class="arogya_icon"><img src="{{asset('front/images/delivery-van.svg')}}" alt="delivery-van" /></div>
                <div class="why_arogya_bharat_text">
                    <h3>Timely Delivery</h3>
                    <p>We understand the importance of timely deliveries in the healthcare industry.</p>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="customer_part">
   <div class="container">
        <div class="header-google">
            <h2>What Our Customers Say</h2>
        </div>

        <div class="google-section">
            <div class="google-header">
                <div class="google-info">
                    <div class="google-logo">
                        <img src="/front/images/googlefull.svg" alt="Google Icon" width="124" height="84" />
                    </div>
                    <span class="reviews-text">Reviews</span>
                </div>
                <div class="rating-section">
                    <span class="rating-number">4.7</span>
                    <span class="stars">★★★★★</span>
                    <span class="review-count">(18)</span>
                </div>
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
                                <div class="review-date"><img src="/front/images/google-icon.svg" alt="Google Icon" width="24"
                                        height="24" /> 2 months ago</div>
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
                                <div class="review-date"><img src="/front/images/google-icon.svg" alt="Google Icon" width="24"
                                        height="24" /> 3 weeks ago</div>
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
                                <div class="review-date"><img src="/front/images/google-icon.svg" alt="Google Icon" width="24"
                                        height="24" /> 2 months ago</div>
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
                                <div class="review-date"><img src="/front/images/google-icon.svg" alt="Google Icon" width="24"
                                        height="24" /> 6 months ago</div>
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
                                <div class="review-date"><img src="/front/images/google-icon.svg" alt="Google Icon" width="24"
                                        height="24" /> a month ago</div>
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
                                <div class="review-date"><img src="/front/images/google-icon.svg" alt="Google Icon" width="24"
                                        height="24" /> 3 months ago</div>
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
                                <div class="review-date"><img src="/front/images/google-icon.svg" alt="Google Icon" width="24"
                                        height="24" /> 2 months ago</div>
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
                                <div class="review-date"><img src="/front/images/google-icon.svg" alt="Google Icon" width="24"
                                        height="24" /> 6 months ago</div>
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
                                <div class="review-date"><img src="/front/images/google-icon.svg" alt="Google Icon" width="24"
                                        height="24" /> 2 months ago</div>
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
                                <div class="review-date"><img src="/front/images/google-icon.svg" alt="Google Icon" width="24"
                                        height="24" /> 2 weeks ago</div>
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
                                <div class="review-date"><img src="/front/images/google-icon.svg" alt="Google Icon" width="24"
                                        height="24" /> a month ago</div>
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
                                <div class="review-date"><img src="/front/images/google-icon.svg" alt="Google Icon" width="24"
                                        height="24" /> a month ago</div>
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
                                <div class="review-date"><img src="/front/images/google-icon.svg" alt="Google Icon" width="24"
                                        height="24" /> 2 weeks ago</div>
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
                                <div class="review-date"><img src="/front/images/google-icon.svg" alt="Google Icon" width="24"
                                        height="24" /> a day ago</div>
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
                <div class="dots" id="dotsContainer"></div>
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

<!-- blog part  -->
@if(!$isMobile)
<section class="our_blog">
    <div class="container">
       <div class="titlePart2">
            <h4>Our Blogs</h4> 
        </div>
        <div class="our_blog_all_box">
            <div class="row18">
                @foreach ($blogs as $blog)
                    <div class="our_blog_box">
                        <div class="blog_image">
                        <a href="{{ route('blog.details', ['slug' => $blog->slug]) }}">
                            <img src="{{ asset('storage/' . $blog->images->first()->path) }}" alt="{{ $blog->images->first()->alt }}" />
                        </a>   
                        </div>
                        <div class="blog_text" style="height: 128px;">
                            <div class="text_one">                         
                                <h2><a href="{{ route('blog.details', ['slug' => $blog->slug]) }}" >{{ $blog->title }} </a></h2>
                                <p>{{ Str::limit($blog->description, 102) }}</p>
                                {{-- <p>{{ $blog->description }}</p> --}}
                            </div>
                            <div class="blog_tag_name">
                                <ul>
                                    <li class="tagBox"><p>{{ $blog->tagname  }}</p></li>
                                    <li class="blogdate">
                                        <img src="{{ asset('front/images/calendar.svg') }}" alt="calendar" />
                                        <p>{{ $blog->created_at->format('d/m/Y') }}</p>
                                    </li>
                                    <li class="blogview">
                                        <img src="{{ asset('front/images/carbon_view.svg') }}" alt="carbon_view" />
                                        <p>{{ $blog->views}}</p>
                                    </li>
                                    <li><a href="https://wa.me/?text={{ urlencode('Check out this blog: ' . $blog->title . ' ' . route('blog.details', $blog->slug)) }}"><img src="{{ asset('front/images/ri_share-line.svg') }}" alt="{{$blog->title}}"></a></li>
                                </ul>
                                <a href="{{ route('blog.details', ['slug' => $blog->slug]) }}" class="blogreadnow">Read Now</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="read_more_blogs">
            <a href="{{ route('blogs')}}">
                <p>Read More Blogs</p>
                <img src="{{ asset('front/images/downArrow.svg') }}" alt="downArrow" />
            </a>
        </div>
        </div>
    </div>
</section>
@endif
<!-- <section class="our_blog">
    <div class="container">
       <div class="titlePart2">
            <h4>Our Blogs</h4> 
        </div>
        <div class="our_blog_all_box">
            <div class="row18">
                <div class="our_blog_box">
                    <div class="blog_image"><img src="images/bed.png" alt="" /></div>
                    <div class="blog_text">
                        <div class="text_one"><h2>Medical Bed</h2><p>Kros samuktig neturen, herer of it isherer ann uppaskae. Mikok coko invertering hemissade Fredrik Åkesson...</p></div>
                        <div class="blog_tag_name">
                            <ul>
                                <li class="tagBox"><p>Tagename</p></li>
                                <li class="blogdate"><img src="images/calendar.svg" alt="" /><p>04/02/24</p></li>
                                <li class="blogview"><img src="images/carbon_view.svg" alt="" /><p>424</p></li>
                                <li><a href="#;"><img src="images/ri_share-line.svg" alt="" /></a></li>
                            </ul>
                            <a href="#;" class="blogreadnow">Read Now</a>
                        </div>
                    </div>
                </div>
                <div class="our_blog_box">
                    <div class="blog_image"><img src="images/bed.png" alt="" /></div>
                    <div class="blog_text">
                        <div class="text_one"><h2>Medical Bed</h2><p>Kros samuktig neturen, herer of it isherer ann uppaskae. Mikok coko invertering hemissade Fredrik Åkesson...</p></div>
                        <div class="blog_tag_name">
                            <ul>
                                <li class="tagBox"><p>Tagename</p></li>
                                <li class="blogdate"><img src="images/calendar.svg" alt="" /><p>04/02/24</p></li>
                                <li class="blogview"><img src="images/carbon_view.svg" alt="" /><p>424</p></li>
                                <li><a href="#;"><img src="images/ri_share-line.svg" alt="" /></a></li>
                            </ul>
                            <a href="#;" class="blogreadnow">Read Now</a>
                        </div>
                    </div>
                </div>
                <div class="our_blog_box">
                    <div class="blog_image"><img src="images/bed.png" alt="" /></div>
                    <div class="blog_text">
                        <div class="text_one"><h2>Medical Bed</h2><p>Kros samuktig neturen, herer of it isherer ann uppaskae. Mikok coko invertering hemissade Fredrik Åkesson...</p></div>
                        <div class="blog_tag_name">
                            <ul>
                                <li class="tagBox"><p>Tagename</p></li>
                                <li class="blogdate"><img src="images/calendar.svg" alt="" /><p>04/02/24</p></li>
                                <li class="blogview"><img src="images/carbon_view.svg" alt="" /><p>424</p></li>
                                <li><a href="#;"><img src="images/ri_share-line.svg" alt="" /></a></li>
                            </ul>
                            <a href="#;" class="blogreadnow">Read Now</a>
                        </div>
                    </div>
                </div>
                <div class="our_blog_box">
                    <div class="blog_image"><img src="images/bed.png" alt="" /></div>
                    <div class="blog_text">
                        <div class="text_one"><h2>Medical Bed</h2><p>Kros samuktig neturen, herer of it isherer ann uppaskae. Mikok coko invertering hemissade Fredrik Åkesson...</p></div>
                        <div class="blog_tag_name">
                            <ul>
                                <li class="tagBox"><p>Tagename</p></li>
                                <li class="blogdate"><img src="images/calendar.svg" alt="" /><p>04/02/24</p></li>
                                <li class="blogview"><img src="images/carbon_view.svg" alt="" /><p>424</p></li>
                                <li><a href="#;"><img src="images/ri_share-line.svg" alt="" /></a></li>
                            </ul>
                            <a href="#;" class="blogreadnow">Read Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="read_more_blogs"><a href="#;"><p>Read More Blogs</p><img src="images/downArrow.svg" alt="" /></a></div>
    </div>
</section> -->

@if(isset($partners))
<section class="partners_we_work_with">
    <!-- <div class="container">
       <div class="titlePart">
            <h4>Partners - we work with</h4>
            <p>A wheelchair is a chair fitted with wheels. The device comes in variations allowing either manual propulsion by the seated occupant turning the rear wheels by hand or electric propulsion by motors electric propulsion by motors.</p>
        </div>
        <div class="partners_we_work_logo">
            <img src="{{asset('front/images/Frame_1.png')}}" alt="" />
            <img src="{{asset('front/images/Frame_2.png')}}" alt="" />
            <img src="{{asset('front/images/Frame_3.png')}}" alt="" />
            <img src="{{asset('front/images/Frame_4.png')}}" alt="" />
            <img src="{{asset('front/images/Frame_5.png')}}" alt="" />
            <img src="{{asset('front/images/Frame_6.png')}}" alt="" />
        </div>
    </div> -->
    <div class="container">
       <div class="titlePart">
            <h4>{{ $partners->cms->title ?? 'Partners - We Work With'}}</h4>
            <p>{!! strip_tags($partners->cms->content) ?? 'Ensuring quality healthcare access, we work with renowned medical institutions to provide trusted and seamless medical equipment solutions across India' !!}</p>
        </div>
        <div class="partners_we_work_logo">
        @foreach($partners->cms->images as $img)
            <img src="{{ asset('storage/' . $img->path) }}" alt="image"/>
        @endforeach
            <!-- <img src="{{asset('front/images/Frame_1.png')}}" alt="" />
            <img src="{{asset('front/images/Frame_2.png')}}" alt="" />
            <img src="{{asset('front/images/Frame_3.png')}}" alt="" />
            <img src="{{asset('front/images/Frame_4.png')}}" alt="" />
            <img src="{{asset('front/images/Frame_5.png')}}" alt="" />
            <img src="{{asset('front/images/Frame_6.png')}}" alt="" /> -->
        </div>
    </div>
</section>
@endif
@if (isset($aboutAarogyaBharat)  && !empty($aboutAarogyaBharat) && isset($aboutAarogyaBharat->cms) && !empty($aboutAarogyaBharat->cms))
    
<section class="about_aarogya_bharat">
    <div class="container">
        {{-- <div class="about_aarogya_title"><h2>About Aarogya Bharat</h2></div> --}}
        <div class="about_aarogya_title"><h1>{{ $aboutAarogyaBharat->cms->title }}</h1></div>
        <div class="about_aarogya_bharat_text">
            <div id="content" class="short-content">
                {!! $aboutAarogyaBharat->cms->content !!}
            </div>
            <a id="toggleButton" class="readmore-aarogyaabharat">Read More..</a>
            {{-- <p>A wheelchair is a chair fitted with wheels. The device comes in variations allowing either manual propulsion by the seated occupant turning the rear wheels by hand or electric propulsion by motors.A wheelchair is a chair fitted with wheels. The device comes in variations allowing either manual propulsion by the seated occupant turning the rear wheels by hand or electric propulsion by motors.</p>
            <p>A wheelchair is a chair fitted with wheels. The device comes in variations allowing either manual propulsion by the seated occupant turning the rear wheels by hand or electric propulsion by motors. A wheelchair is a chair fitted with wheels. The device comes in variations allowing either manual propulsion by the seated occupant turning the rear wheels by hand or electric propulsion by motors <a href="#;">Read More..</a></p> --}}
        </div>
    </div>
</section>
@endif
<script src="{{ asset('front/js/jquery.min.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const copyButtons = document.querySelectorAll('.copy-code');
        copyButtons.forEach(button => {
            button.addEventListener('click', function () {
                const code = this.getAttribute('data-code');
                const tempInput = document.createElement('input');
                document.body.appendChild(tempInput);
                tempInput.value = code;
                tempInput.select();
                tempInput.setSelectionRange(0, 99999);
                document.execCommand('copy');
                document.body.removeChild(tempInput);
                // toastr.success('Offer code copied');
            });
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
        let content = document.getElementById("content");
        let button = document.getElementById("toggleButton");

        // Store original content
        let fullContent = content.innerHTML;
        let shortContent = fullContent.substring(0, 500) + '...'; // Adjust the length as needed

        // Initially show only a short version
        content.innerHTML = shortContent;
        let expanded = false;

        button.addEventListener("click", function () {
            if (expanded) {
                content.innerHTML = shortContent;
                button.innerText = "Read More";
            } else {
                content.innerHTML = fullContent;
                button.innerText = "Read Less";
            }
            expanded = !expanded;
        });
    });
     window.addEventListener('load', function() {
    // Make an AJAX request after the document is loaded
    fetch('/get-banners') // Replace with your URL
        .then(response => response.json()) // Parse the response as JSON
        .then(data => {
            // Insert the HTML into a specific element

            // Reload all JS scripts after updating the banner
           
            document.getElementById('bannerpart').innerHTML = data.html;
             document.querySelectorAll('script').forEach(function(oldScript) {
                if (oldScript.src) {
                    const newScript = document.createElement('script');
                    newScript.src = oldScript.src;
                    newScript.async = oldScript.async;
                    document.body.appendChild(newScript);
                }
            });
        })
        .catch(error => console.error('Error fetching data:', error));
});
</script>
{{-- <script>
    document.addEventListener("DOMContentLoaded", function () {
        const preloader = document.getElementById("preloader");
        const content = document.querySelector(".content");
        const progress = document.getElementById("progress");
        const percent = document.getElementById("percent");
        preloader.style.display = "flex"; // Show preloader

        let siteLoaded = false;
        let fiveSecondsPassed = false;
          let load = 0;
        function hidePreloader() {
            if (siteLoaded && fiveSecondsPassed) {
                preloader.style.opacity = "0";
                setTimeout(() => {
                    preloader.style.display = "none";
                    content.style.opacity = "1";
                }, 500); // matches transition
            }else{
            const interval = setInterval(() => {
            load++;
            

            if (load <= 100) {
              progress.style.width = load + "%";
            percent.textContent = load + "%";
            }
        }, 75); // Adjust loading speed
            }
        }

        // Wait until everything (images, etc.) is loaded
        window.addEventListener("load", () => {
            siteLoaded = true;
            hidePreloader();
        });

        // Minimum 5 seconds
        setTimeout(() => {
            fiveSecondsPassed = true;
            hidePreloader();
        }, 3000);
    });
</script> --}}

@endsection('content')

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
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32px" height="32px" viewBox="0 0 24 24" fill="none">
<path d="M5.13641 12.764L8.15456 9.08664C8.46255 8.69065 8.61655 8.49264 8.69726 8.27058C8.76867 8.07409 8.79821 7.86484 8.784 7.65625C8.76793 7.42053 8.67477 7.18763 8.48846 6.72184L7.77776 4.9451C7.50204 4.25579 7.36417 3.91113 7.12635 3.68522C6.91678 3.48615 6.65417 3.35188 6.37009 3.29854C6.0477 3.238 5.68758 3.32804 4.96733 3.5081L3 4C3 14 9.99969 21 20 21L20.4916 19.0324C20.6717 18.3121 20.7617 17.952 20.7012 17.6296C20.6478 17.3456 20.5136 17.0829 20.3145 16.8734C20.0886 16.6355 19.7439 16.4977 19.0546 16.222L17.4691 15.5877C16.9377 15.3752 16.672 15.2689 16.4071 15.2608C16.1729 15.2536 15.9404 15.3013 15.728 15.4001C15.4877 15.512 15.2854 15.7143 14.8807 16.119L11.8274 19.1733M12.9997 7C13.9765 7.19057 14.8741 7.66826 15.5778 8.37194C16.2815 9.07561 16.7592 9.97326 16.9497 10.95M12.9997 3C15.029 3.22544 16.9213 4.13417 18.366 5.57701C19.8106 7.01984 20.7217 8.91101 20.9497 10.94" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
                                </div>
                                <div class="get-in-touch-contact-text"><a href="tel:+919921407039">
                                <p>+919921407039</p>
                            </a></div>
                            </div>
                            <div class="get-in-touch-contact-item">
                                <div class="get-in-touch-contact-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32px" height="32px" viewBox="0 0 24 24" fill="none">
<path d="M10 19H6.2C5.0799 19 4.51984 19 4.09202 18.782C3.71569 18.5903 3.40973 18.2843 3.21799 17.908C3 17.4802 3 16.9201 3 15.8V8.2C3 7.0799 3 6.51984 3.21799 6.09202C3.40973 5.71569 3.71569 5.40973 4.09202 5.21799C4.51984 5 5.0799 5 6.2 5H17.8C18.9201 5 19.4802 5 19.908 5.21799C20.2843 5.40973 20.5903 5.71569 20.782 6.09202C21 6.51984 21 7.0799 21 8.2V10M20.6067 8.26229L15.5499 11.6335C14.2669 12.4888 13.6254 12.9165 12.932 13.0827C12.3192 13.2295 11.6804 13.2295 11.0677 13.0827C10.3743 12.9165 9.73279 12.4888 8.44975 11.6335L3.14746 8.09863M14 21L16.025 20.595C16.2015 20.5597 16.2898 20.542 16.3721 20.5097C16.4452 20.4811 16.5147 20.4439 16.579 20.399C16.6516 20.3484 16.7152 20.2848 16.8426 20.1574L21 16C21.5523 15.4477 21.5523 14.5523 21 14C20.4477 13.4477 19.5523 13.4477 19 14L14.8426 18.1574C14.7152 18.2848 14.6516 18.3484 14.601 18.421C14.5561 18.4853 14.5189 18.5548 14.4903 18.6279C14.458 18.7102 14.4403 18.7985 14.405 18.975L14 21Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
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
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.485 3.287"/>
                        </svg>
                    </div>
                    </a>
                    <span class="social-name">WhatsApp</span>
                    
                </div>
                <div class="social-item">
                    <a href="https://www.instagram.com/aarogyaabharat">
                    <div class="social-icon instagram">
                        <svg viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                    </div>
                     </a>
                    <span class="social-name">Instagram</span>
                   
                </div>
                <div class="social-item">
                    <a href="https://x.com/AarogyaaBharat">
                    <div class="social-icon twitter">
                        <svg viewBox="0 0 24 24">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                        </svg>
                    </div>
                    </a>
                    <span class="social-name">Twitter</span>
                    
                </div>
                <div class="social-item">
                    <a href="https://facebook.com/AarogyaaBharat">
                    <div class="social-icon facebook">
                        <svg viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
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
                            <label class="get-in-touch-form-label">Full Name<span class="get-in-touch-required">*</span></label>
                            <input type="text" name="name" class="get-in-touch-form-input" placeholder="Enter your name" required>
                        </div>
                        <div class="get-in-touch-form-group get-in-touch-half">
                            <label class="get-in-touch-form-label">Mobile Number<span class="get-in-touch-required">*</span></label>
                            <input type="tel" name="phone" class="get-in-touch-form-input" placeholder="Enter Number" required>
                        </div>
                    </div>
                    
                    <div class="get-in-touch-form-group">
                        <label class="get-in-touch-form-label">Email</label>
                        <input type="email" name="email" class="get-in-touch-form-input" placeholder="Enter your email">
                    </div>
                    
                    <div class="get-in-touch-form-group">
                        <label class="get-in-touch-form-label">Message</label>
                        <textarea class="get-in-touch-form-input get-in-touch-message-input" name="message" placeholder="Tell us how we can help you..."></textarea>
                    </div>
                    
                    <div style="display: flex; justify-content: center; align-items: center;">
                        <button type="submit" class="get-in-touch-submit-btn">Let's Talk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="popup-overlay" id="logoutPopup5" style="display: none;">
    <div class="popup">
      <button class="close-btn" onclick="document.getElementById('logoutPopup5').style.display='none';">&times;</button>
      {{-- <img src="{{asset('front/images/server_isuue.svg')}}" alt="Logout" class="popup-image1" /> --}}
      {{-- <h2 class="popup-title">Come back soon!</h2> --}}
      <p class="popup-text">Thank you! We will contact you soon !</p>
      <div class="popup-buttons">
       <button class="btn yes-btn"  onclick="document.getElementById('logoutPopup5').style.display='none';" >Yes</button>
        {{-- <button class="btn cancel-btn" onclick="document.getElementById('logoutPopup5').style.display='none';">Cancel</button> --}}
      </div>
    </div>
  </div>
 </div>
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
            document.cookie = "getInTouchPopupShown=true;" + expires + ";path=/";
        }

        // Function to check if cookie exists
        function checkGetInTouchPopupCookie() {
            const cookies = document.cookie.split(';');
            for (let i = 0; i < cookies.length; i++) {
                const cookie = cookies[i].trim();
                if (cookie === "getInTouchPopupShown=true") {
                    return true;
                }
            }
            return true;
        }

        // Function to show popup after delay
        function showGetInTouchPopup() {
            if (checkGetInTouchPopupCookie()) {
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
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            // Optionally show a success message
            document.getElementById('logoutPopup5').style.display='flex';
            // alert('Thank you! We will contact you soon.');
        })
        .catch(error => {
            // Optionally show an error message
            // alert('There was an error. Please try again.');
        });
            getInTouchClosePopup();
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
<script>
        let selectedItems = [];

        function openModal() {
            const modal = document.getElementById('modalOverlay');
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            const modal = document.getElementById('modalOverlay');
            modal.classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        function closeModalOnOverlay(event) {
            if (event.target === event.currentTarget) {
                closeModal();
            }
        }

        function toggleItem(card, index) {
            const checkbox = document.getElementById(`checkbox-${index}`);
            
            if (selectedItems.includes(index)) {
                selectedItems = selectedItems.filter(i => i !== index);
                checkbox.classList.remove('checked');
            } else {
                selectedItems.push(index);
                checkbox.classList.add('checked');
            }
            
            updateCancelButton();
        }

        function changeQuantity(event, index, change) {
            event.stopPropagation();
            const qtyElement = document.getElementById(`qty-${index}`);
            let currentQty = parseInt(qtyElement.textContent);
            
            if (change > 0 || currentQty > 1) {
                currentQty += change;
                qtyElement.textContent = currentQty;
                
                // Update QTY display
                const card = qtyElement.closest('.item-card');
                const qtyDisplay = card.querySelector('.product-qty');
                qtyDisplay.textContent = `QTY : ${currentQty}`;
            }
        }

        function updateCancelButton() {
            const cancelBtn = document.querySelector('.cancel-button');
            if (selectedItems.length > 0) {
                cancelBtn.disabled = false;
            } else {
                cancelBtn.disabled = true;
            }
        }

        function cancelItems() {
            if (selectedItems.length > 0) {
                alert(`Cancelling ${selectedItems.length} item(s)`);
                closeModal();
            }
        }

        // Handle ESC key to close modal
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });

        // Initialize button state
        updateCancelButton();
    </script>
@endsection('content')

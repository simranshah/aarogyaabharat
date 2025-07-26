@extends('front.layouts2.layout2')
@section('content')
@php
$isMobile =
    request()->header('User-Agent') &&
    preg_match('/mobile|android|iphone|ipad|phone/i', request()->header('User-Agent'));
@endphp
@if(!$isMobile)

    <div style="align-self: stretch; padding-top: 65px;  justify-content: flex-start; align-items: flex-start; gap: 18px; ">
    @else

      <div style="align-self: stretch; padding-top: 50px;  justify-content: flex-start; align-items: flex-start; gap: 18px; ">

    @endif
    {{-- <div class="new-breadcrumb" style="margin-top: 0px">
        <div class="containerforbreadcrumbs">
            <ul>
                <li><a href="{{ route('home') }}">Home</a> </li>
                <li><a href="">Category</a> </li>
                <li><a href="#;">Product Details</a> </li>
            </ul>
        </div>
    </div> --}}
    <div class="containerforfilters">
        <div class="product-container1">
            <!-- Left Section - Product Content -->
            <div class="product-content">
                <div class="product-image-info-container">
                @if(!$isMobile)
                <div class="product-image1">
                    @php
                        $thumbnails = [];
                        if (!empty($productDetails->image)) {
                            $thumbnails[] = asset('storage/' . $productDetails->image);
                        }
                        if (!empty($productDetails->image_1)) {
                            $thumbnails[] = asset('storage/' . $productDetails->image_1);
                        }
                        if (!empty($productDetails->image_2)) {
                            $thumbnails[] = asset('storage/' . $productDetails->image_2);
                        }
                        if (!empty($productDetails->image_3)) {
                            $thumbnails[] = asset('storage/' . $productDetails->image_3);
                        }
                        if (!empty($productDetails->image_4)) {
                            $thumbnails[] = asset('storage/' . $productDetails->image_4);
                        }
                    @endphp
                    <img id="mainProductImage" 
                    style="width: 100%; min-height: 419px; max-height: 419px; object-fit: contain;"
                     src="{{ $thumbnails[0] ?? '' }}" alt="Product Image" />
                    <div class="thumbnail-row">
                        @foreach($thumbnails as $i => $thumb)
                            <div class="thumbnail{{ $i === 0 ? ' active' : '' }}" onclick="changeMainImage('{{ $thumb }}', this)">
                                <img src="{{ $thumb }}" alt="Product Thumbnail" style="width: 100%; min-height: 60px; max-height: 80px; object-fit: cover;" />
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif
                <div class="product-details">
                    <h1 class="product-title">{{ $productDetails->name }}</h1>
                    <p class="product-description">
                        {{ $productDetails->title }}
                    </p>
                    @if($isMobile)
                    <div class="product-image1">
                        @php
                        $thumbnails = [];
                        if (!empty($productDetails->image)) {
                            $thumbnails[] = asset('storage/' . $productDetails->image);
                        }
                        if (!empty($productDetails->image_1)) {
                            $thumbnails[] = asset('storage/' . $productDetails->image_1);
                        }
                        if (!empty($productDetails->image_2)) {
                            $thumbnails[] = asset('storage/' . $productDetails->image_2);
                        }
                        if (!empty($productDetails->image_3)) {
                            $thumbnails[] = asset('storage/' . $productDetails->image_3);
                        }
                        if (!empty($productDetails->image_4)) {
                            $thumbnails[] = asset('storage/' . $productDetails->image_4);
                        }
                    @endphp
                    <img id="mainProductImage" 
                    @if($isMobile)
                    style="width: 100%; min-height: 200px; max-height: 200px; object-fit: contain;" 
                    @else
                    style="width: 100%; min-height: 419px; max-height: 419px; object-fit: contain;" 
                    @endif
                    src="{{ $thumbnails[0] ?? '' }}" alt="Product Image" />
                    <div class="thumbnail-row">
                        @foreach($thumbnails as $i => $thumb)
                            <div class="thumbnail{{ $i === 0 ? ' active' : '' }}" onclick="changeMainImage('{{ $thumb }}', this)">
                                <img style="display: none;" src="{{ $thumb }}" alt="Product Thumbnail" style="width: 100%; min-height: 60px; max-height: 80px; object-fit: cover;" />
                            </div>
                        @endforeach
                    </div>
                    </div>
                    @endif
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                        <div class="rating-section">
                            <div class="stars">
                                <span class="star">★</span>
                                <span class="star">★</span>
                                <span class="star">★</span>
                                <span class="star">★</span>
                                <span class="star empty">★</span>
                            </div>
                            <span class="rating-divider">|</span>
                            <span class="rating-score">4.5</span>
                        </div>
                        <div class="delivery-info">
                            <div class="frame-23" style="margin-top: 5px; background-color: unset;">
                                <div class="frame-24">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="14" viewBox="0 0 10 14" fill="none">
                                        <path d="M8.94377 7.02453L5.64575 5.11307L7.30837 1.12293C7.36639 1.00442 7.39339 0.873133 7.38686 0.741345C7.38032 0.609557 7.34046 0.481581 7.27101 0.369392C7.20155 0.257203 7.10476 0.164468 6.98971 0.0998659C6.87466 0.0352635 6.7451 0.000904968 6.61315 5.51437e-06C6.43776 -0.000654732 6.2673 0.0579921 6.12945 0.166423L6.07501 0.213082L0.242625 5.73441C0.154947 5.81767 0.0878507 5.9202 0.046644 6.03388C0.00543737 6.14756 -0.0087485 6.26926 0.00520861 6.38937C0.0191657 6.50947 0.0608829 6.62469 0.127059 6.72588C0.193236 6.82708 0.282055 6.91149 0.38649 6.97243L3.68529 8.88545L2.00323 12.9215C1.93385 13.0861 1.92333 13.2696 1.97344 13.4411C2.02355 13.6126 2.13123 13.7615 2.27835 13.8629C2.42546 13.9643 2.60301 14.0118 2.78109 13.9976C2.95917 13.9833 3.1269 13.9081 3.25602 13.7847L9.08841 8.26178C9.1759 8.17845 9.24282 8.07593 9.28387 7.9623C9.32493 7.84867 9.33899 7.72705 9.32496 7.60705C9.31094 7.48704 9.26919 7.37195 9.20304 7.27085C9.13688 7.16976 9.04812 7.08543 8.94377 7.02453Z" fill="#F24F67"></path>
                                    </svg>
                                    <div class="text-wrapper-14">
                                        Get it by 
                                        @if($isMobile)
                                        <span style="font-size: 12px; font-weight: 600;">{{ \Carbon\Carbon::now()->addDays(7)->format('D, M d') }}</span>
                                        @else
                                        <span style="font-size: 16px; font-weight: 600;">{{ \Carbon\Carbon::now()->addDays(7)->format('D, M d') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="price-section" style="display: flex; align-items: center; justify-content: space-between;">
                        <div>
                            <span class="current-price">₹ {{ $productDetails->our_price }}</span>
                            <span class="original-price">₹ {{ $productDetails->price }}</span>
                        </div>
                        <span class="discount-badge">@indianCurrency($productDetails->discount_percentage) % OFF</span>
                    </div>

                  

                    {{-- <div class="tax-info">
                        Inclusive of all taxes
                    </div>

                    <div class="seat-width-section">
                        <h3 class="section-title">Seat Width</h3>
                        <select class="dropdown">
                            <option>20 inches</option>
                            <option>22 inches</option>
                            <option>24 inches</option>
                            <option>26 inches</option>
                        </select>
                    </div> --}}

                    <div class="features-section">
                        <h3 class="section-title">Features & Specification</h3>
                        <div class="feature-list">
                            {!! html_entity_decode($productDetails->features_specification) !!}
                        </div>
                    </div>
                    <div class="get_service_benefits_allbox">
                        <div class="benefits_box">
                            <img src="/front/images/Quick_delivery.svg" alt="Quick_delivery">
                            <p>Quick Delivery</p>
                        </div>
                        <div class="benefits_box">
                            <img src="/front/images/getitwith.svg" alt="getitwith">
                            <p>Get it Within 5 hrs</p>
                        </div>
                        <div class="benefits_box">
                            <img src="/front/images/freeinstolation.svg" alt="freeinstolation">
                            <p>Free Installation</p>
                        </div>
                        <div class="benefits_box">
                            <img src="/front/images/24hours.svg" alt="24hours">
                            <p>Emergency Help</p>
                        </div>
                    </div>

                    {{-- <div class="more-details">
                        More Details <span>▼</span>
                    </div>

                    <div class="specifications">
                        {!! html_entity_decode($productDetails->about_item) !!}
                    </div> --}}
                </div>

                </div>
                @if($isMobile)
                    <div class="purchase-section">

                        {{-- <div class="share-icon">🔗</div> --}}
        <div style="background: linear-gradient(94.59deg, rgba(35, 63, 140, 0.1) 46.28%, rgba(255, 204, 92, 0.1) 94.61%);">
                        <div class="buy-rent-buttons">
                            <button class="buy-btn buynowborder-show" id="buynowsummerybtn" onclick="chnagesection('buy',this);">Purchase</button>
                            <button class="rent-btn buynowborder-noshow" id="rentnowsectionbtn" onclick="chnagesection('rent',this);">
                                Rent Now
                                <span class="save-badge">Save 30%</span>
                            </button>
                        </div>
                       <div id="buynowsummery" class="byunowsection">
                        <div class="purchase-price">₹ {{ $productDetails->our_price }}</div>
                        @if (!isset($productDetails->productAttributes) || $productDetails->productAttributes->stock == 0)
                        <div class="stock-status" style="color:red;">Out of Stock</div>
                        @else
                        <div class="stock-status">In Stock</div>
                        @endif
                        <div class="delivery-text">FREE delivery in india</div>

                        <div class="quantity-section">
                            <label class="quantity-label">Quantity:</label>
                            <div class="quantity-controls">
                                <button class="quantity-btn" onclick="decreaseQuantity()">−</button>
                                <input type="number" class="quantity-input" value="1" id="quantity" min="1" max="1">
                                <button class="quantity-btn" onclick="increaseQuantity()">+</button>
                            </div>
                        </div>
                        <div id="quantity-error-sucess" style="margin-top: 10px; margin-bottom: 10px; color: red;"></div>

                        <div class="pincode-section">
                            <label class="pincode-label">Pin Code Availability</label>
                            <div class="pincode-controls">
                                <input type="text" id="pinCode" class="pincode-input" placeholder="Enter Pincode" maxlength="6">
                                <button class="check-btn" id="check-btn" onclick="checkPincode()">Check</button>
                             
                            </div>
                            <div id="pincode-error-sucess" style="margin-top: 10px;"></div>
                        </div>
                        @if($productDetails->productAttributes->stock == 0)
                <button class="pay-btn"  style="background: linear-gradient(94.59deg, rgba(35, 63, 140, 0.05) 46.28%, rgba(255, 204, 92, 0.05) 94.61%);border: 1.5px solid #FFCC5C;color: #F2A602;font-weight: 700;" id="proceedButton" data-cartid="97">Add to cart</button>
                @else
                <button class="pay-btn" onclick="addToCart({{ $productDetails->id }})" style="background: linear-gradient(94.59deg, rgba(35, 63, 140, 0.05) 46.28%, rgba(255, 204, 92, 0.05) 94.61%);border: 1.5px solid #FFCC5C;color: #F2A602;font-weight: 700;" id="proceedButton" data-cartid="97">Add to cart</button>
                @endif
                @if($productDetails->productAttributes->stock == 0)
                <button class="pay-btn" style="font-weight: 700;     background: linear-gradient(94.59deg, rgba(35, 63, 140, 0.05) 46.28%, rgba(255, 204, 92, 0.05) 94.61%);
    border: 1.5px solid #dddddd; color:red;" id="proceedButton" data-cartid="97">Sold Out</button>
                @else
                    <button onclick="buynowProduct({{ $productDetails->id }})" class="pay-btn" style="font-weight: 700;" id="proceedButton" data-cartid="97">Proceed
                        to Pay</button>
                @endif
                       </div>
                       <div class="content1" id="rentnowsection" style="display: none; height: auto;">
                        <div class="tenure-section">
                            {{-- <div class="tenure-label">Select Tenure -</div>
                            <div class="tenure-display">
                                <span id="tenure-months">18</span> months
                            </div> --}}
                            <div class="tenure-slider-container">
                                <input type="range" min="0" max="100" value="18" class="tenure-slider" id="tenureSlider">
                            </div>
                            <div class="tenure-months">
                                <span>0</span>
                                <span>12</span>
                                <span>24</span>
                                <span>36</span>
                                <span>48</span>
                                <span>100</span>
                            </div>
                        </div>

                        <div class="order-summary">
                            <div class="summary-title">Order Summary</div>
                            <div class="summary-item">
                                <span>Product A</span>
                                <span>₹ 1,200</span>
                            </div>
                            <div class="summary-item">
                                <span>Product B</span>
                                <span>₹ 450</span>
                            </div>
                            <div class="summary-item">
                                <span>Total GST</span>
                                <span>₹ 96</span>
                            </div>
                            <div class="summary-item discount">
                                <span>Offer Discount Applied</span>
                                <span>- ₹ 150</span>
                            </div>
                            <div class="summary-item">
                                <span>Delivery & Installation (Free)</span>
                                <span>₹ 0</span>
                            </div>
                            <div class="summary-item total">
                                <span>Total Payable</span>
                                <span>₹ 1,596.00</span>
                            </div>
                        </div>
                        <button class="pay-btn" onclick="addToCart({{ $productDetails->id }})" style="background: linear-gradient(94.59deg, rgba(35, 63, 140, 0.05) 46.28%, rgba(255, 204, 92, 0.05) 94.61%);border: 1.5px solid #FFCC5C;color: #F2A602;font-weight: 700;" id="proceedButton" data-cartid="97">Add to cart</button>
                            <button onclick="buynowProduct({{ $productDetails->id }})" class="pay-btn" style="font-weight: 700;" id="proceedButton" data-cartid="97">Proceed
                                to Pay</button>
                    </div>

        </div>
                       <div style="padding: 10px; background-color: unset;"></div>
                        <div class="also-available" style="background: linear-gradient(94.59deg, rgba(35, 63, 140, 0.1) 46.28%, rgba(255, 204, 92, 0.1) 94.61%);">
                            <div class="also-available-header">
                                <h3>Also Available On:</h3>
                                <div class="warning-icon"><img src="/front/images/amzon.svg" alt="amzon"></div>
                            </div>
                            <div class="related-item">
                                <div class="related-image">🩼</div>
                                <div class="related-info">
                                    <div class="related-name">Walking Stick</div>
                                    <div class="related-price">₹ 150</div>
                                </div>
                            </div>
                        </div>
                        <div style="padding: 10px; background-color: unset;"></div>
                        <div class="also-available" style="background: linear-gradient(94.59deg, rgba(35, 63, 140, 0.1) 46.28%, rgba(255, 204, 92, 0.1) 94.61%);">
                            <div class="also-available-header" style="gap: 36px;" id="chat-toggle-button">
                                <h3>Need support? Click here to chat!</h3>
                                <div class="warning-icon"><img src="/front/images/samll_chat_gpt.svg" alt="Bot" style="    width: 30px;
    height: 30px;"></div>
                            </div>
                            
                        </div>
                    </div>
                    @endif
                    @if ($productDetails->about_item != '')
                    <div class="features_specification">
                        <h2>About this item</h2>
                        <ul>
                            {!! html_entity_decode($productDetails->about_item) !!}
                        </ul>
                    </div>
                @endif
                @if ($productDetails->measurements != '')
                    <div class="features_specification">
                        <h2>Measurements</h2>
                        <ul>
                            {!! html_entity_decode($productDetails->measurements) !!}
                        </ul>
                    </div>
                @endif
                @if ($productDetails->usage_instructions != '')
                    <div class="features_specification">
                        <h2>Usage instructions</h2>
                        <ul>
                            {!! html_entity_decode($productDetails->usage_instructions) !!}
                        </ul>
                    </div>
                @endif
                @if ($productDetails->why_choose_this_product != '')
                    <div class="features_specification">
                        <h2>Why Choose This Product</h2>
                        <ul>
                            {!! html_entity_decode($productDetails->why_choose_this_product) !!}
                        </ul>
                    </div>
                @endif
                <section class="frequently_asked_questions" style="margin-top: 41px;">
                    {{-- <div class="containerforfilters" style="display: block;"> --}}
                        <div class="faq_title"><h2>Frequently asked questions</h2></div>
                        <div class="filter">
                    
                       </div>
                                                                        <div class="faq_box" id="category_1">
                            <a href="javascript:void(0)"><p>Do you provide after-sales support?</p><img src="/front/images/jam_plus.svg" alt="jam_plus"></a>
                            <div class="faq_box_text" style="display: none;">
                                <p>Yes, we provide guidance and support for using our products. Contact our team for any assistance.</p>
                            </div>
                        </div>
                                                                                                <div class="faq_box" id="category_4" style="display: none;">
                            <a href="javascript:void(0)"><p>Is Aarogyaa Bharat available for emergencies?</p><img src="/front/images/jam_plus.svg" alt="jam_plus"></a>
                            <div class="faq_box_text" style="display: none;">
                                <p>Yes, we have a dedicated 24/7 emergency support team to assist you with urgent medical equipment needs. Your health and well-being are our top priority.</p>
                            </div>
                        </div>
                                                <div class="faq_box" id="category_1">
                            <a href="javascript:void(0)"><p>How do I contact your emergency support team?</p><img src="/front/images/jam_plus.svg" alt="jam_plus"></a>
                            <div class="faq_box_text" style="display: none;">
                                <p>You can reach our emergency support team via:

                Hotline: +91 9921407039
                Email: help@aarogyaabharat.com
                WhatsApp chat: Available on our website 24/7.</p>
                            </div>
                        </div>
                                                                                                <div class="faq_box" id="category_4" style="display: none;">
                            <a href="javascript:void(0)"><p>What services are available during emergencies?</p><img src="/front/images/jam_plus.svg" alt="jam_plus"></a>
                            <div class="faq_box_text" style="display: none;">
                                <p>Our team can assist with:

                Immediate product inquiries.
                Urgent rental arrangements for equipment like oxygen concentrators, ventilators, and hospital beds.
                Quick guidance on product usage and setup.</p>
                            </div>
                        </div>
                                                <div class="faq_box" id="category_1">
                            <a href="javascript:void(0)"><p>Can you deliver medical equipment on the same day in emergencies?</p><img src="/front/images/jam_plus.svg" alt="jam_plus"></a>
                            <div class="faq_box_text" style="display: none;">
                                <p>Yes, for emergency cases, we offer same-day delivery in select cities. Contact our emergency support team to check availability.</p>
                            </div>
                        </div>
                                                                        <div class="faq_box" id="category_1">
                            <a href="javascript:void(0)"><p>Do you provide on-call medical advice during emergencies?</p><img src="/front/images/jam_plus.svg" alt="jam_plus"></a>
                            <div class="faq_box_text" style="display: none;">
                                <p>While we do not offer medical advice, we can guide you in selecting the right equipment and connect you with relevant medical professionals if needed.</p>
                            </div>
                        </div>
                                                                    {{-- </div> --}}

                </section>


            </div>

            <!-- Right Section - Purchase Options -->
            @if(!$isMobile)
            <div class="purchase-section">

                {{-- <div class="share-icon">🔗</div> --}}
<div style="background: linear-gradient(94.59deg, rgba(35, 63, 140, 0.1) 46.28%, rgba(255, 204, 92, 0.1) 94.61%);">
                <div class="buy-rent-buttons">
                    <button class="buy-btn buynowborder-show" id="buynowsummerybtn" onclick="chnagesection('buy',this);">Purchase</button>
                    <button class="rent-btn buynowborder-noshow" id="rentnowsectionbtn" onclick="chnagesection('rent',this);">
                        Rent Now
                        <span class="save-badge">Save 30%</span>
                    </button>
                </div>
               <div id="buynowsummery" class="byunowsection">
                <div class="purchase-price">₹ {{ $productDetails->our_price }}</div>
                @if (!isset($productDetails->productAttributes) || $productDetails->productAttributes->stock == 0)
                <div class="stock-status" style="color:red;">Out of Stock</div>
                @else
                <div class="stock-status">In Stock</div>
                @endif
                <div class="delivery-text">FREE delivery in india</div>

                <div class="quantity-section">
                    <label class="quantity-label">Quantity:</label>
                    <div class="quantity-controls">
                        <button class="quantity-btn" onclick="decreaseQuantity()">−</button>
                        <input type="number" class="quantity-input" value="1" id="quantity" min="1" max="1">
                        <button class="quantity-btn" onclick="increaseQuantity()">+</button>
                    </div>
                    
                </div>
                <div id="quantity-error-sucess" style="margin-top: 10px; margin-bottom: 10px; color: red;"></div>
                <div class="pincode-section">
                    <label class="pincode-label">Pin Code Availability</label>
                    <div class="pincode-controls">
                        <input type="text" id="pinCode" class="pincode-input" placeholder="Enter Pincode" maxlength="6">
                        <button class="check-btn" id="check-btn" onclick="checkPincode()">Check</button>
                     
                    </div>
                    <div id="pincode-error-sucess" style="margin-top: 10px;"></div>
                </div>
                @if($productDetails->productAttributes->stock == 0)
                <button class="pay-btn"  style="background: linear-gradient(94.59deg, rgba(35, 63, 140, 0.05) 46.28%, rgba(255, 204, 92, 0.05) 94.61%);border: 1.5px solid #FFCC5C;color: #F2A602;font-weight: 700;" id="proceedButton" data-cartid="97">Add to cart</button>
                @else
                <button class="pay-btn" onclick="addToCart({{ $productDetails->id }})" style="background: linear-gradient(94.59deg, rgba(35, 63, 140, 0.05) 46.28%, rgba(255, 204, 92, 0.05) 94.61%);border: 1.5px solid #FFCC5C;color: #F2A602;font-weight: 700;" id="proceedButton" data-cartid="97">Add to cart</button>
                @endif
                @if($productDetails->productAttributes->stock == 0)
                <button class="pay-btn" style="font-weight: 700;     background: linear-gradient(94.59deg, rgba(35, 63, 140, 0.05) 46.28%, rgba(255, 204, 92, 0.05) 94.61%);
    border: 1.5px solid #dddddd; color:red;" id="proceedButton" data-cartid="97">Sold Out</button>
                @else
                    <button onclick="buynowProduct({{ $productDetails->id }})" class="pay-btn" style="font-weight: 700;" id="proceedButton" data-cartid="97">Proceed
                        to Pay</button>
                @endif
               </div>
               <div class="content1" id="rentnowsection" style="display: none; height: auto;">
                <div class="tenure-section">
                    {{-- <div class="tenure-label">Select Tenure -</div>
                    <div class="tenure-display">
                        <span id="tenure-months">18</span> months
                    </div> --}}
                    <div class="tenure-slider-container">
                        <input type="range" min="0" max="100" value="18" class="tenure-slider" id="tenureSlider">
                    </div>
                    <div class="tenure-months">
                        <span>0</span>
                        <span>12</span>
                        <span>24</span>
                        <span>36</span>
                        <span>48</span>
                        <span>100</span>
                    </div>
                </div>

                <div class="order-summary">
                    <div class="summary-title">Order Summary</div>
                    <div class="summary-item">
                        <span>Product A</span>
                        <span>₹ 1,200</span>
                    </div>
                    <div class="summary-item">
                        <span>Product B</span>
                        <span>₹ 450</span>
                    </div>
                    <div class="summary-item">
                        <span>Total GST</span>
                        <span>₹ 96</span>
                    </div>
                    <div class="summary-item discount">
                        <span>Offer Discount Applied</span>
                        <span>- ₹ 150</span>
                    </div>
                    <div class="summary-item">
                        <span>Delivery & Installation (Free)</span>
                        <span>₹ 0</span>
                    </div>
                    <div class="summary-item total">
                        <span>Total Payable</span>
                        <span>₹ 1,596.00</span>
                    </div>
                </div>
                @if($productDetails->productAttributes->stock == 0)
                <button class="pay-btn"  style="background: linear-gradient(94.59deg, rgba(35, 63, 140, 0.05) 46.28%, rgba(255, 204, 92, 0.05) 94.61%);border: 1.5px solid #FFCC5C;color: #F2A602;font-weight: 700;" id="proceedButton" data-cartid="97">Add to cart</button>
                @else
                <button class="pay-btn" onclick="addToCart({{ $productDetails->id }})" style="background: linear-gradient(94.59deg, rgba(35, 63, 140, 0.05) 46.28%, rgba(255, 204, 92, 0.05) 94.61%);border: 1.5px solid #FFCC5C;color: #F2A602;font-weight: 700;" id="proceedButton" data-cartid="97">Add to cart</button>
                @endif
                @if($productDetails->productAttributes->stock == 0)
                <button class="pay-btn" style="font-weight: 700;     background: linear-gradient(94.59deg, rgba(35, 63, 140, 0.05) 46.28%, rgba(255, 204, 92, 0.05) 94.61%);
    border: 1.5px solid #dddddd; color:red;" id="proceedButton" data-cartid="97">Sold Out</button>
                @else
                    <button onclick="buynowProduct({{ $productDetails->id }})" class="pay-btn" style="font-weight: 700;" id="proceedButton" data-cartid="97">Proceed
                        to Pay</button>
                @endif
            </div>

</div>
               <div style="padding: 10px; background-color: unset;"></div>
                <div class="also-available" style="background: linear-gradient(94.59deg, rgba(35, 63, 140, 0.1) 46.28%, rgba(255, 204, 92, 0.1) 94.61%);">
                    <div class="also-available-header">
                        <h3>Also Available On:</h3>
                        <div class="warning-icon"><img src="/front/images/amzon.svg" alt="amzon" style=></div>
                    </div>
                    <div class="related-item">
                        <div class="related-image">🩼</div>
                        <div class="related-info">
                            <div class="related-name">Walking Stick</div>
                            <div class="related-price">₹ 150</div>
                        </div>
                    </div>
                </div>
                <div style="padding: 10px; background-color: unset;"></div>
                        <div class="also-available" style="background: linear-gradient(94.59deg, rgba(35, 63, 140, 0.1) 46.28%, rgba(255, 204, 92, 0.1) 94.61%);">
                            <div class="also-available-header" style="gap: 36px;" id="chat-toggle-button">
                                <h3>Need support? Click here to chat!</h3>
                                <div class="warning-icon"><img src="/front/images/samll_chat_gpt.svg" alt="Bot" style="    width: 30px;
    height: 30px;"></div>
                            </div>
                            
                        </div>
            </div>
            @endif
        </div>

    </div>
    <div class="recent-product-recently-viewed recent-products">
        <div class="recent-product-section-title">Recently Viewed</div>
        <div class="recent-product-products-slider">
          <!-- Repeat product-card divs here -->
          @foreach ($recentViewedProducts as $product)
          <div class="recent-product-product-card">
            <img src="{{ asset('storage/' . $product->image) }}" class="recent-product-product-image" alt="{{ $product->name }}"/>
            <div class="recent-product-product-name"> {{ Str::limit($product->name, 35) }}</div>
            <div class="recent-product-product-price">
              <span class="recent-product-currency">₹</span>{{ $product->price }}
            
            </div>
          </div>
            @endforeach
          <!-- Duplicate above product-card for more products -->
        </div>
      </div>
    {{-- <section class="frequently_asked_questions" style="margin-top: 41px;">
        <div class="containerforfilters" style="display: block;">
            <div class="faq_title"><h2>Frequently asked questions</h2></div>
            <div class="filter">
        <div class="filtertitle">
            <p>Filter</p>
            <img src="/front/images/Filter.svg" alt="Filter">
        </div>
        <ul>
                                <li>
                    <a href="javascript:void(0);" onclick="changeTab('1')">
                        <span>General</span>
                        <img src="/front/images/Vector_plus.svg" alt="Vector_plus">
                    </a>
                </li>
                        <li>
                    <a href="javascript:void(0);" onclick="changeTab('2')">
                        <span>Cancel</span>
                        <img src="/front/images/Vector_plus.svg" alt="Vector_plus">
                    </a>
                </li>
                        <li>
                    <a href="javascript:void(0);" onclick="changeTab('3')">
                        <span>Refund</span>
                        <img src="/front/images/Vector_plus.svg" alt="Vector_plus">
                    </a>
                </li>
                        <li>
                    <a href="javascript:void(0);" onclick="changeTab('4')">
                        <span>Aarogyaa bharat</span>
                        <img src="/front/images/Vector_plus.svg" alt="Vector_plus">
                    </a>
                </li>
                        </ul>
    </div>

                                                            <div class="faq_box" id="category_4" style="display: none;">
                <a href="javascript:void(0)"><p>What is Aarogyaa Bharat?</p><img src="/front/images/jam_plus.svg" alt="jam_plus"></a>
                <div class="faq_box_text" style="display: none;">
                    <p>Aarogyaa bharat is an online store specializing in medical equipment, including analytical nebulizers, oxygen concentrators, adult diapers, ventilators, hospital beds, masks, and more. We also provide rental options for selected products.</p>
                </div>
            </div>
                                    <div class="faq_box" id="category_1">
                <a href="javascript:void(0)"><p>Does Aarogya Bhart offer rental services?</p><img src="/front/images/jam_plus.svg" alt="jam_plus"></a>
                <div class="faq_box_text" style="display: none;">
                    <p>Yes, some of our products, such as hospital beds, oxygen concentrators, and ventilators, are available for rent. Please check the product details for rental availability.</p>
                </div>
            </div>
                                                            <div class="faq_box" id="category_1">
                <a href="javascript:void(0)"><p>Who can use the medical equipment you sell?</p><img src="/front/images/jam_plus.svg" alt="jam_plus"></a>
                <div class="faq_box_text" style="display: none;">
                    <p>Our products are suitable for individuals, hospitals, clinics, and home care settings. If you have specific needs, feel free to contact our support team for advice.</p>
                </div>
            </div>
                                                                                    <div class="faq_box" id="category_4" style="display: none;">
                <a href="javascript:void(0)"><p>How do I place an order?</p><img src="/front/images/jam_plus.svg" alt="jam_plus"></a>
                <div class="faq_box_text" style="display: none;">
                    <p>Browse our website, select your desired product, add it to the cart, and proceed to checkout. You will receive confirmation once your order is placed successfully.</p>
                </div>
            </div>
                                            <div class="faq_box" id="category_2" style="display: none;">
                <a href="javascript:void(0)"><p>What payment methods do you accept?</p><img src="/front/images/jam_plus.svg" alt="jam_plus"></a>
                <div class="faq_box_text" style="display: none;">
                    <p>We accept credit cards, debit cards, UPI, net banking, and cash on delivery (COD) in select areas.</p>
                </div>
            </div>
                                                    <div class="faq_box" id="category_1">
                <a href="javascript:void(0)"><p>Can I cancel or modify my order?</p><img src="/front/images/jam_plus.svg" alt="jam_plus"></a>
                <div class="faq_box_text" style="display: none;">
                    <p>Yes, orders can be modified or canceled before they are shipped. Contact our customer support team immediately to process your request.</p>
                </div>
            </div>
                                                                                    <div class="faq_box" id="category_4" style="display: none;">
                <a href="javascript:void(0)"><p>Do you deliver to all locations in India?</p><img src="/front/images/jam_plus.svg" alt="jam_plus"></a>
                <div class="faq_box_text" style="display: none;">
                    <p>Yes, we deliver across India. However, delivery times and availability may vary based on your location.</p>
                </div>
            </div>
                                    <div class="faq_box" id="category_1">
                <a href="javascript:void(0)"><p>How long does delivery take?</p><img src="/front/images/jam_plus.svg" alt="jam_plus"></a>
                <div class="faq_box_text" style="display: none;">
                    <p>Delivery typically takes 2-7 business days, depending on your location and product availability.</p>
                </div>
            </div>
                                                                    <div class="faq_box" id="category_2" style="display: none;">
                <a href="javascript:void(0)"><p>Is there a shipping charge?</p><img src="/front/images/jam_plus.svg" alt="jam_plus"></a>
                <div class="faq_box_text" style="display: none;">
                    <p>Shipping is free for orders above a certain value. For smaller orders, nominal charges may apply, which will be displayed at checkout.</p>
                </div>
            </div>
                                                                    <div class="faq_box" id="category_3" style="display: none;">
                <a href="javascript:void(0)"><p>How do I track my order?</p><img src="/front/images/jam_plus.svg" alt="jam_plus"></a>
                <div class="faq_box_text" style="display: none;">
                    <p>Once your order is shipped, you will receive a tracking link via email or SMS. You can use this link to monitor your delivery status.</p>
                </div>
            </div>
                                                            <div class="faq_box" id="category_3" style="display: none;">
                <a href="javascript:void(0)"><p>What is your return policy?</p><img src="/front/images/jam_plus.svg" alt="jam_plus"></a>
                <div class="faq_box_text" style="display: none;">
                    <p>We accept returns for damaged or defective products within 7 days of delivery. Please refer to our return policy page for details.</p>
                </div>
            </div>
                                                            <div class="faq_box" id="category_3" style="display: none;">
                <a href="javascript:void(0)"><p>How do I request a refund?</p><img src="/front/images/jam_plus.svg" alt="jam_plus"></a>
                <div class="faq_box_text" style="display: none;">
                    <p>To initiate a refund, contact our customer service team with your order details. Refunds are processed within 5-7 business days after the return is approved.</p>
                </div>
            </div>
                                            <div class="faq_box" id="category_1">
                <a href="javascript:void(0)"><p>What if the product is damaged during delivery?</p><img src="/front/images/jam_plus.svg" alt="jam_plus"></a>
                <div class="faq_box_text" style="display: none;">
                    <p>If your product is damaged, please contact us within 24 hours of receiving it. We will arrange a replacement or refund.</p>
                </div>
            </div>
                                                                                    <div class="faq_box" id="category_4" style="display: none;">
                <a href="javascript:void(0)"><p>Do you provide installation services?</p><img src="/front/images/jam_plus.svg" alt="jam_plus"></a>
                <div class="faq_box_text" style="display: none;">
                    <p>Yes, for equipment like hospital beds and ventilators, we offer installation services. Details will be provided at the time of purchase.</p>
                </div>
            </div>
                                    <div class="faq_box" id="category_1">
                <a href="javascript:void(0)"><p>Can I get a demo of the product before purchasing?</p><img src="/front/images/jam_plus.svg" alt="jam_plus"></a>
                <div class="faq_box_text" style="display: none;">
                    <p>For selected products, demos can be arranged. Contact our customer service team for assistance.</p>
                </div>
            </div>
                                                                    <div class="faq_box" id="category_2" style="display: none;">
                <a href="javascript:void(0)"><p>Do your products come with a warranty?</p><img src="/front/images/jam_plus.svg" alt="jam_plus"></a>
                <div class="faq_box_text" style="display: none;">
                    <p>Yes, all products come with a manufacturer's warranty. Warranty details are mentioned in the product description.</p>
                </div>
            </div>
                                                    <div class="faq_box" id="category_1">
                <a href="javascript:void(0)"><p>How can I contact customer support?</p><img src="/front/images/jam_plus.svg" alt="jam_plus"></a>
                <div class="faq_box_text" style="display: none;">
                    <p>You can reach us via:
    Email: Help@aarogyaabharat.com
    Phone: +91 9921407039
    Live chat on our website.</p>
                </div>
            </div>
                                                                                                                            <div class="faq_box" id="category_4" style="display: none;">
                <a href="javascript:void(0)"><p>Can I visit your store physically?</p><img src="/front/images/jam_plus.svg" alt="jam_plus"></a>
                <div class="faq_box_text" style="display: none;">
                    <p>Currently, we operate online only. All orders and queries can be handled through our website.</p>
                </div>
            </div>
                                    <div class="faq_box" id="category_1">
                <a href="javascript:void(0)"><p>How do you ensure product quality?</p><img src="/front/images/jam_plus.svg" alt="jam_plus"></a>
                <div class="faq_box_text" style="display: none;">
                    <p>We source our products directly from trusted manufacturers and conduct thorough quality checks before dispatching them.</p>
                </div>
            </div>
                                                            <div class="faq_box" id="category_1">
                <a href="javascript:void(0)"><p>Do you provide after-sales support?</p><img src="/front/images/jam_plus.svg" alt="jam_plus"></a>
                <div class="faq_box_text" style="display: none;">
                    <p>Yes, we provide guidance and support for using our products. Contact our team for any assistance.</p>
                </div>
            </div>
                                                                                    <div class="faq_box" id="category_4" style="display: none;">
                <a href="javascript:void(0)"><p>Is Aarogyaa Bharat available for emergencies?</p><img src="/front/images/jam_plus.svg" alt="jam_plus"></a>
                <div class="faq_box_text" style="display: none;">
                    <p>Yes, we have a dedicated 24/7 emergency support team to assist you with urgent medical equipment needs. Your health and well-being are our top priority.</p>
                </div>
            </div>
                                    <div class="faq_box" id="category_1">
                <a href="javascript:void(0)"><p>How do I contact your emergency support team?</p><img src="/front/images/jam_plus.svg" alt="jam_plus"></a>
                <div class="faq_box_text" style="display: none;">
                    <p>You can reach our emergency support team via:

    Hotline: +91 9921407039
    Email: help@aarogyaabharat.com
    WhatsApp chat: Available on our website 24/7.</p>
                </div>
            </div>
                                                                                    <div class="faq_box" id="category_4" style="display: none;">
                <a href="javascript:void(0)"><p>What services are available during emergencies?</p><img src="/front/images/jam_plus.svg" alt="jam_plus"></a>
                <div class="faq_box_text" style="display: none;">
                    <p>Our team can assist with:

    Immediate product inquiries.
    Urgent rental arrangements for equipment like oxygen concentrators, ventilators, and hospital beds.
    Quick guidance on product usage and setup.</p>
                </div>
            </div>
                                    <div class="faq_box" id="category_1">
                <a href="javascript:void(0)"><p>Can you deliver medical equipment on the same day in emergencies?</p><img src="/front/images/jam_plus.svg" alt="jam_plus"></a>
                <div class="faq_box_text" style="display: none;">
                    <p>Yes, for emergency cases, we offer same-day delivery in select cities. Contact our emergency support team to check availability.</p>
                </div>
            </div>
                                                            <div class="faq_box" id="category_1">
                <a href="javascript:void(0)"><p>Do you provide on-call medical advice during emergencies?</p><img src="/front/images/jam_plus.svg" alt="jam_plus"></a>
                <div class="faq_box_text" style="display: none;">
                    <p>While we do not offer medical advice, we can guide you in selecting the right equipment and connect you with relevant medical professionals if needed.</p>
                </div>
            </div>
                                                        </div>

    </section> --}}
    <div class="reviews-container">
        <h2 class="reviews-title">User Reviews</h2>

        <div class="reviews-content">
            <!-- Left Section: Rating and Bars -->
            <div class="rating-left-section">
                <div class="rating-summary">

                    <span class="rating-score" style="display: flex;">4.5/5 <p class="star">★</p> </span>
                    {{-- <span class="star">★</span> --}}
                    <span class="percentage">88%</span>
                </div>
                <div class="review-stats">

                    <span class="rating-score">  273 Reviews</span>
                    <span class="rating-score">Recommended</span>
                </div>



                <div class="rating-bars">
                    <div class="rating-bar">
                        <span class="rating-number">5</span>
                        <div class="bar-container">
                            <div class="bar-fill bar-5"></div>
                        </div>
                    </div>
                    <div class="rating-bar">
                        <span class="rating-number">4</span>
                        <div class="bar-container">
                            <div class="bar-fill bar-4"></div>
                        </div>
                    </div>
                    <div class="rating-bar">
                        <span class="rating-number">3</span>
                        <div class="bar-container">
                            <div class="bar-fill bar-3"></div>
                        </div>
                    </div>
                    <div class="rating-bar">
                        <span class="rating-number">2</span>
                        <div class="bar-container">
                            <div class="bar-fill bar-2"></div>
                        </div>
                    </div>
                    <div class="rating-bar">
                        <span class="rating-number">1</span>
                        <div class="bar-container">
                            <div class="bar-fill bar-1"></div>
                        </div>
                    </div>
                </div>

                <div class="write-review-container">
                    <button class="write-review-btn" onclick="openReviewModal()">Write a review</button>
                </div>
            </div>

            <!-- Right Section: Reviews -->
            <div class="rating-right-section">
                <div class="reviews-section">

                    <div class="review-item">
                        <div class="review-rating">
                            <span class="reviewer-name">Omkar Kalbhor</span>
                            <span class="review-stars">★★★★★</span>
                        </div>
                        <div class="review-text">
                            Towering performance by Matt Damon as a troubled working class whiz needs to address his creative genius elevates this drama way above its therapeutic approach, resulting in a zeitgeist film that may touch chord with young viewers the way The Graduate did
                        </div>
                        <div class="review-meta">
                            {{-- <span class="reviewer-name">Omkar Kalbhor</span> --}}
                            <span class="review-date">04.13.2017</span>
                        </div>
                    </div>

                    <div class="review-item">
                        <div class="review-rating">
                            <span class="reviewer-name">Omkar Kalbhor</span>
                            <span class="review-stars">★★★★★</span>
                        </div>
                        <div class="review-text">
                            Towering performance by Matt Damon as a troubled working class whiz needs to address his creative genius elevates this drama way above its therapeutic approach, resulting in a zeitgeist film that may touch chord with young viewers the way The Graduate did
                        </div>
                        <div class="review-meta">
                            {{-- <span class="reviewer-name">Omkar Kalbhor</span> --}}
                            <span class="review-date">04.13.2017</span>
                        </div>
                    </div>
                </div>

                <button class="load-more-btn">Load More</button>
            </div>
        </div>
        @if($isMobile)
        <div class="cart_buy" style=" position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
    background: #fff;
    z-index: 9;
    padding: 16px 0;
    box-shadow: 0 -2px 8px rgba(0,0,0,0.05);
    display: flex;
    justify-content: center;
    gap: 16px;
">
@if($productDetails->productAttributes->stock == 0)
            <button type="button"  class="addtocart" data-id="2283">Add to Cart</button>

            <a href="#;" class="btn_buynow" id="buy-now-button" style="background: linear-gradient(94.59deg, rgba(35, 63, 140, 0.05) 46.28%, rgba(255, 204, 92, 0.05) 94.61%);
    border: 1.5px solid #dddddd; color:red;">Sold Out</a>
            @else
            <button type="button" onclick="addToCart({{ $productDetails->id }})" class="addtocart" data-id="2283">Add to Cart</button>

            <a href="#;" class="btn_buynow" onclick="buynowProduct({{ $productDetails->id }})" id="buy-now-button" data-productid="2283">Proceed to Pay</a>
            @endif
     </div>
     @endif
    </div>
    <div class="modal-overlay" id="reviewModal">
        <div class="modal">
            <div class="modal-header">
                <h3 class="modal-title">Write a Review</h3>
                <button class="close-btn" onclick="closeReviewModal()">&times;</button>
            </div>

            <!-- Login Required Section -->
            <div class="login-required" id="loginSection">
                <div class="login-icon">👤</div>
                <div class="login-message">Please log in to write a review</div>
                <div class="login-submessage">You need to be logged in to share your thoughts</div>
                <div>
                  <a href="{{ route('login') }}">  <button class="login-btn" >Log In</button></a>
                  <a href="{{ route('register') }}" > <button class="signup-btn" >Sign Up</button> </a>
                </div>
            </div>

            <!-- Review Form Section -->
            <div class="review-form" id="reviewForm">
                <form onsubmit="submitReview(event)">
                    <div class="form-group">
                        <label class="form-label">Rating</label>
                        <div class="star-rating" id="starRating">
                            <button type="button" class="star-rating-btn" data-rating="1">★</button>
                            <button type="button" class="star-rating-btn" data-rating="2">★</button>
                            <button type="button" class="star-rating-btn" data-rating="3">★</button>
                            <button type="button" class="star-rating-btn" data-rating="4">★</button>
                            <button type="button" class="star-rating-btn" data-rating="5">★</button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="reviewText">Your Review</label>
                        <textarea 
                            class="form-textarea" 
                            id="reviewText" 
                            placeholder="Share your thoughts about this movie..."
                            required
                        ></textarea>
                    </div>

                    <div class="form-actions">
                        <button type="button" class="cancel-btn" onclick="closeReviewModal()">Cancel</button>
                        <button type="submit" class="submit-btn" id="submitBtn" disabled>Submit Review</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


<script>
    // Simulate user login status (change to true to test logged in state)
    @if (Auth::check() && Auth::user()->hasRole('Customer'))
    let isUserLoggedIn = true;
    @else
    let isUserLoggedIn = false;
    @endif
    let selectedRating = 0;

    function openReviewModal() {
        const modal = document.getElementById('reviewModal');
        const loginSection = document.getElementById('loginSection');
        const reviewForm = document.getElementById('reviewForm');

        if (isUserLoggedIn) {
            loginSection.style.display = 'none';
            reviewForm.classList.add('active');
        } else {
            loginSection.style.display = 'block';
            reviewForm.classList.remove('active');
        }

        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeReviewModal() {
        const modal = document.getElementById('reviewModal');
        modal.classList.remove('active');
        document.body.style.overflow = 'auto';
        
        // Reset form
        resetForm();
    }

    function handleLogin() {
        // Simulate login process
        alert('Login functionality would be implemented here');
        // After successful login:
        // isUserLoggedIn = true;
        // openReviewModal();
    }

    function handleSignup() {
        // Simulate signup process
        alert('Signup functionality would be implemented here');
        // After successful signup:
        // isUserLoggedIn = true;
        // openReviewModal();
    }

    function resetForm() {
        selectedRating = 0;
        document.getElementById('reviewText').value = '';
        document.getElementById('submitBtn').disabled = true;
        
        // Reset stars
        const stars = document.querySelectorAll('.star-rating-btn');
        stars.forEach(star => star.classList.remove('active'));
    }

    function submitReview(event) {
            event.preventDefault();
            
            const reviewText = document.getElementById('reviewText').value;
            const submitBtn = document.getElementById('submitBtn');
            
            if (selectedRating === 0) {
                alert('Please select a rating');
                return;
            }

            if (!reviewText.trim()) {
                alert('Please write a review');
                return;
            }

            // Disable submit button and show loading state
            submitBtn.disabled = true;
            submitBtn.textContent = 'Submitting...';

            // Get product ID (you can set this dynamically based on your page)
            const productId = {{ $productDetails->id }}; // You'll need to implement this function

            // Prepare data for Laravel backend
            const reviewData = {
                product_id: productId,
                rating: selectedRating,
                review: reviewText.trim(),
                _token: '{{ csrf_token() }}'
            };

            // Make AJAX request to Laravel
            fetch('/reviews', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify(reviewData)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Success response
                    alert('Review submitted successfully!');
                    closeReviewModal();
                    
                    // Optionally refresh the reviews section
                    // loadReviews();
                    
                    // Or add the review to the current list without refresh
                    // addReviewToList(data.review);
                } else {
                    // Handle validation errors
                    if (data.errors) {
                        let errorMessage = 'Validation errors:\n';
                        Object.keys(data.errors).forEach(key => {
                            errorMessage += `- ${data.errors[key].join(', ')}\n`;
                        });
                        alert(errorMessage);
                    } else {
                        alert(data.message || 'Failed to submit review');
                    }
                }
            })
            .catch(error => {
                console.error('Error submitting review:', error);
                
                if (error.message.includes('401')) {
                    alert('You need to be logged in to submit a review');
                    // Redirect to login or show login modal
                    isUserLoggedIn = false;
                    openReviewModal();
                } else if (error.message.includes('422')) {
                    alert('Please check your input and try again');
                } else if (error.message.includes('500')) {
                    alert('Server error. Please try again later');
                } else {
                    alert('Failed to submit review. Please check your connection and try again');
                }
            })
            .finally(() => {
                // Reset submit button
                submitBtn.disabled = false;
                submitBtn.textContent = 'Submit Review';
            });
        }

    function updateSubmitButton() {
        const reviewText = document.getElementById('reviewText').value;
        const submitBtn = document.getElementById('submitBtn');
        
        submitBtn.disabled = selectedRating === 0 || !reviewText.trim();
    }

    // Star rating functionality
    document.addEventListener('DOMContentLoaded', function() {
        const stars = document.querySelectorAll('.star-rating-btn');
        const reviewTextarea = document.getElementById('reviewText');

        stars.forEach(star => {
            star.addEventListener('click', function() {
                selectedRating = parseInt(this.dataset.rating);
                
                // Update star display
                stars.forEach((s, index) => {
                    if (index < selectedRating) {
                        s.classList.add('active');
                    } else {
                        s.classList.remove('active');
                    }
                });
                
                updateSubmitButton();
            });

            star.addEventListener('mouseover', function() {
                const hoverRating = parseInt(this.dataset.rating);
                stars.forEach((s, index) => {
                    if (index < hoverRating) {
                        s.style.color = '#ffa500';
                    } else {
                        s.style.color = '#ddd';
                    }
                });
            });
        });

        // Reset hover effect
        document.getElementById('starRating').addEventListener('mouseleave', function() {
            stars.forEach((s, index) => {
                if (index < selectedRating) {
                    s.style.color = '#ffa500';
                } else {
                    s.style.color = '#ddd';
                }
            });
        });

        // Update submit button on text change
        reviewTextarea.addEventListener('input', updateSubmitButton);

        // Close modal on overlay click
        document.getElementById('reviewModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeReviewModal();
            }
        });

        // Toggle login status for testing (remove in production)
        document.addEventListener('keydown', function(e) {
            if (e.key === 'L' && e.ctrlKey) {
                isUserLoggedIn = !isUserLoggedIn;
                console.log('Login status:', isUserLoggedIn ? 'Logged In' : 'Logged Out');
            }
        });
    });
</script>
    <input type="hidden" id="razorpay-key" value="{{ env('RAZORPAY_KEY') }}">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" data-reload="true"></script>
    <script src="{{ asset('front/js/jquery.min.js') }}"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
    function buynowProduct(productId) {
        
                // e.preventDefault();

                // var productId = $(this).data('productid');
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                var razorpayKey = $('#razorpay-key').val();

                $.ajax({
                    url: `/create-order/${productId}`,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    data: {
                        amount: 50000 * 100 // Convert INR to paise
                    },
                    success: function(data) {
                        if (data.error) {
                            // if(data.error=='')
                            document.getElementById('logoutPopup3').style.display = 'flex';
                            // toastr.error(data.error);
                            return;
                        }

                        var options = {
                            "key": razorpayKey,
                            "amount": data.amount,
                            "currency": "INR",
                            "name": "Aarogyaa Bharat",
                            "description": "Purchase product {{ $productDetails->name }}: " +
                                data.amount,
                            "order_id": data.id,
                            "handler": function(response) {
                                $.ajax({
                                    url: '/verify-payment',
                                    type: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': csrfToken
                                    },
                                    data: {
                                        razorpay_payment_id: response
                                            .razorpay_payment_id,
                                        razorpay_order_id: response
                                            .razorpay_order_id,
                                        razorpay_signature: response
                                            .razorpay_signature
                                    },
                                    success: function(response) {
                                        if (response.message ===
                                            'Payment Verified') {
                                            // toastr.success(
                                            //     'Payment successful!');
                                            var form = $('<form>', {
                                                'action': "{{ route('thanks') }}",
                                                'method': 'GET'
                                            });
                                            form.append($('<input>', {
                                                'type': 'hidden',
                                                'name': 'order_id',
                                                'value': response
                                                    .order_id
                                            }));
                                            $('body').append(form);
                                            form.submit();
                                            // window.location.href = "{{ route('thanks') }}?order_id=" + response.order_id;
                                        } else {
                                            // toastr.error(
                                            //     'Payment verification failed!'
                                            //     );
                                            document.getElementById(
                                                    'logoutPopup3').style
                                                .display = 'flex';
                                        }
                                    },
                                    error: function(xhr) {
                                        // toastr.error(
                                        //     'Payment verification error: ' +
                                        //     xhr.responseJSON.error);
                                        document.getElementById(
                                                'logoutPopup3').style
                                            .display = 'flex';
                                    }
                                });
                            },
                            "prefill": {
                                "name": data.customer.name,
                                "email": data.customer.email,
                                "contact": data.customer.mobile
                            },
                            "theme": {
                                "color": "#F37254"
                            }
                        };

                        var rzp1 = new Razorpay(options);
                        rzp1.open();
                    },
                    error: function(xhr) {
                        //   document.getElementById('logoutPopup3').style.display='flex';
                        // toastr.error(xhr.responseJSON.error|| xhr.responseJSON.message || 'An error occurred.');
                        if (xhr.responseJSON.message ==
                            'Please add an address to proceed with payment.') {
                            document.getElementById('text-btween-cartpopup').innerHTML =
                                'Let's add your address first.'
                            cartPopup();
                            localStorage.setItem('address_required', '1');
                            window.location.href = "{{ route('customers.profile') }}";


                        } else if (xhr.responseJSON.message ==
                            'Please login to proceed with payment.') {
                            window.location.href = "{{ route('login') }}"
                        } else if(xhr.responseJSON.error ==
                        'Product is out of stock!'){
                            document.getElementById('text-btween-cartpopup').innerHTML = xhr.responseJSON.error;
                            document.getElementById('text-btween-cartpopup').style.color = 'red';
                            cartPopup();
                        } else{
                            document.getElementById('logoutPopup3').style.display = 'flex';
                        }
                    }
                });
            }
        function increaseQuantity() {
            var input = document.getElementById('quantity');
            var max = parseInt(input.max, 10);
            var current = parseInt(input.value, 10);
            var errorDiv = document.getElementById('quantity-error-sucess');
            if (current < max) {
                input.value = current + 1;
                errorDiv.textContent = '';
            } else {
                errorDiv.textContent = 'You cannot order more than ' + max + ' item(s) for this product.';
            }
        }

        function decreaseQuantity() {
            var input = document.getElementById('quantity');
            var min = parseInt(input.min, 10);
            var current = parseInt(input.value, 10);
            var errorDiv = document.getElementById('quantity-error-sucess');
            if (current > min) {
                input.value = current - 1;
                errorDiv.textContent = '';
            } else {
                errorDiv.textContent = '';
            }
        }

        document.getElementById('quantity').addEventListener('input', function() {
            var input = this;
            var min = parseInt(input.min, 10);
            var max = parseInt(input.max, 10);
            var val = parseInt(input.value, 10);
            var errorDiv = document.getElementById('quantity-error-sucess');
            if (val > max) {
                errorDiv.textContent = 'You cannot order more than ' + max + ' item(s) for this product.';
                input.value = max;
            } else if (val < min) {
                errorDiv.textContent = 'You must order at least ' + min + ' item(s).';
                input.value = min;
            } else {
                errorDiv.textContent = '';
            }
        });

        function checkPincode() {
            const pincodeInput = document.querySelector('.pincode-input');
            const pinCode = pincodeInput.value.trim();

            // var pinCode = $('#pinCode').val();

// Clear previous styles
$('#pincode-error-sucess').removeClass('text-success text-danger');

// Simple validation for empty input
if (pinCode === '' || pinCode.length !== 6) {
    $('#pincode-error-sucess')
        .text('Please enter a valid 6-digit pin code.')
        .removeClass('text-success') // Remove success if previously added
        .addClass('text-danger');
    return;
}


$.ajax({
    url: "{{ route('checkpin') }}",
    method: 'GET',
    data: {
        pin: pinCode,
    },
    success: function (response) {
        if (response.available) {
            $('#pincode-error-sucess')
                .text('Delivery is available.')
                .addClass('text-success');
        } else {
            $('#pincode-error-sucess')
                .text('Sorry, we do not deliver to this pin code.')
                .addClass('text-danger');
        }
    },
    error: function () {
        $('#pincode-error-sucess')
            .text('An error occurred while checking the pin code.')
            .addClass('text-danger');
    }
});
        }

        // Add click handlers for thumbnails
        document.querySelectorAll('.thumbnail').forEach((thumb, index) => {
            thumb.addEventListener('click', function() {
                document.querySelectorAll('.thumbnail').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Add click handler for more details
        document.querySelector('.more-details').addEventListener('click', function() {
            const arrow = this.querySelector('span');
            if (arrow.textContent === '▼') {
                arrow.textContent = '▲';
                document.querySelector('.specifications').style.display = 'block';
            } else {
                arrow.textContent = '▼';
                document.querySelector('.specifications').style.display = 'none';
            }
        });
        function chnagesection(section,element){
            if(section=='buy'){
             document.getElementById('rentnowsection').style.display="none";
             document.getElementById('rentnowsectionbtn').classList.add("buynowborder-noshow");
             document.getElementById('rentnowsectionbtn').classList.remove("rentnowborder-show");

             document.getElementById('buynowsummery').style.display="block";
             document.getElementById('buynowsummerybtn').classList.remove("buynowborder-noshow");
             document.getElementById('buynowsummerybtn').classList.add("buynowborder-show");

            }else{
                document.getElementById('buynowsummerybtn').classList.remove("buynowborder-show");
             document.getElementById('buynowsummerybtn').classList.add("buynowborder-noshow");
                document.getElementById('rentnowsection').style.display="block";
                document.getElementById('rentnowsectionbtn').classList.add("rentnowborder-show");
             document.getElementById('rentnowsectionbtn').classList.remove("buynowborder-noshow");
                document.getElementById('buynowsummery').style.display="none";
            }
        }
    </script>
    <script>
        function changeMainImage(src, el) {
            document.getElementById('mainProductImage').src = src;
            document.querySelectorAll('.thumbnail').forEach(function(thumb) {
                thumb.classList.remove('active');
            });
            el.classList.add('active');
        }

        // Swipe functionality for main image (touch and mouse)
        (function() {
            const mainImage = document.getElementById('mainProductImage');
            let startX = 0;
            let endX = 0;
            // Touch events (mobile)
            mainImage.addEventListener('touchstart', function(e) {
                startX = e.touches[0].clientX;
            });
            mainImage.addEventListener('touchend', function(e) {
                endX = e.changedTouches[0].clientX;
                handleSwipe(endX - startX);
            });
            // Mouse events (desktop)
            let isDragging = false;
            mainImage.addEventListener('mousedown', function(e) {
                isDragging = true;
                startX = e.clientX;
            });
            mainImage.addEventListener('mouseup', function(e) {
                if (!isDragging) return;
                isDragging = false;
                endX = e.clientX;
                handleSwipe(endX - startX);
            });
            function handleSwipe(diff) {
                if (Math.abs(diff) > 40) { // threshold for swipe/drag
                    const thumbnails = Array.from(document.querySelectorAll('.thumbnail'));
                    const activeIndex = thumbnails.findIndex(thumb => thumb.classList.contains('active'));
                    let newIndex = activeIndex;
                    if (diff < 0) {
                        // Swipe left/drag left: next image
                        newIndex = (activeIndex + 1) % thumbnails.length;
                    } else {
                        // Swipe right/drag right: previous image
                        newIndex = (activeIndex - 1 + thumbnails.length) % thumbnails.length;
                    }
                    if (newIndex !== activeIndex) {
                        const newThumb = thumbnails[newIndex];
                        const img = newThumb.querySelector('img');
                        if (img) {
                            changeMainImage(img.src, newThumb);
                        }
                    }
                }
            }
        })();

function addToCart(productId) {
    $.ajax({
        url: "{{ route('cart.add', ['productId' => '__ID__']) }}".replace('__ID__', productId),
        method: 'POST',
        data: {
            _token: "{{ csrf_token() }}"
        },
        success: function (response) {
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
        error: function () {
            document.getElementById('logoutPopup3').style.display = 'flex';
        }
    });
}


    

    </script>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.faq_box > a').forEach(function(anchor) {
        anchor.addEventListener('click', function() {
            var answer = this.nextElementSibling;
            var icon = this.querySelector('img');
            if (!answer || !icon) return;
            var display = answer.style.display;
            if (!display) {
                display = window.getComputedStyle(answer).display;
            }
            var isOpen = display === 'block';
            if (isOpen) {
                // answer.style.display = 'none';
                icon.src = '/front/images/jam_plus.svg';
            } else {
                // answer.style.display = 'block';
                icon.src = '/front/images/jam_minus.svg';
            }
        });
    });
});
</script>
</div>
@endsection('content')

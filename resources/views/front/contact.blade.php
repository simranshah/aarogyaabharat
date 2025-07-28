@extends('front.layouts2.layout2')
@section('content')
<style>
     .conatct-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: start;
        }
</style>
{{-- <div class="banneranimationbox" >
                <div class="container">
                @if (isset($contactPageData) && isset($contactPageData->cms) && $contactPageData->cms->images && $contactPageData->cms->images->isNotEmpty())
                  <img src="{{ asset('storage/' .$contactPageData->cms->images->first()->path) }}" alt="" style="height: 300px; margin-bottom: 15px;">
                @else
                        <img src="{{ asset('front/images/banner.jpg') }}" alt="banner" style="height: 300px; margin-bottom: 15px;">
                @endif
				</div>
            </div> --}}
<div class="breadcrumbs">
    <div class="container">
        <ul>
            <li><a href="{{ route('home') }}">Home</a> </li>
            <li><a href="{{ route('front.contact') }}">Contact us</a> </li>
        </ul>
    </div>    
</div>
@php
    $isMobile = request()->header('User-Agent') && preg_match('/mobile|android|iphone|ipad|phone/i', request()->header('User-Agent'));
@endphp
       @if(! $isMobile)
       <div class="conatct-container">
       @else
       <div class="container">
       @endif
        <div class="contact-info" style="height: 100%">
            <h2>Contact Us</h2>
            <div class="info-item">
                <div class="info-icon"><svg xmlns="http://www.w3.org/2000/svg" width="55" height="24" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
</svg></div>
                <div class="info-content" >
                    <h3>Headquarters</h3>
                    <p>Office- 05, 1st Floor, Choice Arcade, Balkrishna Sakharam Dhole Patil Rd, opp. Ruby Hall Clinic, Sangamvadi, Pune, Maharashtra 411001</p>
                </div>
            </div>
            <div class="info-item">
                <div class="info-icon"><img src="/front/images/phone_call.svg" alt="phone_call"></div>
                <div class="info-content">
                    <h3>Phone</h3>
                    <p><a href="tel:+919921407039">+91 9921407039</a></p>
                    <p class="contact-note">24/7 Support Available</p>
                   
                </div>
            </div>
            <div class="info-item">
                <div class="info-icon"><img src="/front/images/mail.svg" alt="mail"></div>
                <div class="info-content">
                    <h3>Email</h3>
                    <p><a href="mailto:support@aarogyaabharat.com">support@aarogyaabharat.com</a></p>
                </div>
            </div>
        </div>

        <div class="business-form">
            <h2>Have a Question? We're Here to Help!</h2>

            <form method="POST" action="{{route('contact.store')}}">
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <label for="fullName" class="required-field">Your Name</label>
                        <input type="text" id="fullName" name="name" placeholder="e.g., Omkar K" value="{{ old('name') }}" required>
                         @error('name')
                            <div class="errormsg">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email" class="required-field">Email</label>
                        <input type="email" id="email" name="email" placeholder="contact@yourfacility.com" value="{{ old('email') }}" required>
                         @error('email')
                            <div class="errormsg">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="phone" class="required-field">Phone</label>
                        <input type="tel" id="phone" name="phone_no" placeholder="Best number to reach you" value="{{ old('phone_no') }}" required>
                         @error('phone_no')
                            <div class="errormsg">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="inquiryType" class="required-field">What's your inquiry about?</label>
                        <select id="inquiryType" name="subject" required>
                            <option value="">Select inquiry type...</option>
                            <option value="product-info" @if(old('subject')=='product-info') selected @endif>Product Information & Specifications</option>
                            <option value="bulk-order" @if(old('subject')=='bulk-order') selected @endif>Bulk Order Inquiry</option>
                            <option value="quote" @if(old('subject')=='quote') selected @endif>Request a Quote</option>
                            <option value="order-status" @if(old('subject')=='order-status') selected @endif>Order Status & Tracking</option>
                            <option value="shipping" @if(old('subject')=='shipping') selected @endif>Shipping & Delivery Questions</option>
                            <option value="returns" @if(old('subject')=='returns') selected @endif>Returns & Replacements</option>
                            <option value="warranty" @if(old('subject')=='warranty') selected @endif>Warranty & Service</option>
                            <option value="payment" @if(old('subject')=='payment') selected @endif>Payment & Billing</option>
                            <option value="account" @if(old('subject')=='account') selected @endif>Account Support</option>
                            <option value="other" @if(old('subject')=='other') selected @endif>Other Inquiry</option>
                        </select>
                         @error('subject')
                            <div class="errormsg">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="required-field">Your Inquiry</label>
                    <textarea id="message" name="message" placeholder="What equipment are you looking for?"
                        required>{{old('message')}}</textarea>
                         @error('message')
                            <div class="errormsg">{{ $message }}</div>
                        @enderror
                </div>
                <p class="required-note"><small>* Required fields</small></p>
                <button type="submit" class="submit-btn">Get Expert Advice</button>
            </form>
        </div>
    </div>

    <div class="map-section">
        <div class="map-header">
            <h2>Visit Our Headquarters</h2>
            <p>Our main office is located in Pune, with regional offices across India.</p>
        </div>
        <!-- map-container now only holds the map -->
        <div class="map-container">
            <div class="map-placeholder">
                <iframe src="https://maps.google.com/maps?q=18.536308789845695,73.87684559223267&z=14&output=embed"
                    title="Pune office location" frameborder="0" allowfullscreen loading="lazy" class="iframmap" ></iframe>
                </div>
        </div>
    </div>








    <script>
       
    </script>


{{-- <section class="our_blog">
    <div class="container">
       <div class="titlePart2">
            <h4>Our Blogs</h4> 
        </div>
        <div class="our_blog_all_box">
            <div class="row18">
            @php
                $randomBlog = $contactusBlog->random();
            @endphp
            <div class="our_blog_box">
                <div class="blog_image"><img src="{{ asset('storage/' .$randomBlog->images->first()->path) }}" alt="" /></div>
                <div class="blog_text">
                    <div class="text_one">
                        <a href="{{ route('blog.details', ['slug' => $randomBlog->slug]) }}">
                            <h1>{{$randomBlog->title}}</h1>
                        </a>    
                        <p>{{$randomBlog->description}}</p></div>
                    <div class="blog_tag_name">
                        <ul>
                            <li class="tagBox"><p>{{ $randomBlog->tagname  }}</p></li>
                            <li class="blogdate"><img src="{{ asset('front/images/calendar.svg')}}" alt="" /><p>{{$randomBlog->created_at->format('m/d/y')}}</p></li>
                            <li class="blogview"><img src="{{ asset('front/images/carbon_view.svg')}}" alt="" /><p>{{ $randomBlog->views}}</p></li>
                            <li><a href="#;"><img src="{{ asset('front/images/ri_share-line.svg')}}" alt="" /></a></li>
                        </ul>
                        <a href="{{ route('blog.details', ['slug' => $randomBlog->slug]) }}" class="blogreadnow">Read Now</a>
                    </div>
                </div>
            </div>
            @if($contactusBlog)
            @foreach($contactusBlog  as $blog)
            <div class="our_blog_box">
                <div class="blog_image"><img src="{{ asset('storage/' .$blog->images->first()->path) }}" alt="" /></div>
                <div class="blog_text">
                    <div class="text_one"><h2>{{$blog->title}}</h2><p>{{$blog->description}}</p></div>
                    <div class="blog_tag_name">
                        <ul>
                            <li class="tagBox"><p>{{ $blog->tagname  }}</p></li>
                            <li class="blogdate"><img src="{{ asset('front/images/calendar.svg')}}" alt="" /><p>{{$blog->created_at->format('m/d/y')}}</p></li>
                            <li class="blogview"><img src="{{ asset('front/images/carbon_view.svg')}}" alt="" /><p>{{ $blog->views}}</p></li>
                            <li><a href="#;"><img src="{{ asset('front/images/ri_share-line.svg')}}" alt="" /></a></li>
                        </ul>
                        <a href="{{ route('blog.details', ['slug' => $blog->slug]) }}" class="blogreadnow">Read Now</a>
                    </div>
                </div> 
             </div>
            @endforeach
            @endif
            </div>
        </div>
        <div class="read_more_blogs"><a href="{{route('blogs')}}"><p>Read More Blogs</p><img src="{{asset('front/images/downArrow.svg')}}" alt="" /></a></div>
    </div>
</section> --}}
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ContactPage",
  "url": "{{ url()->current() }}",
  "mainEntity": {
    "@type": "Organization",
    "name": "Aarogyaa Bharat",
    "contactPoint": {
      "@type": "ContactPoint",
      "telephone": "+91-9921407039",
      "contactType": "Customer Support",
      "areaServed": "IN",
      "availableLanguage": ["English", "Hindi", "Marathi"]
    }
  }
}
</script>

@endsection('content')
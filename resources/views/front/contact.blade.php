@extends('front.layouts.layout')
@section('content')
<div class="banneranimationbox" >
                <div class="container">
                @if (isset($contactPageData) && isset($contactPageData->cms) && $contactPageData->cms->images && $contactPageData->cms->images->isNotEmpty())
                  <img src="{{ asset('storage/' .$contactPageData->cms->images->first()->path) }}" alt="" style="height: 300px; margin-bottom: 15px;">
                @else
                        <img src="{{ asset('front/images/banner.jpg') }}" alt="banner" style="height: 300px; margin-bottom: 15px;">
                @endif
				</div>
            </div>
<div class="breadcrumbs">
    <div class="container">
        <ul>
            <li><a href="{{ route('home') }}">Home</a> </li>
            <li><a href="{{ route('front.contact') }}">Contact us</a> </li>
        </ul>
    </div>    
</div>

<section class="contact_us_text">
    <div class="container">
        
            <form id="contactus-form">
                <!-- Name Field -->
                <div class="contactus-form-group">
                    <label for="name" class="contactus-label">Full Name</label>
                    <input type="text" id="name" name="name" class="contactus-input" placeholder="Enter your name" required>
                </div>
        
                <!-- Email Field -->
                <div class="contactus-form-group">
                    <label for="email" class="contactus-label">Email Address</label>
                    <input type="email" id="email" name="email" class="contactus-input" placeholder="Enter your email" required>
                </div>
        
                <!-- Subject Field -->
                <div class="contactus-form-group">
                    <label for="subject" class="contactus-label">Subject</label>
                    <input type="text" id="subject" name="subject" class="contactus-input" placeholder="Enter subject" required>
                </div>
        
                <!-- Message Field -->
                <div class="contactus-form-group">
                    <label for="message" class="contactus-label">Message</label>
                    <textarea id="message" name="message" class="contactus-textarea" placeholder="Enter your message" required></textarea>
                </div>
        
                <!-- Submit Button -->
                <button type="submit" class="contactus-btn-submit">Send Message</button>
            </form>
            <div class="contact_us_footer">
                <div class="footer_section">
                    <h3>Contact Info</h3>
                    <p><strong style="font-weight: bold;">Email:</strong>{{ env('HELP_LINE_EMAIL') }}</p>
                    <p><strong style="font-weight: bold;">Mobile No:</strong>{{ env('HELP_LINE_NO') }}</p>
                </div>
                <div class="footer_section">
                    <h3>Address</h3>
                    <p>Office- 05, 1st Floor, Choice Arcade, Balkrishna Sakharam Dhole Patil Rd, opp. Ruby Hall Clinic, Sangamvadi, Pune, Maharashtra 411001</p>
                </div>
                <div class="footer_section social">
                    <h3>Social</h3>
                    <div class="social_icons">
                        <div class="icon"><a href="{{ env('FACEBOOK_PAGE_URI') }}"><img
                            src="{{ asset('front/images/facebook.svg') }}" alt="Facebook" /></a></div>
                        <div class="icon"><a href="{{ env('INSTA_PAGE_URI') }}"><img src="{{ asset('front/images/insta.svg') }}"
                            alt="Insta" /></a></div>
                        <div class="icon"><a href="{{ env('X_PAGE_URI') }}"><img src="{{ asset('front/images/Xtwit.svg') }}"
                            alt="X" /></a></div>
                    </div>
                </div>
            </div>
            
    </div>
</section>

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
@endsection('content')
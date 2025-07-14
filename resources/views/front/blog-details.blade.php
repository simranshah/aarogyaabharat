@extends('front.layouts.layout')
@section('content')
<div class="breadcrumbs">
    <div class="container">
        <ul>
            <li><a href="{{route('home')}}">Home</a> </li>
            <li><a href="{{route('blogs')}}">Blog</a> </li>
            <li><a href="#;">Blog Details</a> </li>
        </ul>
    </div>
</div>

<section class="blog_text_data">
    <div class="container">
        <div class="blog_image_box">
            <div class="blog_image_height">
                @if ($blogDetails && $blogDetails->images && $blogDetails->images->isNotEmpty())
                    <img src="{{ asset('storage/' . $blogDetails->images->first()->path) }}" alt="{{$blogDetails->images->first()->alt}}">
                @else
                    <img src="{{ asset('front/images/wheelchair_2.png') }}" alt="Default Image">
                @endif
            </div>
        </div>
        {{-- <div class="blogtext_title">
            <h1>{{ $blogDetails->title  }}</h1>
        </div>
        <div class="blog_tag_name">
          <p class="articalauthor">{{ $blogDetails->author  }}</p>
            <ul>
                <li class="tagBox"><p>{{ $blogDetails->tagname  }}</p></li>
                <li class="blogdate"><img src="{{ asset('front/images/calendar.svg') }}" alt="calendar"><p>{{$blogDetails->created_at->format('m/d/y')}}</p></li>
                <li class="blogview"><img src="{{ asset('front/images/carbon_view.svg') }}" alt="carbon_view"><p>{{ $blogDetails->views}}</p></li>
                <li><a href="https://wa.me/?text={{ urlencode('Check out this blog: ' . $blogDetails->title . ' ' . route('blog.details', $blogDetails->slug)) }}"><img src="{{ asset('front/images/ri_share-line.svg') }}" alt="{{$blogDetails->title}}"></a></li>
            </ul>
        </div> --}}

      {{-- <div class="blog-content" id="skipMe">
                {!! html_entity_decode($blogDetails->content_html) !!}
            </div> --}}
            <div class="new-blog-container">
        <main class="new-blog-main-content">
            <div class="new-blog-product-header">
                <div class="blogtext_title">
            <h1>{{ $blogDetails->title  }}</h1>
        </div>
        <div class="blog_tag_name">
          <p class="articalauthor">{{ $blogDetails->author  }}</p>
            <ul>
                <li class="tagBox"><p>{{ $blogDetails->tagname  }}</p></li>
                <li class="blogdate"><img src="{{ asset('front/images/calendar.svg') }}" alt="calendar"><p>{{$blogDetails->created_at->format('m/d/y')}}</p></li>
                <li class="blogview"><img src="{{ asset('front/images/carbon_view.svg') }}" alt="carbon_view"><p>{{ $blogDetails->views}}</p></li>
                <li><a href="https://wa.me/?text={{ urlencode('Check out this blog: ' . $blogDetails->title . ' ' . route('blog.details', $blogDetails->slug)) }}"><img src="{{ asset('front/images/ri_share-line.svg') }}" alt="{{$blogDetails->title}}"></a></li>
            </ul>
        </div>
            </div>

            <div class="new-blog-content" id="skipMe">
              {!! html_entity_decode($blogDetails->content_html) !!}
            </div>
        </main>

        <aside class="new-blog-sidebar">
             <h2 class="new-blog-related-title" >Recommended Product</h2>
            <section class="new-blog-related-section">

                <div class="new-blog-product-grid">
                    @foreach ($products as $product)
                    <div class="new-blog-product-card">
                        <div class="new-blog-product-image"><a href="{{ route('products.sub.category.wise', ['slug' => $product->category->slug,'subSlug'=>$product->slug]) }}">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="height: 100%;width:100%;">
                                </a>  </div>
                        <div class="new-blog-product-name"> {{ Str::limit($product->name,30 ) }}</div>
                        <div class="new-blog-product-price">₹ @indianCurrency($product->our_price)</div>
                       <a href="{{ route('products.sub.category.wise', ['slug' => $product->category->slug,'subSlug'=>$product->slug]) }}"> <button class="new-blog-buy-btn">Buy Now</button> </a>
                    </div>
                    @endforeach
                </div>
            </section>
        </aside>
    </div>
    </div>
</section>

<section class="our_blog">
    <div class="container">
       <div class="titlePart">
            <h4>Our Blogs</h4>
        </div>
        <div class="our_blog_all_box">
            @foreach($twoBlogs as $blog)
            <div class="our_blog_box">
                <div class="blog_image"><img src="{{ asset('storage/' .$blog->images->first()->path) }}" alt="{{$blogDetails->images->first()->alt}}"></div>
                <div class="blog_text">
                    <div class="text_one">
                        <a href="{{ route('blog.details', ['slug' => $blog->slug]) }}">
                            <h1>{{$blog->title}}</h1>
                        </a>
                        <p>{{$blog->description}}</p></div>
                    <div class="blog_tag_name">
                        <ul>
                            <li class="tagBox"><p>{{ $blog->tagname  }}</p></li>
                            <li class="blogdate"><img src="{{ asset('front/images/calendar.svg')}}" alt="calendar" /><p>{{$blog->created_at->format('m/d/y')}}</p></li>
                            <li class="blogview"><img src="{{ asset('front/images/carbon_view.svg')}}" alt="carbon_view" /><p>{{ $blog->views}}</p></li>
                            <li><a href="https://wa.me/?text={{ urlencode('Check out this blog: ' . $blog->title . ' ' . route('blog.details', $blog->slug)) }}"><img src="{{ asset('front/images/ri_share-line.svg')}}" alt="share" /></a></li>
                        </ul>
                        <a href="{{ route('blog.details', ['slug' => $blog->slug]) }}" class="blogreadnow">Read Now</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Blog",
  "headline": "{{ $blogDetails->title  }}",
  "image": {
    "@type": "ImageObject",
    "url": "{{url('/')}}{{ asset('storage/' . $blogDetails->images->first()->path) }}",
    "alt": "{{url('/')}}{{ $blogDetails->images->first()->alt }}"
  },
  "author": {
    "@type": "Person",
    "name": "Aarogyaa Bharat"
  },
  "url": "{{ url()->current() }}",
  "description": "{{$blogDetails->description}}",
  "publisher": {
    "@type": "Organization",
    "name": "Aarogyaa Bharat",
    "logo": {
      "@type": "ImageObject",
      "url": "{{url('/')}}{{ asset('front/images/Favicon-new.svg') }}"
    }
  }
}
</script>

@endsection

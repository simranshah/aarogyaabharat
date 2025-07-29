@extends('front.layouts2.layout2')
@section('content')
<style>
    .breadcrumbs {
    float: left;
    width: 100%;
    margin-top: 58px;
    margin-bottom: 24px;
}
</style>

<div class="breadcrumbs">
    <div class=" breadcrumbs-container">
        <div class="">
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('blogs') }}">Blog</a></li>
            </ul>
        </div>

        <div class="search-wrapper">
            <div class="search-box">
                <button class="search-button">
                    <img src="{{ asset('front/images/search.svg') }}" alt="Search">
                </button>
                <input 
                    type="text" 
                    id="searchInput" 
                    class="search-input" 
                    placeholder="Search"
                    onkeydown="if (event.keyCode === 13) { searchblogsinput(this.value); }"
                    oninput="showSuggestionsbolg(this.value)"
                >
                <a href="#" class="search-arrow">
                    <img src="{{ asset('front/images/search_arrow.svg') }}" alt="Go">
                </a>
            </div>

            <div class="search-suggestions" id="searchSuggestions"></div>

        </div>
    </div>
</div>




<!-- <section class="Trending_Topics">
    <div class="container">
        <div class="Trending_Topics_title"><h2>Trending Topics</h2></div>
        <div class="Products_tag">
            <ul>
                @foreach($trendingBlogs as $trendingBlog)
                <li><a href="{{ route('blog.details', ['slug' => $trendingBlog->slug]) }}"><p>{{$trendingBlog->name}}</p><img src="{{asset('front/images/chartArrow.svg')}}" alt="" /></a></li>
                @endforeach
            </ul>
          </div>
    </div>
</section> -->



<section class="our_blog">
    <div class="container">
       <div class="titlePart2">
            <h4>Recommended Blogs</h4> 
        </div>

        <div class="part_blog">
                @include('front.common.recommended-blog')
                
        </div>
    </div>
</section>
<script src="{{ asset('front/js/jquery.min.js') }}"></script>
<script>

$(document).on('click', '.pagination .page-link', function(e) {
    e.preventDefault();

    var pageText = $(this).text().trim();
    var currentPage = parseInt($('.pagination .page-link.active').text()); 
    var page;

    if (pageText === '««') {
        page = currentPage - 1;
    } else if (pageText === '»»') {
        page = currentPage + 1;
    } else {
        page = parseInt(pageText);
    }

    var data = { page: page };
    var url = $(this).attr('href'); 

    $.ajax({
        url: url,
        type: 'GET',
        data: data,
        success: function(response) {
            if(response.success) {
                $('.part_blog').html(response.recommendedBlogHtml);
            }
        }
    });
});
function showSuggestionsbolg(query) {
    if (query.length > 0) {
        $.ajax({
            url: '/search-blog',
            type: 'GET',
            data: { search: query },
            success: function(response) {
                $('#searchSuggestions').html(response);
                $('#searchSuggestions').show();
            }
        });
    } else {
        $('#searchSuggestions').hide();
    }
}
function searchblogsinput(query) {
    if (query.length > 0) {
        window.location.href = '/search-blog-list/' + query;
    }
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    @foreach($blogs as $index => $blog)
    {
      "@type": "BlogPosting",
      "headline": "{{ $blog->title }}",
      "image": "{{ url('/') }}{{ asset('storage/' . $blog->images->first()->path) }}",
      "author": {
        "@type": "Person",
        "name": "{{ $blog->author }}"
      },
      "datePublished": "{{ $blog->created_at->format('m/d/y') }}",
      "url": "{{ route('blog.details', ['slug' => $blog->slug]) }}"
    }@if(!$loop->last),@endif
    @endforeach
  ]
}
</script>
@endsection

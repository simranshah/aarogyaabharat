@extends('front.layouts.layout')
@section('content')

    <section class="search_result">
        <div class="container">
            <div class="searchFill_title">
                <img src="{{ asset('front/images/Search-Fil.svg') }}" alt="Search" />
                <div class="searchFill_text">
                    <h4>Search Result</h4>
                    <p>We found {{ $blogs->count() }} top blogs based on your search</p>
                </div>
            </div>
        </div>
    </section>

    <section class="product_name_list">
        <div class="container">
            <div class="product_list_text" id='searchlist'>
                @if ($blogs->count() > 0)
                    @foreach ($blogs as $blog)
                        <div class="product_box">
                            <div class="product_img">
                                <img src="{{ asset('storage/' . $blog->images->first()->path) }}" alt="{{ $blog->name }}" />
                            </div>
                            <div class="productbox_text">                               
                                 <a href="{{ route('blog.details', ['slug' => $blog->slug]) }}">
                                     <h2>{{ $blog->name }}</h2>
    
                                 </a>
                                <p>{{ $blog->description }}</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>No Blog found.</p>
                @endif
                {{-- <div class="read_more_blogs" onclick="getmoreSearchResultblog('{{$query}}',10);"><a href="#;">
                        <p>Load More</p><img src="{{ asset('front/images/radix-icons_reload.svg') }}" alt="">
                    </a></div> --}}
            </div>
        </div>
    </section>


    <section class="raise_query">
        <div class="container">
            <a href="{{ route('raise.query') }}">
                <div class="raise_query_box">
                    <div class="rise_text_box">
                        <img src="{{ asset('front/images/raise.svg') }}" alt="raise_query">
                        <div class="rise_text_line">
                            <h4>Raise Query</h4>
                            <p>You can request anything by single click.</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </section>
@endsection('content')
<script>
    
</script>

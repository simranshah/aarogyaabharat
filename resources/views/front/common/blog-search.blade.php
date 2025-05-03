 @if (isset($blogs) && $blogs->count() > 0)
        @foreach ($blogs as $blog)
            <div class="search-suggestion-item">
                <a href="{{ route('blog.details', ['slug' => $blog->slug]) }}">
                    <img src="{{ asset('front/images/search_fil.svg') }}" alt="Icon" />
                    <p>{{ $blog->name }}</p>
                    <img src="{{ asset('front/images/curly_arrow.svg') }}" alt="Arrow" />
                </a>
            </div>
        @endforeach
    @else
        <div class="search-suggestion-item no-result">
            <p>No blogs found.</p>
        </div>
    @endif

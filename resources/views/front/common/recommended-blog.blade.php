<div class="left_part_blog">
                @foreach($blogs as $blog)
                <div class="our_blog_box">
                    <div class="blog_image"><a href="{{ route('blog.details', ['slug' => $blog->slug]) }}">
                        <img src="{{ asset('storage/' . $blog->images->first()->path) }}" alt="{{$blog->images->first()->alt}}" />
                    </a></div>
                    <div class="blog_text">
                        <div class="text_one"><a href="{{ route('blog.details', ['slug' => $blog->slug]) }}" style="color: black;"><h1>{{$blog->title}}</h1></a>
                            <p><a href="{{ route('blog.details', ['slug' => $blog->slug]) }}" style="color: black;">{{$blog->description}}</a></p>
                        </div>
                        <div class="blog_tag_name">
                            <ul>
                                <li class="tagBox"><p>{{ $blog->tagname  }}</p></li>
                                <li class="blogdate"><img src="{{ asset('front/images/calendar.svg')}}" alt="calendar" /><p>{{$blog->created_at->format('m/d/y')}}</p></li>
                                <li class="blogview"><img src="{{ asset('front/images/carbon_view.svg')}}" alt="carbon view" /><p>{{ $blog->views}}</p></li>
                                <li><a href="https://wa.me/?text={{ urlencode('Check out this blog: ' . $blog->title . ' ' . route('blog.details', $blog->slug)) }}"><img src="{{ asset('front/images/ri_share-line.svg')}}" alt="" /></a></li>
                            </ul>
                            <a href="{{ route('blog.details', ['slug' => $blog->slug]) }}" class="blogreadnow">Read Now</a>
                        </div>
                    </div>
                </div>
                @endforeach
</br> 

<div class="pagination">
    @php
        $totalPages = ceil($totalBlogs / $perPage);
        $windowSize = 3;
        $startPage = max(1, $currentPage - 1);
        $endPage = min($totalPages, $currentPage + 1);
        if ($endPage - $startPage < 2) {
            if ($startPage == 1) {
                $endPage = min($totalPages, $startPage + 2); 
            } else {
                $startPage = max(1, $endPage - 2);
            }
        }
    @endphp

    <!-- Previous Button -->
    @if ($currentPage > 1)
        <a  class="page-link"> &laquo;&laquo;   </a>
    @endif

    <!-- Pages Window -->
    @for ($page = $startPage; $page <= $endPage; $page++)
        <a  class="page-link {{ $currentPage == $page ? 'active' : '' }}">
            {{ $page }}
        </a>
    @endfor

    <!-- Next Button -->
    @if ($currentPage < $totalPages)
        <a  class="page-link">&raquo;&raquo;</a>
    @endif
</div>

</div>
@include('front.common.one-blog')
            
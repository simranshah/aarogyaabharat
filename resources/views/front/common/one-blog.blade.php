<div class="right_part_blog">
                <div class="blog_image_box">
                    <div class="blog_image_height">
                       <a href="{{ route('blog.details', ['slug' => $oneBlog->slug]) }}">
                        <img src="{{ asset('storage/' . $oneBlog->images->first()->path) }}" alt="{{ $oneBlog->images->first()->alt }}">
                    </a>
                    </div>
                </div>
                <div class="blog_text">
                    <div class="text_two"><a href="{{ route('blog.details', ['slug' => $oneBlog->slug]) }}" style="color: black;"><h1>{{$oneBlog->title}}</h1></a>
                        <p><a href="{{ route('blog.details', ['slug' => $oneBlog->slug]) }}" style="color: black;">{{$oneBlog->description}}</a></p>
                    </div>
                    <div class="blog_tag_name">
                        <ul>
                            <li class="tagBox"><p>{{ $oneBlog->tagname  }}</p></li>
                            <li class="blogdate"><img src="{{asset('front/images/calendar.svg')}}" alt="calendar"><p>{{$oneBlog->created_at->format('m/d/y')}}</p></li>
                            <li class="blogview"><img src="{{asset('front/images/carbon_view.svg')}}" alt="carbon_view"><p>{{ $oneBlog->views}}</p></li>
                            <li><a href="#;"><img src="{{asset('front/images/ri_share-line.svg')}}" alt="ri_share-line"></a></li>
                        </ul>
                        <a href="{{ route('blog.details', ['slug' => $oneBlog->slug]) }}" class="blogreadnow">Read Now</a>
                    </div>
                </div>
                <div class="read_more_blogs"><a href="{{ route('blogs')}}"><p>Read More Blogs</p><img src="{{asset('front/images/downArrow.svg')}}" alt="downArrow"></a></div>
            </div>
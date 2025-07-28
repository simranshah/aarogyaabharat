@extends('front.layouts2.layout2')
@section('content')

    <section class="search_result">
        <div class="container">
            <div class="searchFill_title">
                <img src="{{ asset('front/images/Search-Fil.svg') }}" alt="Search-Fil" />
                <div class="searchFill_text">
                    <h4>Search Result</h4>
                    <p>We found {{ $products->count() }} top products based on your search</p>
                </div>
            </div>
        </div>
    </section>

    <section class="product_name_list">
        <div class="container">
            <div class="product_list_text" id='searchlist' style="width: 100%">
                @if ($products->count() > 0)
                    @foreach ($products as $product)
                    <a href="{{ route('products.sub.category.wise', ['slug' => $product->category->slug,'subSlug'=>$product->slug]) }}">
                        <div class="product_box">
                            <div class="product_img">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" />
                            </div>
                            <div class="productbox_text" >
                                
                                 <a href="{{ route('products.sub.category.wise', ['slug' => $product->category->slug,'subSlug'=>$product->slug]) }}">
                                    <h2>{{ $product->name }}</h2>
                                 </a>
                                 {{-- <p>{{ $product->description }}</p> --}}
                                <div class="priceshare">
                                    <h3>₹ @indianCurrency($product->our_price)</h3>
                                    {{-- <a target="_blank"
                                        href="https://wa.me/?text={{ urlencode('Check out this product: ' . $product->title . ' ' . route('products.sub.category.wise', ['slug' => $product->category->slug,'subSlug'=>$product->slug])) }}">
                                        <img src="{{ asset('front/images/Share.svg') }}" alt="Share on WhatsApp">
                                        {{-- <img src="{{ asset('front/images/ri_share-line.svg') }}" alt="" /> --}}
                                    {{-- </a> --}}
                                </div>
                            
                            </div>
                        </div>
                    </a>
                    @endforeach
                @else
                    <p>No products found.</p>
                @endif
                <div class="read_more_blogs" onclick="getmoreSearchResult('{{$query}}',10);"><a href="#;">
                        <p>Load More</p><img src="{{ asset('front/images/radix-icons_reload.svg') }}" alt="radix-icons_reload">
                    </a></div>
            </div>
        </div>
    </section>


    <section class="raise_query">
        <div class="container">
            <a href="{{ route('raise.query') }}">
                <div class="raise_query_box">
                    <div class="rise_text_box">
                        <img src="{{ asset('front/images/raise.svg') }}" alt="raise">
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

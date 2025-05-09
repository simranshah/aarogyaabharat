@if (isset($products) && isset($query) && $products->count() > 0)
    @foreach ($products as $product)
        <li>
            <a href="{{ route('products.sub.category.wise', ['slug' => $product->category->slug,'subSlug'=>$product->slug]) }}">
                <img src="{{ asset('front/images/search_fil.svg')}}" alt="search_fil" />
                <p>{{ $product->name }}</p>
                <img src="{{ asset('front/images/curly_arrow.svg')}}" alt="curly_arrow" />
            </a>
        </li>
    @endforeach
@else
    <li>No products found.</li>
@endif

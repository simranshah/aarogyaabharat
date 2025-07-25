<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use App\Models\Admin\Page;
use Illuminate\Support\Facades\Config;
use App\Models\Brand;
use App\Models\reviews;
use App\Models\Admin\SubCategories;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FrontProductController extends Controller
{
    public function index()
    {
        $categoriesAndProducts = Category::with('products')->get();
        $products = Product::with('category')->take(12)->get();
        $seoMeta = Page::where('slug', 'products')->first();
        $seoMetaTag = $seoMeta->seo_meta_tag ?? '';
        $seoMetaTagTitle = $seoMeta->seo_meta_tag_title ?? '';
        $pageTitle = $seoMeta->page_title ?? '';
        return view('front.products', compact('categoriesAndProducts', 'products', 'seoMetaTag', 'seoMetaTagTitle' , 'pageTitle'));
    }

    public function productDetail($slug)
    {
        $faqFilters = Config::get('custom.faq_filter');
        $productDetails = Product::with('productAttributes')->where('slug', $slug)->first();
        // dd(isset($productDetails->productAttributes));
        $products = Product::with('category', 'images')->take(12)->get();
        // dd($productDetails);
        $seoMetaTag = $productDetails->seo_meta_tag ?? '';
        $seoMetaTagTitle = $productDetails->seo_meta_tag_title ?? '';
        $pageTitle = $productDetails->page_title ?? '';
        return view('front.product-details', compact('productDetails', 'products', 'faqFilters', 'seoMetaTag', 'seoMetaTagTitle' , 'pageTitle'));
    }

    public function searchProducts(Request $request)
    {
        $query = $request->input('query');
        $products = Product::with('category')->where('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->get();

        if ($products->isNotEmpty()) {
            return view('front.common.search-product-result', compact('products', 'query'))->render();
        }

        // Optionally return an empty response or a message indicating no products found
        return response()->json(['success' => false, 'message' => 'No products found.']);
    }
    public function searchProductsResult(Request $request, $query)
    {

        $products = Product::with('images','Category')->where('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")->take(10)
            ->get();
        return view('front.search-result', compact('products','query'));
    }

    public function productCatogory(Request $request)
    {
        $categoriesAndProducts = Category::with('products')->get();
        return view('front.product-category', compact('categoriesAndProducts'));
    }
    public function productCatogoryWise(Request $request, $slug)
    {
        $categories = Category::take(12)->get();
        $categoriesAndProducts = Category::with(['products' => function($query) use ($request) {
            // Apply filters here based on $request->input('stock'), 'brand', etc.
            // Example:

            if ($request->filled('brand')) {
                $brandNames = explode('|', $request->input('brand'));
                $query->whereHas('brand', function($q) use ($brandNames) {
                    $q->whereIn('name', $brandNames);
                });
            }
            if ($request->filled('gender')) {
                $genders = explode('|', $request->input('gender'));
                $query->where(function($q) use ($genders) {
                    $q->whereIn('gender', $genders)
                      ->orWhereNull('gender');
                });
            }
            // ...add other filters similarly...
            if ($request->filled('min_price')) {
                $query->where('our_price', '>=', $request->input('min_price'));
            }
            if ($request->filled('max_price')) {
                $query->where('our_price', '<=', $request->input('max_price'));
            }

            if ($request->filled('stock')) {
                $stocks = explode('|', $request->input('stock'));
                $query->where(function($q) use ($stocks) {
                    if (in_array('in stock', $stocks)) {
                        $q->whereHas('productAttributes', function($attrQ) {
                            $attrQ->where('stock', '>', 0);
                        });
                    }
                    if (in_array('out of stock', $stocks)) {
                        $q->orWhereDoesntHave('productAttributes', function($attrQ) {
                            $attrQ->where('stock', '>', 0);
                        });
                    }
                });

            }
            if ($request->filled('discount')) {
                $discounts = explode('|', $request->input('discount'));
                $query->where(function($q) use ($discounts) {
                    foreach ($discounts as $discount) {
                        $q->orWhere('discount_percentage', '<=', (float)$discount);
                    }
                });
            }
            if ($request->filled('subcategory')) {
                $subcategories = explode('|', $request->input('subcategory'));

                $query->whereHas('SubCategories', function($subQ) use ($subcategories) {
                    $subQ->whereIn('name', $subcategories);
                });
            }
            if ($request->filled('sort')) {
                switch ($request->input('sort')) {
                    case 'price-low':
                        $query->orderBy('our_price', 'asc');
                        break;
                    case 'price-high':
                        $query->orderBy('our_price', 'desc');
                        break;
                    case 'rating':
                        $query->orderBy('rating', 'desc');
                        break;
                    case 'newest':
                        $query->orderBy('created_at', 'desc');
                        break;
                    // 'relevance' or default: do not apply any order, or use your own logic
                }
            }

        }],'SubCategories')->where('slug', $slug)->get();

        $categoriesmain = Category::where('slug', $slug)->first();
        $seoMetaTagTitle = $categoriesmain->name . ' Products';
        $pageTitle = $categoriesmain->name . ' Products';
        $seoMetaTag = $categoriesmain->name . ' Category All Products From Aarogyaa Bharat';

        // If AJAX, return only the product grid partial
        if ($request->ajax()) {
            // Calculate total product count after filters
            $total_count = 0;
            foreach ($categoriesAndProducts as $cat) {
                $total_count += $cat->products->count();
            }
            $html = view('front.common.product_grid', compact('categoriesAndProducts'))->render();
            return response()->json(['html' => $html, 'total_count' => $total_count]);
        }
        $brands = Brand::orderBy('name', 'asc')->get();
        // Otherwise, return the full page
        return view('front.product-list', compact('categoriesAndProducts', 'categories', 'slug', 'seoMetaTagTitle', 'pageTitle', 'seoMetaTag','brands','categoriesmain'));
    }
    public function productSubCatogoryWise($slug,$subSlug)
    {
        $faqFilters = Config::get('custom.faq_filter');
        $productDetails = Product::with('productAttributes')->where('slug',$subSlug)->first();
        $latestReviews = reviews::where('product_id', $productDetails->id)
        ->latest()
        ->take(2)
        ->get();

    // 2. Total number of reviews
    $totalReviews = reviews::where('product_id',  $productDetails->id)->count();

    // 3. Rating distribution (1–5)
    $ratingCounts = reviews::select('rating', DB::raw('count(*) as total'))
        ->where('product_id',  $productDetails->id)
        ->groupBy('rating')
        ->pluck('total', 'rating')
        ->toArray();

    // Fill missing rating levels with 0
    $completeRatingCounts = [];
    foreach (range(1, 5) as $star) {
        $completeRatingCounts[$star] = $ratingCounts[$star] ?? 0;
    }

    // Prepare array to pass to view
    $reviewData = [
        'latestReviews' => $latestReviews,
        'totalReviews' => $totalReviews,
        'ratingDistribution' => $completeRatingCounts,
    ];
        // dd(isset($productDetails->productAttributes));
        $products = Product::with('category', 'images')->take(12)->get();
        // dd($productDetails);
        $seoMetaTag = $productDetails->seo_meta_tag ?? '';
        $seoMetaTagTitle = $productDetails->seo_meta_tag_title ?? '';
        $pageTitle = $productDetails->page_title ?? '';
        return view('front.new-product-page', compact('productDetails', 'products', 'faqFilters', 'seoMetaTag', 'seoMetaTagTitle' , 'pageTitle','reviewData'));
    }
    public function searchloadmore($query,$offset){
        $offset=$offset+10;
        $products = Product::with('images','category')->where('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")->take($offset)
            ->get();
        return view('front.common.search-result', compact('products','query','offset'));
    }
    public function productList(Request $request)
    {
        if ($request->filled('categories')) {
            $categorySlugs = explode('|', $request->input('categories'));
        $categoriesAndProducts = Category::whereIn('name', $categorySlugs)->with(['products' => function($query) use ($request) {
            // Apply filters here based on $request->input('stock'), 'brand', etc.
            // Example:

            if ($request->filled('brand')) {
                $brandNames = explode('|', $request->input('brand'));
                $query->whereHas('brand', function($q) use ($brandNames) {
                    $q->whereIn('name', $brandNames);
                });
            }
            if ($request->filled('gender')) {
                $genders = explode('|', $request->input('gender'));
                $query->where(function($q) use ($genders) {
                    $q->whereIn('gender', $genders)
                      ->orWhereNull('gender');
                });
            }
            // ...add other filters similarly...
            if ($request->filled('min_price')) {
                $query->where('our_price', '>=', $request->input('min_price'));
            }
            if ($request->filled('max_price')) {
                $query->where('our_price', '<=', $request->input('max_price'));
            }

            if ($request->filled('stock')) {
                $stocks = explode('|', $request->input('stock'));
                $query->where(function($q) use ($stocks) {
                    if (in_array('in stock', $stocks)) {
                        $q->whereHas('productAttributes', function($attrQ) {
                            $attrQ->where('stock', '>', 0);
                        });
                    }
                    if (in_array('out of stock', $stocks)) {
                        $q->orWhereDoesntHave('productAttributes', function($attrQ) {
                            $attrQ->where('stock', '>', 0);
                        });
                    }
                });

            }
            if ($request->filled('discount')) {
                $discounts = explode('|', $request->input('discount'));
                $query->where(function($q) use ($discounts) {
                    foreach ($discounts as $discount) {
                        $q->orWhere('discount_percentage', '<=', (float)$discount);
                    }
                });
            }
            if ($request->filled('subcategory')) {
                $subcategories = explode('|', $request->input('subcategory'));

                $query->whereHas('SubCategories', function($subQ) use ($subcategories) {
                    $subQ->whereIn('name', $subcategories);
                });
            }
            if ($request->filled('tag')) {
                $tags = explode('|', $request->input('tag'));
                $query->where(function($q) use ($tags) {
                    foreach ($tags as $tag) {
                        $q->orWhere($tag, true); // assuming column values are 1/0 or true/false
                    }
                });
            }
            if ($request->filled('sort')) {
                switch ($request->input('sort')) {
                    case 'price-low':
                        $query->orderBy('our_price', 'asc');
                        break;
                    case 'price-high':
                        $query->orderBy('our_price', 'desc');
                        break;
                    case 'rating':
                        $query->orderBy('rating', 'desc');
                        break;
                    case 'newest':
                        $query->orderBy('created_at', 'desc');
                        break;
                    // 'relevance' or default: do not apply any order, or use your own logic
                }
            }

        }],'SubCategories')->get();
    }else{
        $categoriesAndProducts = Category::with(['products' => function($query) use ($request) {
            // Apply filters here based on $request->input('stock'), 'brand', etc.
            // Example:

            if ($request->filled('brand')) {
                $brandNames = explode('|', $request->input('brand'));
                $query->whereHas('brand', function($q) use ($brandNames) {
                    $q->whereIn('name', $brandNames);
                });
            }
            if ($request->filled('gender')) {
                $genders = explode('|', $request->input('gender'));
                $query->where(function($q) use ($genders) {
                    $q->whereIn('gender', $genders)
                      ->orWhereNull('gender');
                });
            }
            // ...add other filters similarly...
            if ($request->filled('min_price')) {
                $query->where('our_price', '>=', $request->input('min_price'));
            }
            if ($request->filled('max_price')) {
                $query->where('our_price', '<=', $request->input('max_price'));
            }

            if ($request->filled('stock')) {
                $stocks = explode('|', $request->input('stock'));
                $query->where(function($q) use ($stocks) {
                    if (in_array('in stock', $stocks)) {
                        $q->whereHas('productAttributes', function($attrQ) {
                            $attrQ->where('stock', '>', 0);
                        });
                    }
                    if (in_array('out of stock', $stocks)) {
                        $q->orWhereDoesntHave('productAttributes', function($attrQ) {
                            $attrQ->where('stock', '>', 0);
                        });
                    }
                });

            }
            if ($request->filled('discount')) {
                $discounts = explode('|', $request->input('discount'));
                $query->where(function($q) use ($discounts) {
                    foreach ($discounts as $discount) {
                        $q->orWhere('discount_percentage', '<=', (float)$discount);
                    }
                });
            }
            if ($request->filled('subcategory')) {
                $subcategories = explode('|', $request->input('subcategory'));

                $query->whereHas('SubCategories', function($subQ) use ($subcategories) {
                    $subQ->whereIn('name', $subcategories);
                });
            }
            if ($request->filled('tag')) {
                $tags = explode('|', $request->input('tag'));
                $query->where(function($q) use ($tags) {
                    foreach ($tags as $tag) {
                        $q->orWhere($tag, true); // assuming column values are 1/0 or true/false
                    }
                });
            }
            if ($request->filled('sort')) {
                switch ($request->input('sort')) {
                    case 'price-low':
                        $query->orderBy('our_price', 'asc');
                        break;
                    case 'price-high':
                        $query->orderBy('our_price', 'desc');
                        break;
                    case 'rating':
                        $query->orderBy('rating', 'desc');
                        break;
                    case 'newest':
                        $query->orderBy('created_at', 'desc');
                        break;
                    // 'relevance' or default: do not apply any order, or use your own logic
                }
            }

        }],'SubCategories')->get();

    }
        if ($request->ajax()) {
            $total_count = 0;
            foreach ($categoriesAndProducts as $cat) {
                $total_count += $cat->products->count();
            }
            $html = view('front.common.product_grid', compact('categoriesAndProducts'))->render();
            return response()->json(['html' => $html, 'total_count' => $total_count]);
        }
        $categoriesData = Category::all();
        $brands = Brand::orderBy('name', 'asc')->get();
        $subCategoriess = SubCategories::orderBy('name', 'asc')->get();
        $categories = Category::all();
        
        return view('front.main-product-listing', compact('categoriesAndProducts', 'categoriesData','brands','subCategoriess','categories'));
    }
     public function getProductInfo(Request $request)
    {
        $products = Product::all();

        if ($products->isEmpty()) {
            return response()->json(['error' => 'No products found'], 404);
        }

        $response = [];

        foreach ($products as $product) {
            $response[] = [
                'name' => $product->name,
                'title' => $product->title,
                'price' => $product->price,
                'our_price' => $product->our_price,
                'description' => $product->description,
                'features' => str_replace("\n", " ", strip_tags($product->features_specification)),
                'usage' => str_replace("\n", " ", strip_tags($product->usage_instructions)),
                'why_choose' => str_replace("\n", " ", strip_tags($product->why_choose_this_product)),
                'is_popular' => str_replace("\n", " ", strip_tags($product->is_popular)),
                'is_new' => str_replace("\n", " ", strip_tags($product->is_new)),
            ];
        }

        return response()->json($response);
    }
     public function flashSale()
    {
        $products = Product::with('category')->where('flash_sale',1)->get();
        $seoMetaTag = 'Flash Sale Products';
        $seoMetaTagTitle = 'Flash Sale Products';
        $pageTitle = 'Flash Sale Products';
        return view('front.flash-sale', compact('products', 'seoMetaTag', 'seoMetaTagTitle' , 'pageTitle'));
    }
    function topPickForYou()
    {
        $products = Product::with('category')->where('top_pick_for_you',1)->get();
        $seoMetaTag = 'Top Pick For You Products';
        $seoMetaTagTitle = 'Top Pick For You Products';
        $pageTitle = 'Top Pick For You Products';
        return view('front.top-pick-for-you', compact('products', 'seoMetaTag', 'seoMetaTagTitle' , 'pageTitle'));
    }
    function bestSellers()
    {
        $products = Product::with('category')->where('best_selling_products',1)->get();
        $seoMetaTag = 'Best Sellers Products';
        $seoMetaTagTitle = 'Best Sellers Products';
        $pageTitle = 'Best Sellers Products';
        return view('front.bestselling-product', compact('products', 'seoMetaTag', 'seoMetaTagTitle' , 'pageTitle'));
    }
    function topDeals()
    {
        $products = Product::with('category')->where('top_deals',1)->get();
        $seoMetaTag = 'Top Deals Products';
        $seoMetaTagTitle = 'Top Deals Products';
        $pageTitle = 'Top Deals Products';
        return view('front.top-deals-for-you', compact('products', 'seoMetaTag', 'seoMetaTagTitle' , 'pageTitle'));
    }
    function productForYou()
    {
        $products = Product::with('category')->where('product_for_you',1)->get();
        $seoMetaTag = 'Product For You';
        $seoMetaTagTitle = 'Product For You';
        $pageTitle = 'Product For You';
        return view('front.product-for-you', compact('products', 'seoMetaTag', 'seoMetaTagTitle' , 'pageTitle'));
    }
    function sportHealthCare()
    {
        $products = Product::with('category')->where('sports_healthcare_more',1)->get();
        $seoMetaTag = 'Sport Health Care Products';
        $seoMetaTagTitle = 'Sport Health Care Products';
        $pageTitle = 'Sport Health Care Products';
        return view('front.sport-heathcare-product', compact('products', 'seoMetaTag', 'seoMetaTagTitle' , 'pageTitle'));
    }
    function newArrivals()
    {
        $products = Product::with('category')->where('is_new',1)->get();
        $seoMetaTag = 'New Arrivals Products';
        $seoMetaTagTitle = 'New Arrivals Products';
        $pageTitle = 'New Arrivals Products';
        return view('front.new-added-prouct', compact('products', 'seoMetaTag', 'seoMetaTagTitle' , 'pageTitle'));
    }
    function productCategory(Request $request)
    {
      $Brand_id = $request->input('Brand_id');
      $products = Product::with('category')->where('brand_id', $Brand_id)->get();
      return view('front.common.category-products', compact('products'));
    }
    function addreview(Request $request){

          // Validate input
          $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'rating'     => 'required|integer|min:1|max:5',
            'review'     => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors()
            ], 422);
        }

        // Check if user is logged in (or adapt to your auth method)
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'You must be logged in to submit a review'
            ], 401);
        }

        // Create review
        $review = reviews::create([
            'user_id'    => Auth::id(),
            'product_id' => $request->product_id,
            'rating'     => $request->rating,
            'review'     => $request->review,
        ]);
        $avgRating = reviews::where('product_id', $request->product_id)->avg('rating');

        // Update product
        Product::where('id', $request->product_id)->update([
            'rating' => $avgRating,
        ]);
        return response()->json([
            'success' => true,
            'review'  => $review
        ]);
    }

    
}

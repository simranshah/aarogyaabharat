<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use App\Models\Admin\Page;
use Illuminate\Support\Facades\Config;

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
    public function productCatogoryWise($slug)
    {
        $categories = Category::take(12)->get();
        $categoriesAndProducts = Category::with('products')->where('slug',$slug)->get();
        $categoriesmain= Category::where('slug',$slug)->first();
        // dd($categoriesAndProducts);
        $seoMetaTagTitle = $categoriesmain->name.' Products';
        $pageTitle = $categoriesmain->name.' Products';
        $seoMetaTag = $categoriesmain->name .' Category All Products From Aarogyaa Bharat'; 
        return view('front.category-product', compact('categoriesAndProducts', 'categories', 'slug', 'seoMetaTagTitle', 'pageTitle', 'seoMetaTag'));
    }
    public function productSubCatogoryWise($slug,$subSlug)
    {
        $faqFilters = Config::get('custom.faq_filter');
        $productDetails = Product::with('productAttributes')->where('slug',$subSlug)->first();
        // dd(isset($productDetails->productAttributes));
        $products = Product::with('category', 'images')->take(12)->get();
        // dd($productDetails);
        $seoMetaTag = $productDetails->seo_meta_tag ?? ''; 
        $seoMetaTagTitle = $productDetails->seo_meta_tag_title ?? ''; 
        $pageTitle = $productDetails->page_title ?? ''; 
        return view('front.product-details', compact('productDetails', 'products', 'faqFilters', 'seoMetaTag', 'seoMetaTagTitle' , 'pageTitle'));
    }
    public function searchloadmore($query,$offset){
        $offset=$offset+10;
        $products = Product::with('images','category')->where('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")->take($offset)
            ->get();
        return view('front.common.search-result', compact('products','query','offset'));
    }
    public function productList()
    {
        $categoriesAndProducts = Category::with('products')->get();
        $products = Product::with('category')->get();
        return view('front.product-list', compact('categoriesAndProducts', 'products'));
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
}

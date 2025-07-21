<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use App\Models\Admin\Blog;
use App\Models\Admin\Page;
use App\Models\Banner;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::take(12)->get();
        $products =  Product::with('images','Category')->where('is_new', true)->orderBy('updated_at', 'desc')->take(10)->get();
        $blogs = Blog::with('images')->latest()->take(6)->get();
        $seoMeta = Page::where('slug', 'home')->first();
        $seoMetaTag = $seoMeta->seo_meta_tag ?? '';
        $seoMetaTagTitle = $seoMeta->seo_meta_tag_title ?? '';
        $pageTitle = $seoMeta->page_title ?? '';

        return view('front.home', compact('categories', 'products', 'blogs', 'seoMetaTag', 'seoMetaTagTitle' , 'pageTitle'));
    }
     public function index1()
    {
        $categories = Category::take(12)->get();
        $products =  Product::with('images','Category')->where('is_new', true)->orderBy('updated_at', 'desc')->take(10)->get();
        $blogs = Blog::with('images')->latest()->take(6)->get();
        $seoMeta = Page::where('slug', 'home')->first();
        $seoMetaTag = $seoMeta->seo_meta_tag ?? '';
        $seoMetaTagTitle = $seoMeta->seo_meta_tag_title ?? '';
        $pageTitle = $seoMeta->page_title ?? '';
        $homecareproducts = Category::with(['products' => function ($query) {
    $query->limit(8)->with('images');
}])->where('slug', 'home-care')->first();

$medicalequipmentproducts = Category::with(['products' => function ($query) {
    $query->limit(8)->with('images');
}])->where('slug', 'medical-equipment')->first();
  return view('front.new-home', compact('categories', 'products', 'blogs', 'seoMetaTag', 'seoMetaTagTitle' , 'pageTitle', 'homecareproducts', 'medicalequipmentproducts'));
    }

    public function productPage()
    {
        $categoriesAndProducts = Category::with('products')->get();
        $products = Product::with('category')->take(12)->get();
        // $recentViewedProducts = Product::all();
        return view('front.products', compact('categoriesAndProducts','products'));
    }

}

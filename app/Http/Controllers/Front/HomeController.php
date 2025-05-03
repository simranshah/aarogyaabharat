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
        $products = Product::with('category')->take(12)->get(); 
        $blogs = Blog::with('images')->latest()->take(6)->get();
        $seoMeta = Page::where('slug', 'home')->first(); 
        $seoMetaTag = $seoMeta->seo_meta_tag ?? ''; 
        $seoMetaTagTitle = $seoMeta->seo_meta_tag_title ?? '';
        $pageTitle = $seoMeta->page_title ?? '';
         
        return view('front.home', compact('categories', 'products', 'blogs', 'seoMetaTag', 'seoMetaTagTitle' , 'pageTitle'));
    }

    public function productPage()
    {
        $categoriesAndProducts = Category::with('products')->get();
        $products = Product::with('category')->take(12)->get(); 
        // $recentViewedProducts = Product::all(); 
        return view('front.products', compact('categoriesAndProducts','products'));
    }

}

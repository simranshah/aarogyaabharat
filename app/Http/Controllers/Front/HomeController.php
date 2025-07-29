<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use App\Models\Admin\Blog;
use App\Models\Admin\Page;
use App\Models\Admin\SubCategories;
use App\Models\Banner;
use App\Models\Brand;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::with('subcategories.products')->take(12)->get();
        $products =  Product::with('images','Category')->where('is_new', true)->orderBy('updated_at', 'desc')->take(10)->get();
        $blogs = Blog::with('images')->latest()->take(6)->get();
        $seoMeta = Page::where('slug', 'home')->first();
        $seoMetaTag = $seoMeta->seo_meta_tag ?? '';
        $seoMetaTagTitle = $seoMeta->seo_meta_tag_title ?? '';
        $pageTitle = $seoMeta->page_title ?? '';
        $brandsWithProducts = Brand::has('product')->with('product')->get();

        return view('front.home', compact('categories', 'products', 'blogs', 'seoMetaTag', 'seoMetaTagTitle' , 'pageTitle', 'brandsWithProducts'));
    }
     public function index1()
    {
       // Controller (example)
$categories = Category::with('subcategories')->get();
        $products =  Product::with('images','Category','productAttributes')->where('is_new', true)->orderBy('updated_at', 'desc')->take(10)->get();
        $blogs = Blog::with('images')->latest()->take(6)->get();
        $seoMeta = Page::where('slug', 'home')->first();
        $seoMetaTag = $seoMeta->seo_meta_tag ?? '';
        $seoMetaTagTitle = $seoMeta->seo_meta_tag_title ?? '';
        $pageTitle = $seoMeta->page_title ?? '';
        $homecareproducts = SubCategories::whereHas('category', function ($query) {
            $query->where('slug', 'home-care');
        })->with(['category', 'images'])->take(6)->get();

        $medicalequipmentproducts = SubCategories::whereHas('category', function ($query) {
            $query->where('slug', 'medical-equipment');
        })->with(['category', 'images'])->take(6)->get();
        $brandsWithProducts = Brand::whereHas('product.Category')->with('product.Category')->take(6)->get();
        $brandsWithFirstProduct = $brandsWithProducts->first();
        $subCategoriess = SubCategories::with('category')-> orderBy('name', 'asc')->get();
        $subCategoriess = $subCategoriess->unique('name');

  return view('front.new-home', compact('categories', 'products', 'blogs', 'seoMetaTag', 'seoMetaTagTitle' , 'pageTitle', 'homecareproducts', 'medicalequipmentproducts','brandsWithProducts','brandsWithFirstProduct','subCategoriess'));
    }

    public function productPage()
    {
        $categoriesAndProducts = Category::with('products')->get();
        $products = Product::with('category')->take(12)->get();
        // $recentViewedProducts = Product::all();
        return view('front.products', compact('categoriesAndProducts','products'));
    }

}

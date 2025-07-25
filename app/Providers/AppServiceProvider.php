<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Admin\Product;
use App\Models\Admin\FAQ;
use App\Models\Admin\OfferAndDiscount;
use App\Models\Admin\Blog;
use App\Models\Admin\HappyCustomer;
use App\Models\Front\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Banner;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;
use App\Models\Admin\Page;
use App\Models\Admin\Category;
use App\Traits\FormatsIndianCurrency;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //home page products start
        $categories = Category::with('subcategories')->get();
        $productForYou = Product::with('images','category','productAttributes')->where('product_for_you', true)->orderBy('updated_at', 'desc')->take(7)->get();
        $flashSaleProducts = Product::with('images','category','productAttributes')->where('flash_sale', true)->orderBy('updated_at', 'desc')->take(7)->get();
        $bestSellingProducts = Product::with('images','Category','productAttributes')->where('best_selling_products', true)->orderBy('updated_at', 'desc')->take(7)->get();
        $sportsHealthcareMoreProducts = Product::with('images','Category','productAttributes')->where('sports_healthcare_more', true)->orderBy('updated_at', 'desc')->take(7)->get();
        $topDealsProducts = Product::with('images','category','productAttributes')->where('top_deals', true)->orderBy('updated_at', 'desc')->take(7)->get();
        $topPickForYouProducts = Product::with('images','Category','productAttributes')->where('top_pick_for_you', true)->orderBy('updated_at', 'desc')->take(7)->get();
        // dd($productForYou, $flashSaleProducts, $bestSellingProducts, $sportsHealthcareMoreProducts, $topDealsProducts, $topPickForYouProducts);

        //home page products end
        $recentViewedProducts = Product::with('images','category','productAttributes')->orderBy('updated_at', 'desc')->take(7)->get();
        $popularProducts = Product::with('images','category','productAttributes')->where('is_popular', true)->orderBy('updated_at', 'desc')->take(7)->get();
        $offerAndDiscounts = OfferAndDiscount::where('show_on_site', true)->orderBy('updated_at', 'desc')->take(10)->get();
        $contactusBlog = Blog::with('images')->inRandomOrder()->take(4)->get();
        $faqs = FAQ::with('answers')->get();
        $bannerImages = Banner::select('*')->where('is_mobile', false)->get();
        $mobileBannerImages = Banner::select('*')->where('is_mobile', true)->get();
        $happyCustomers = HappyCustomer::all();

        $partners = Page::where('slug', 'partners')->with('cms.images')->first();
        $whyAarogyaBharat = Page::where('slug', 'why-aarogya-bharat')->with('cms.images')->first();
        $aboutAarogyaBharat = Page::where('slug', 'about-aarogya-bharat')->with('cms.images')->first();

        View::share('categories',$categories);
        View::share('recentViewedProducts', $recentViewedProducts);
        View::share('popularProducts', $popularProducts);
        View::share('faqs', $faqs);
        View::share('offerAndDiscounts', $offerAndDiscounts);
        View::share('contactusBlog', $contactusBlog);
        View::share('bannerImages', $bannerImages);
        View::share('mobileBannerImages', $mobileBannerImages);
        View::share('happyCustomers', $happyCustomers);
        View::share('partners', $partners);
        View::share('whyAarogyaBharat', $whyAarogyaBharat);
        View::share('aboutAarogyaBharat', $aboutAarogyaBharat);
        //home page products start
        View::share('productForYou', $productForYou);
        View::share('flashSaleProducts', $flashSaleProducts);
        View::share('bestSellingProducts', $bestSellingProducts);
        View::share('sportsHealthcareMoreProducts', $sportsHealthcareMoreProducts);
        View::share('topDealsProducts', $topDealsProducts);
        View::share('topPickForYouProducts', $topPickForYouProducts);

        //home page products end
        //cart count
        $session_id = session()->get('cart_id');
        \Log::channel('cart_log')->info('AppserviceProvider method - Session ID:', ['session_id' => $session_id]);
        $cartProductCount = Cart::where('user_id', Auth::id())
        ->orWhere('session_id', $session_id)
        ->withCount('cartProducts')
        ->get()
    ->sum('cart_products_count');
        View::share('cartProductCount', $cartProductCount);

        Blade::directive('indianCurrency', function ($amount) {
            return "<?php echo (new class { use \App\Traits\FormatsIndianCurrency; })->formatIndianCurrency($amount); ?>";
        });

    }
}

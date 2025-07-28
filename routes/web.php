<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategory;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\HappyCustomerController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\FAQController;
use App\Http\Controllers\Admin\OfferAndDiscountOcntroller;
use App\Http\Controllers\Admin\StatusController;
use App\Http\Controllers\Admin\ProductAttributeController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\CMSController;
use App\Http\Controllers\Admin\CustomerNotification;
use App\Http\Controllers\BannerController;
//front  controller
use App\Http\Controllers\Front\FrontCmsController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\FrontProductController;
use App\Http\Controllers\Front\RaiseQueryController;
// use App\Http\Controllers\Admin\FrontOfferController;
use App\Http\Controllers\Front\CustomerController as FrontCustomerController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\NewPaymentController;
use App\Http\Controllers\Admin\ContactUsController as FrontContactUsController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\SocialLoginController;
use App\Http\Controllers\contactController;

use App\Http\Controllers\Front\CartController2;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\ArticleSubmissionController;
use App\Http\Controllers\BrandController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//link storage route


Route::get('/storage_link', function (){ Artisan::call('storage:link'); });
Route::get('/download-log/{type}/{date}', function ($type, $date) {
    $filePath = storage_path("logs/{$type}/{$type}-log-{$date}.log");

    if (!file_exists($filePath)) {
        return response()->json(['error' => 'Log file not found'], 404);
    }

    return response()->download($filePath);
});

Route::post('/submit-article', [ArticleSubmissionController::class, 'store'])->name('articles.submit');
Route::post('/contact-us', [contactController::class, 'store'])->name('contact.store');
//front routes
Route::get('/', [HomeController::class, 'index1'])->name('home');
Route::get('/new-home',[HomeController::class, 'index1'])->name('new.home');
// Route::get('/products', [HomeController::class, 'productPage'])->name('products');

//Social login
Route::get('auth/google', [SocialLoginController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [SocialLoginController::class, 'handleGoogleCallback']);
Route::get('auth/facebook', [SocialLoginController::class, 'redirectToFacebook'])->name('facebook.login');
Route::get('auth/facebook/callback', [SocialLoginController::class, 'handleFacebookCallback']);

Route::controller(FrontProductController::class)->group(function () {
    Route::post('/reviews','addreview')->name('adsreview');
    Route::get('/products-list', 'productList')->name('products.list');
    Route::get('/products', 'index')->name('products');
    // Route::get('/products/details/{slug}', 'productDetail')->name('products.detail');
    Route::get('/search/products','searchProducts')->name('search.products');
    Route::get('/search/products/results/{query}', 'searchProductsResult')->name('search.products.result');
     Route::get('/search/products/results/{query}/{offset}', 'searchloadmore')->name('search.products.result.more');
    // Route::get('/categories', 'productCatogory')->name('products.category');
    Route::get('/categories/{slug}', 'productCatogoryWise')->name('products.category.wise');
    Route::get('/categories/{slug}/{subSlug}', 'productSubCatogoryWise')->name('products.sub.category.wise');
    Route::get('/product-category', 'productCategory')->name('products.category');
    Route::get('/sale', 'flashSale')->name('products.flash.sale');
    Route::get('/top-pick-for-you', 'topPickForYou')->name('products.top.pick.for.you');
    Route::get('/best-sellers', 'bestSellers')->name('products.best.sellers');
    Route::get('/top-deals', 'topDeals')->name('products.top.deals');
    Route::get('/product-for-you', 'productForYou')->name('products.for.you');
    Route::get('/sport-heathcare', 'sportHealthCare')->name('products.sport.healthcare');
    Route::get('/new-arrivals', 'newArrivals')->name('products.new.arrivals');
});
Route::get('/get-banners', [BannerController::class, 'getBanners'])->name('get.banners');
Route::get('/thanks', [NewPaymentController::class,'getdataforthankyou'])->name('thanks');
Route::get('/log-in', function () {
    return view('front.login');
})->name('login');
Route::get('/register', function () {
    return view('front.register');
})->name('register');
Route::get('/write-to-us', function () {
    return view('front.write-to-us');
})->name('write.to.us');
Route::post('/', function () {
    // Let the middleware handle the login logic
    return redirect('/');
});
Route::controller(BannerController::class)->group(function () {
    // Display a list of banners
    Route::get('/banners', 'index')->name('banners.index');
    Route::get('/banners/create', 'create')->name('banners.create');
    Route::post('/banners', 'bannerStore')->name('banners.store');
    Route::get('/banners/{id}/edit', 'edit')->name('banners.edit');
    Route::post('/banners/{id}', 'update')->name('banners.update');
    Route::get('/banners/{id}', 'destroy')->name('banners.destroy');
    Route::get('pincheck', 'pinCheck')->name('checkpin');
    Route::get('/get-city-state/{pincode}', 'getCityState')->name('get.city.state');
});

Route::controller(RaiseQueryController::class)->group(function () {
    Route::get('/raise-query', 'index')->name('raise.query');
    Route::post('/submit-query', 'store')->name('query.submit');
});

Route::controller(FAQController::class)->group(function () {
    Route::get('/faqs', 'fontIndex')->name('faqs');
});

Route::controller(BlogController::class)->group(function () {
    Route::get('/blogs', 'fontIndex')->name('blogs');
    Route::get('/blogs/details/{slug}', 'blogDetials')->name('blog.details');
    Route::get('/search-blog', 'blogSearch')->name('blog.search');
    Route::get('/search-blog-list/{query}', 'blogSearchResult')->name('blog.search.result');
});

Route::get('/customer/notification', [FrontCustomerController::class, 'Notification'])->name('customer.notification');
Route::middleware(['auth.customer'])->group(function () {
    Route::get('/profile', [FrontCustomerController::class, 'profile'])->name('customers.profile');
    Route::post('/profile/update', [FrontCustomerController::class, 'profileUpdate'])->name('customers.profile.update');
    Route::get('/profile/address', [FrontCustomerController::class, 'addAddress'])->name('customers.address.add');
    Route::post('/profile/logout', [FrontCustomerController::class, 'customerLogout'])->name('customer.logout');
    Route::get('/customer/order/{id}', [FrontCustomerController::class, 'OrderStatusWise'])->name('customer.orderStatusWise');
    Route::get('/customer/notification/delete/{id}', [FrontCustomerController::class, 'customerNotificationDestroy'])->name('customer.notifi.destroy');
    Route::post('/change-deliver-adress', [FrontCustomerController::class, 'changeDeliverAddress'])->name('change.deliver.address');
    Route::get('/edit-address/{id}', [FrontCustomerController::class, 'editAddress'])->name('edit.address');

});

Route::controller(FrontCustomerController::class)->group(function () {
    // Route::get('/customers/profile', 'profile')->name('customers.profile');
    Route::post('/save-get-in-touch', 'saveGetInTouch')->name('save.get.in.touch');
    Route::post('/customers/store', 'store')->name('customers.store');
    Route::post('/customers/login', 'login')->name('customer.login');
    Route::get('/customer/save-address', 'saveAddress')->name('save.address');
    // Route::get('/customer/resendotp', 'resendOtp')->name('customer.resendotp');
    Route::get('/customer/get-address/{id}', 'getAddress')->name('get.address');
    Route::get('/customer/get-update-address/{id}', 'getUpdateAddress')->name('get.update.address');
    Route::get('/customer/update-address', 'UpdateAddress')->name('customers.profile.address.update');
    Route::get('/customer/remove-address/{id}', 'removeAddress')->name('remove.address');
    Route::get('/customer/verify-otp/{number}', 'verifyOtp')->name('verify.otp');
    Route::get('/customer/location', 'saveLocation')->name('save.location');
    Route::get('/customer/remove-order-item/{id}', 'removeOrderItem')->name('remove.order.item');
    Route::get('/get-order-data/{id}', 'getOrderData')->name('order.getOrderData');
});
Route::middleware(['custom.throttle:4,60'])->group(function () {
     Route::get('/customer/resendotp', [FrontCustomerController::class, 'resendOtp'])->name('customer.resendotp');
});
Route::controller(FrontContactUsController::class)->group(function () {
    Route::get('/contact-us', 'frontIndex')->name('front.contact');
});

Route::controller(CartController2::class)->group(function () {
    Route::get('/cart', 'index')->name('cart');
    Route::post('/cart/add/{productId}', 'addToCart')->name('cart.add');
    Route::delete('/cart/delete-item/{cartItemId}', [CartController2::class, 'deleteItem'])->name('cart.delete-item');
    Route::post('/cart/update-quantity', [CartController2::class, 'updateCartItemQuantity'])->name('cart.update-quantity');
    Route::post('/cart/update-visibility', [CartController2::class, 'updateCartItemVisibility'])->name('cart.update-visibility');
    Route::post('/cart/applycoupon', [CartController2::class, 'applycoupon'])->name('applycoupon');
    Route::post('/cart/removecoupon}', [CartController2::class, 'removeCoupon'])->name('removecoupon');
    Route::get('/cart/getcoupon', [CartController2::class, 'getCoupons'])->name('getcoupons');
    Route::post('/cart/applycouponcode', [CartController2::class, 'applyCouponCode'])->name('applycouponcode');

});
// old cart routes
// Route::controller(CartController::class)->group(function () {
//     Route::get('/cart', 'index')->name('cart');
//     Route::post('/cart/add/{productId}', 'addToCart')->name('cart.add');
//     Route::delete('/cart/delete-item/{cartItemId}', [CartController::class, 'deleteItem'])->name('cart.delete-item');
//     Route::post('/cart/update-quantity', [CartController::class, 'updateCartItemQuantity'])->name('cart.update-quantity');
//     Route::post('/cart/update-visibility', [CartController::class, 'updateCartItemVisibility'])->name('cart.update-visibility');
//     Route::post('/cart/applycoupon', [CartController::class, 'applyCoupon'])->name('applycoupon');
//     Route::post('/cart/removecoupon}', [CartController::class, 'removeCoupon'])->name('removecoupon');
//     Route::get('/cart/getcoupon', 'getCoupons')->name('getcoupons');
//     Route::post('/cart/applycouponcode', 'applyCouponCode')->name('applycouponcode');

// });

//Front CMS Pages
Route::controller(FrontCmsController::class)->group(function () {
    Route::get('/about-us', 'AboutUs')->name('customer.about.us');
    Route::get('/terms-and-conditions', 'TermsAndConditions')->name('terms.and.conditions');
    Route::get('/privacy-policy', 'privacyPolicy')->name('privacy.policy');
});

// Route::get('razorpay-payment', [PaymentController::class, 'index']);
Route::post('razorpay-payment', [NewPaymentController::class, 'store'])->name('order.create');
Route::post('payment-success', [NewPaymentController::class, 'paymentSuccess'])->name('payment.success');
Route::post('create-order/{productId}', [NewPaymentController::class, 'createOrder']);
Route::post('verify-payment', [NewPaymentController::class, 'verifyPayment']);


//admin routes
Route::get('admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('admin/login', [AdminController::class, 'loginAction'])->name('admin.login.submit');


Route::get('/test-email', function () {
    Mail::raw('This is a test email from Laravel.', function ($message) {
        $message->to('kalbhoromkar8@gmail.com')
                ->subject('Test Email')
                ->from('pankajvajipara5191@gmail.com', 'Aarogyaa Bharat');
    });

    return 'Email sent!';
});
// Forgot Password Form (GET)
Route::get('/admin/forgot-password', [AdminController::class, 'showLinkRequestForm'])->name('admin.forgot.password');
Route::post('/admin/forgot-password', [AdminController::class, 'sendResetLinkEmail'])->name('admin.password.email');
Route::get('/admin/reset-password/{token}', [AdminController::class, 'showResetForm'])->name('admin.password.reset');
Route::post('/admin/reset-password', [AdminController::class, 'reset'])->name('admin.password.update');

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
         Route::get('/prize-check-and-update', function () {
            Artisan::call('app:prize-check-and-update');
            return 'Product prices updated successfully.';
        });
        // Authentication and Dashboard Routes
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        // Category Routes
        Route::controller(CategoryController::class)->group(function () {
            Route::get('/categories', 'index')->name('admin.categories');
            Route::get('/categories/create', 'create')->name('admin.categories.create');
            Route::post('/categories/store', 'store')->name('admin.categories.store');
            Route::get('/categories/edit/{id}', 'edit')->name('admin.categories.edit');
            Route::post('/categories/update/{id}', 'update')->name('admin.categories.update');
            Route::get('/categories/{id}', 'destroy')->name('admin.categories.destroy');
        });
        // Order Routes admin
        Route::controller(OrderController::class)->group(function () {
            Route::get('/orders', 'index')->name('admin.order.index');
            Route::get('/orders/edit/{id}', 'edit')->name('admin.order.edit');
            Route::get('/orders/{id}', 'show')->name('admin.order.show');
            Route::get('/orders/update-order-item-status/{id}/{status}', [OrderController::class, 'updateOrderItemStatus'])->name('admin.order.updateOrderItemStatus');
            Route::post('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('admin.order.updateStatus');
        });

        // Sub Category Routes
        Route::controller(SubCategory::class)->group(function () {
            Route::get('/sub-categories', 'index')->name('admin.sub.categories');
            Route::get('/sub-categories/create', 'create')->name('admin.sub.categories.create');
            Route::post('/sub-categories/store', 'store')->name('admin.sub.categories.store');
            Route::get('/sub-categories/edit/{id}', 'edit')->name('admin.sub.categories.edit');
            Route::post('/sub-categories/update/{id}', 'update')->name('admin.sub.categories.update');
            Route::get('/sub-categories/{id}', 'destroy')->name('admin.sub.categories.destroy');
            Route::get('/pincodes', 'pinIndex')->name('admin.pins');
            Route::get('/pincodes/import', 'import')->name('admin.pinOffices.importForm');
            Route::post('/admin/pin-offices/import','importStore')->name('admin.pinOffices.importstore');
        });
        Route::controller(BrandController::class)->group(function () {
            Route::get('/brand', 'index')->name('admin.brand');
            Route::get('/brand/create', 'create')->name('admin.brand.create');
            Route::post('/brand/store', 'store')->name('admin.brand.store');
            Route::get('/brand/edit/{id}', 'edit')->name('admin.brand.edit');
            Route::post('/brand/update/{id}', 'update')->name('admin.brand.update');
            Route::get('/brand/{id}', 'destroy')->name('admin.brand.destroy');
        });

        // Product Routes
        Route::controller(ProductController::class)->group(function () {
            Route::get('/products', 'index')->name('admin.products');
            Route::get('/products/create', 'create')->name('admin.products.create');
            Route::post('/products/store', 'store')->name('admin.products.store');
            Route::get('/products/edit/{id}', 'edit')->name('admin.products.edit');
            Route::post('/products/update/{id}', 'update')->name('admin.products.update');
            Route::get('/products/{id}', 'destroy')->name('admin.products.destroy');
            Route::get('import-product', 'importProduct')->name('products.import');
            Route::post('/products/import', 'import')->name('admin.products.importstore');
             Route::get('out-of-stock', 'outofstock')->name('products.outofstock');
        });
        // Product Attributes Routes
        Route::controller(ProductAttributeController::class)->group(function () {
            Route::get('/products-attribute', 'index')->name('admin.products.attribute');
            Route::get('/products-attribute/create', 'create')->name('admin.products.attribute.create');
            Route::post('/products-attribute/store', 'store')->name('admin.products.attribute.store');
            Route::get('/products-attribute/edit/{id}', 'edit')->name('admin.products.attribute.edit');
            Route::post('/products-attribute/update/{id}', 'update')->name('admin.products.attribute.update');
            Route::get('/products-attribute/{id}', 'destroy')->name('admin.products.attribute.destroy');
        });

        // Pages Routes
        Route::controller(PageController::class)->group(function () {
            Route::get('/page', 'index')->name('admin.pages');
            Route::get('/page/create', 'create')->name('admin.page.create');
            Route::post('/page/store', 'store')->name('admin.page.store');
            Route::get('/page/edit/{id}', 'edit')->name('admin.page.edit');
            Route::post('/page/update/{id}', 'update')->name('admin.page.update');
            Route::get('/page/{id}', 'destroy')->name('admin.page.destroy');
        });
        // Cms Routes
        Route::controller(CMSController::class)->group(function () {
            Route::get('/cms', 'index')->name('admin.cms');
            Route::get('/cms/create', 'create')->name('admin.cms.create');
            Route::post('/cms/store', 'store')->name('admin.cms.store');
            Route::get('/cms/edit/{id}', 'edit')->name('admin.cms.edit');
            Route::post('/cms/update/{id}', 'update')->name('admin.cms.update');
            Route::get('/cms/{id}', 'destroy')->name('admin.cms.destroy');
            Route::delete('admin/cms/image/{id}', [CmsController::class, 'destroyImage'])->name('admin.cms.image.destroy');
        });

        // Blogs Routes
        Route::controller(BlogController::class)->group(function () {
            Route::get('/blogs', 'index')->name('admin.blogs');
            Route::get('/blogs/create', 'create')->name('admin.blogs.create');
            Route::get('/blogs/create2', 'newcreate')->name('admin.blogs.create2');
            Route::post('/blogs/store2', 'newstore')->name('admin.blogs.store2');
            Route::post('/blogs/store', 'store')->name('admin.blogs.store');
            Route::get('/blogs/edit/{id}', 'edit')->name('admin.blogs.edit');
            Route::get('/blogs/edit2/{id}', 'newedit')->name('admin.blogs.edit2');
            Route::post('/blogs/update/{id}', 'update')->name('admin.blogs.update');
            Route::post('/blogs/update2/{id}', 'newupdate')->name('admin.blogs.update2');
            Route::get('/blogs/{id}', 'destroy')->name('admin.blogs.destroy');
        });

        // Customer Routes
        Route::controller(CustomerController::class)->group(function () {
            Route::get('/customers', 'index')->name('admin.customers');
            Route::get('/customers/create', 'create')->name('admin.customers.create');
            Route::post('/customers/store', 'store')->name('admin.customers.store');
            Route::get('/customers/edit/{id}', 'edit')->name('admin.customers.edit');
            Route::post('/customers/update/{id}', 'update')->name('admin.customers.update');
            Route::get('/customers/{id}', 'destroy')->name('admin.customers.destroy');
            Route::get('/customers/view/{id}', 'Show')->name('admin.customers.view');
        });

        // Customer Notification Routes
        Route::controller(CustomerNotification::class)->group(function () {
            Route::get('/notification', 'index')->name('admin.notification');
            Route::get('/notification/create', 'create')->name('admin.notification.create');
            Route::post('/notification/store', 'store')->name('admin.notification.store');
            Route::get('/notification/edit/{id}', 'edit')->name('admin.notification.edit');
            Route::post('/notification/update/{id}', 'update')->name('admin.notification.update');
            Route::get('/notification/{id}', 'destroy')->name('admin.notification.destroy');
            Route::get('/notification/view/{id}', 'Show')->name('admin.notification.view');
        });

        // Happy Customer Routes
        Route::controller(HappyCustomerController::class)->group(function () {
            Route::get('/happy-customers', 'index')->name('admin.happy.customers');
            Route::get('/happy-customers/create', 'create')->name('admin.happy.customers.create');
            Route::post('/happy-customers/store', 'store')->name('admin.happy.customers.store');
            Route::get('/happy-customers/edit/{id}', 'edit')->name('admin.happy.customers.edit');
            Route::post('/happy-customers/update/{id}', 'update')->name('admin.happy.customers.update');
            Route::get('/happy-customers/{id}', 'destroy')->name('admin.happy.customers.destroy');
        });


        // User Routes
        Route::controller(UserController::class)->group(function () {
            Route::get('/users', 'index')->name('admin.users');
            Route::get('/users/create', 'create')->name('admin.users.create');
            Route::post('/users/store', 'store')->name('admin.users.store');
            Route::get('/users/edit/{id}', 'edit')->name('admin.users.edit');
            Route::post('/users/update/{id}', 'update')->name('admin.users.update');
            Route::get('/users/{id}', 'destroy')->name('admin.users.destroy');
        });

        // Other Routes
        // Route::controller(BlogController::class)->group(function () {
        //     Route::get('/blogs', 'index')->name('admin.blogs');
        // });
         Route::controller(contactController::class)->group(function () {
            Route::get('/contact-us', 'index')->name('admin.contact');
            Route::get('/contact-us/show', 'index')->name('admin.contact.show');

         });
        Route::controller(ContactUsController::class)->group(function () {
            Route::get('/contactus', 'index')->name('admin.contactus');
            Route::get('/contactus/show/{id}', 'showDetails')->name('admin.contactus.show');
        });

        Route::controller(AboutUsController::class)->group(function () {
            Route::get('/aboutus', 'index')->name('admin.aboutus');
        });
        //FAQ Routes
        Route::controller(OfferAndDiscountOcntroller::class)->group(function () {
            Route::get('/offer', 'index')->name('admin.offer');
            Route::get('/offer/create', 'create')->name('admin.offer.create');
            Route::post('/offer/store', 'store')->name('admin.offer.store');
            Route::get('/offer/edit/{id}', 'edit')->name('admin.offer.edit');
            Route::post('/offer/update/{id}', 'update')->name('admin.offer.update');
            Route::get('/offer/{id}', 'destroy')->name('admin.offer.destroy');
        });
        //Offer Routes
        Route::controller(FAQController::class)->group(function () {
            Route::get('/faqs', 'index')->name('admin.faqs');
            Route::get('/faqs/create', 'create')->name('admin.faqs.create');
            Route::post('/faqs/store', 'store')->name('admin.faqs.store');
            Route::get('/faqs/edit/{id}', 'edit')->name('admin.faqs.edit');
            Route::post('/faqs/update/{id}', 'update')->name('admin.faqs.update');
            Route::get('/faqs/{id}', 'destroy')->name('admin.faqs.destroy');
        });

        Route::controller(StatusController::class)->group(function () {
            Route::get('/status', 'index')->name('admin.status');
            Route::get('/status/create', 'create')->name('admin.status.create');
        });

        // Logout Route
        Route::post('/logout', function () {
            Auth::logout();
            return redirect()->route('admin.login');
        })->name('admin.logout');
    });
});







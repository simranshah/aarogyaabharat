<?php

use App\Http\Controllers\Admin\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\FrontProductController;
use App\Http\Controllers\Front\FrontCmsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/product-info', [FrontProductController::class, 'getProductInfo']);
Route::get('/page-content', [FrontCmsController::class, 'getPageContent']);
Route::get('/check-pincode', [SubCategory::class, 'pinallApi']);


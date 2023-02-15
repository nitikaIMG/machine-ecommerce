<?php

use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\Customer\ShopController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Product\ProductCategoryController;
use App\Http\Controllers\Api\Product\ProductController;
use App\Http\Controllers\Api\StaticContentController;


Route::group([
    'prefix' => 'customer/shop'
], function() {
    Route::match(['get', 'post'], '', [ShopController::class, 'index']);

    Route::match(['get', 'post'], 'detail', [ShopController::class, 'detail']);
});

Route::group([
    'prefix' => 'customer/search'
], function() {
    Route::match(['get', 'post'], '', [ShopController::class, 'searchShop']);

   // Route::match(['get', 'post'], 'detail', [ShopController::class, 'detail']);
});

Route::group([
    'prefix' => 'products'
], function() {

    Route::match(['get', 'post'], 'category_listing', [ProductCategoryController::class, 'list']);

    Route::match(['get', 'post'], '', [ProductController::class, 'list']);

    Route::match(['get', 'post'], 'detail', [ProductController::class, 'detail']);
});

Route::match(['get', 'post'], 'content', [StaticContentController::class, 'view']);

Route::post('help_support_message', [StaticContentController::class, 'help_support_message']);

Route::match(['get', 'post'], 'settings', [AccountController::class, 'settings']);
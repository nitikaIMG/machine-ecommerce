<?php

use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\Customer\AddressController;
use App\Http\Controllers\Api\Customer\HomeController;
use App\Http\Controllers\Api\Customer\ShopController;
use App\Http\Controllers\Api\Customer\OrderController;
use App\Http\Controllers\Api\Product\ProductController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:api', 'role:customer']], function() {
    Route::get('home', [HomeController::class, 'index']);

    Route::group([
        'prefix' => 'shop'
    ], function() {
        Route::match(['get', 'post'], 'favourites', [ShopController::class, 'favourites']);

        Route::match(['get', 'post'], 'add_to_favourite', [ShopController::class, 'add_to_favourite']);
    });

    Route::group([
        'prefix' => 'products'
    ], function() {
        Route::match(['get', 'post'], 'favourites', [ProductController::class, 'favourites']);

        Route::match(['get', 'post'], 'add_to_favourite', [ProductController::class, 'add_to_favourite']);
    });

    Route::group([
        'prefix' => 'cart'
    ], function() {
        Route::match(['get', 'post'], '', [CartController::class, 'index']);

        Route::match(['get', 'post'], 'add_to_cart', [CartController::class, 'add_to_cart']);

        Route::match(['get', 'post'], 'remove_from_cart', [CartController::class, 'remove_from_cart']);
    });

    Route::group([
        'prefix' => 'address'
    ], function() {
        Route::match(['get', 'post'], '', [AddressController::class, 'index']);

        Route::match(['get', 'post'], 'create', [AddressController::class, 'store']);

        Route::match(['get', 'post'], 'update', [AddressController::class, 'update']);

        Route::match(['get', 'post'], 'view', [AddressController::class, 'show']);

        Route::match(['get', 'post'], 'delete', [AddressController::class, 'destroy']);
    });

    Route::group([
        'prefix' => 'order'
    ], function() {
        Route::match(['get', 'post'], 'orders', [OrderController::class, 'orders']);

        Route::match(['get', 'post'], 'order_detail', [OrderController::class, 'order_detail']);

        Route::match(['get', 'post'], 'verify_quotation', [OrderController::class, 'verify_quotation']);

        Route::match(['get', 'post'], 'submit_quotation', [OrderController::class, 'submit_quotation']);

        Route::match(['get', 'post'], 'quotations', [OrderController::class, 'quotations']);

        Route::match(['get', 'post'], 'quotation_detail', [OrderController::class, 'quotation_detail']);

        Route::match(['get', 'post'], 'place_bid', [OrderController::class, 'place_bid']);
    });
   Route::post('rating',[ShopController::class,'rate'])->name('shop.rating');
   Route::get('notifications',[HomeController::class,'notifications'])->name('notifications');
   Route::get('notifications-read',[HomeController::class,'notificationRead'])->name('notifications.read');
   Route::get('get-message-count',[HomeController::class,'getMessageCount'])->name('getMessageCount');
});
<?php

use App\Http\Controllers\Api\Seller\OrderController;
use App\Http\Controllers\Api\Seller\ProductController;
use App\Http\Controllers\Api\Seller\ShopController;
use App\Http\Controllers\Api\Seller\HomeController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:api', 'role:seller']], function() {

    Route::group([
        'prefix' => 'order'
    ], function() {
        Route::match(['get', 'post'], '', [OrderController::class, 'orders']);

        Route::match(['get', 'post'], 'order_detail', [OrderController::class, 'order_detail']);

        Route::match(['get', 'post'], 'quotations', [OrderController::class, 'quotations']);

        Route::match(['get', 'post'], 'quotation_detail', [OrderController::class, 'quotation_detail']);

        Route::match(['get', 'post'], 'accept_reject_bid', [OrderController::class, 'accept_reject_bid']);

        Route::match(['get', 'post'], 'update_order_status', [OrderController::class, 'update_order_status']);

        Route::match(['get', 'post'],'accept_reject_quotation', [OrderController::class, 'accept_reject_quotation']);
    });

    Route::group([
        'prefix' => 'shop'
    ], function() {
        Route::match(['get', 'post'], '', [ShopController::class, 'index']);
        Route::match(['get', 'post'], 'show', [ShopController::class, 'show']);
        Route::post('store', [ShopController::class, 'store']);
        Route::post('update', [ShopController::class, 'update']);
    });

    // Route::apiResource('shop', ShopController::class);

    Route::match(['get', 'post'], 'product', [ProductController::class, 'index']);
    Route::match(['get', 'post'], 'product/my', [ProductController::class, 'my_products']);
    Route::match(['get', 'post'], 'categories', [ProductController::class, 'categories']);
    Route::post('product/update', [ProductController::class, 'update']);
    Route::post('product/delete', [ProductController::class, 'destroy']);

    Route::post('product/softdelete', [ProductController::class, 'softdelete']);
    Route::get('notifications',[HomeController::class,'notifications'])->name('notifications');
    Route::get('notifications-read',[HomeController::class,'notificationRead'])->name('notifications.read');
    Route::get('get-message-order-count',[HomeController::class,'getMessageOrOrderCount'])->name('getMessageOrOrderCount');
});
<?php

use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ChatApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [AuthController::class, 'login']);
Route::post('login_via_otp', [AuthController::class, 'send_otp_for_login']);
Route::post('login_via_otp/verify', [AuthController::class, 'verify_otp_and_login']);
Route::post('forgot_password', [AuthController::class, 'forgot_password']);

Route::group([
    'middleware' => 'auth:api'
], function() {
    Route::post('logout', [AuthController::class, 'logout']);

    Route::get('me', [AccountController::class, 'me']);
    Route::post('update_account', [AccountController::class, 'update_account']);
});

# Chat Routes
Route::group([
    'prefix' => 'chat',
    'middleware' => 'auth:api'
], function(){
    Route::get('/', [ChatApiController::class, 'index']);
    Route::get('/view_channel/{channel}', [ChatApiController::class, 'viewChannel']);
    Route::post('/create_channel', [ChatApiController::class, 'createChannel']);
    Route::post('messages/{channel}', [ChatApiController::class, 'sendMessage']);
});

// common apis
Route::group([], base_path('routes/api/common.php'));

Route::group([
    'prefix' => 'customer',
    'as' => 'customer.'
], base_path('routes/api/customer.php'));

Route::group([
    'prefix' => 'seller',
    'as' => 'seller.'
], base_path('routes/api/seller.php'));
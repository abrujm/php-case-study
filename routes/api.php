<?php

use App\Http\Controllers\CouponController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationController;
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


//Auth operations
Route::post('register', [RegistrationController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);
Route::middleware('auth:api')->get('user', function (Request $request) {
    return $request->user();
});

//Events
Route::prefix('event')->group(function () {
    Route::get('all', [EventController::class, 'eventList']);
    Route::get('active', [EventController::class, 'activeEventList']);
});

//Coupons
Route::prefix('coupon')->group(function () {
    Route::middleware('auth:api')
      ->post('add', [CouponController::class, 'addCoupon']);
    Route::get('all', [CouponController::class, 'getAllCoupons']);
    Route::get('active', [CouponController::class, 'getActiveCoupons']);
    Route::middleware('auth:api')
      ->post('activate', [CouponController::class, 'activateCoupon']);
    Route::middleware('auth:api')
      ->post('deactivate', [CouponController::class, 'deactivateCoupon']);
    Route::middleware('auth:api')
      ->post('apply', [CouponController::class, 'applyCoupon']);
});

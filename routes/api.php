<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Middleware\CheckApiToken;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix' => 'v1','namespace'=>'Api'], function () {
    Route::get('/setting', 'SettingController@index');

    Route::group(['prefix' => '/user'], function () {
        Route::post('/verify_mobile', 'UserController@verify_mobile');
        Route::post('/', 'UserController@register');
        Route::get('/profile', 'UserController@profile')->middleware(CheckApiToken::class);
        Route::put('/{user}', 'UserController@update')->middleware(CheckApiToken::class);
        Route::put('/{user}/update_token', 'UserController@update_token')->middleware(CheckApiToken::class);
        Route::post('/login', 'UserController@login');
        Route::get('/logout', 'UserController@logout')->middleware(CheckApiToken::class);
    });

    Route::group(['prefix' => '/child'], function () {
        Route::get('/school_type', 'ChildController@school_type')->middleware(CheckApiToken::class);
        Route::get('school_type/{id}/grade', 'ChildController@grades')->middleware(CheckApiToken::class);
        Route::get('school_type/{id}/school', 'ChildController@schools')->middleware(CheckApiToken::class);
        Route::post('/', 'ChildController@store')->middleware(CheckApiToken::class);
        Route::get('/', 'ChildController@index')->middleware(CheckApiToken::class);
        Route::get('/{id}', 'ChildController@show')->middleware(CheckApiToken::class);
        Route::delete('/{id}', 'ChildController@destroy')->middleware(CheckApiToken::class);
    });

    Route::group(['prefix' => '/package'], function () {
        Route::get('/', 'PackageController@index')->middleware(CheckApiToken::class);
        Route::get('/{id}', 'PackageController@show')->middleware(CheckApiToken::class);
    });

    Route::group(['prefix' => '/notification'], function () {
        Route::get('/', 'NotificationController@index')->middleware(CheckApiToken::class);
        Route::get('/{id}', 'NotificationController@show')->middleware(CheckApiToken::class);
    });

    Route::group(['prefix' => '/contact'], function () {
        Route::post('/', 'ContactController@store');
    });

    Route::group(['prefix' => '/subscribe'], function () {
        Route::get('/break', 'SubscribeController@break_list')->middleware(CheckApiToken::class);
        Route::get('/price', 'SubscribeController@subscribe_data')->middleware(CheckApiToken::class);
        Route::post('/check_promo_code', 'SubscribeController@check_promo_code')->middleware(CheckApiToken::class);
        Route::post('/', 'SubscribeController@store')->middleware(CheckApiToken::class);
        Route::get('/{child_id}', 'SubscribeController@subscribe_details')->middleware(CheckApiToken::class);
        Route::put('/{child_id}', 'SubscribeController@subscribe_promo_code')->middleware(CheckApiToken::class);
    });

});

<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::prefix('/admin')->name('admin.')->namespace('Admin')->group(function(){
    Route::namespace('Auth')->group(function(){
        Route::get('/login','LoginController@showLoginForm')->name('login');
        Route::post('/login','LoginController@login')->name('login.submit');
        Route::post('/logout','LoginController@logout')->name('logout');
        Route::get('/password/reset','ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('/password/email','ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::get('/password/reset/{token}','ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('/password/reset','ResetPasswordController@reset')->name('password.update');
    });
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/setting', 'HomeController@setting')->name('setting');
    Route::post('/setting', 'HomeController@update_setting')->name('setting.update');

    Route::get('/admin/{id}', 'AdminController@show')->name('profile');
    Route::post('/admin/{id}', 'AdminController@update')->name('update');
    Route::get('admin/activate/{id}', 'AdminController@activate')->name('admin.activate');

    Route::post('user/{id}', 'UserController@update')->name('user.update');
    Route::resource('user', 'UserController');
    Route::get('user/activate/{id}', 'UserController@activate')->name('user.activate');

    Route::post('package/{id}', 'PackageController@update')->name('package.update');
    Route::resource('package', 'PackageController');
    Route::get('package/activate/{id}', 'PackageController@activate')->name('package.activate');

    Route::post('SchoolGrade/{id}', 'SchoolGradeController@update')->name('SchoolGrade.update');
    Route::resource('SchoolGrade', 'SchoolGradeController');
    Route::get('drop_down/activate/{id}', 'SchoolGradeController@activate')->name('drop_down.activate');

    Route::post('School/{id}', 'SchoolController@update')->name('School.update');
    Route::resource('School', 'SchoolController');

    Route::post('Break/{id}', 'BreakController@update')->name('Break.update');
    Route::resource('Break', 'BreakController');

    Route::resource('subscribe', 'SubscribeController');
    Route::resource('child', 'ChildController');



});
Auth::routes();
Route::get('/', 'HomeController@index')->name('home');

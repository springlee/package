<?php

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

Route::middleware(['setLocale'])->group(function () {
    Auth::routes(['verify' => true]);
});


Route::get('/changeLocale/{locale}', 'IndexController@changeLocale');

Route::middleware(['setLocale','auth','verified'])->group(function () {
    Route::get('/', 'IndexController@index');  //首页
    Route::get('index/main', 'IndexController@main')->name('index.main');

    Route::get('user/password/reset', 'UserController@resetPasswordForm')->name('user.password.reset');

    Route::post('user/password/reset', 'UserController@resetPassword')->name('user.password.update');

});

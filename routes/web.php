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

Route::middleware(['setLocale'])->group(function () {
    Route::get('users/forbidden', 'UserController@forbidden')->name('_users.forbidden');


    Route::middleware(['auth','userEnable','verified'])->group(function () {
        Route::get('/', 'IndexController@index');  //首页
        Route::get('index/main', 'IndexController@main')->name('index.main');
        Route::get('user/password/reset', 'UserController@resetPasswordForm')->name('_users.password.reset');
        Route::post('user/password/reset', 'UserController@resetPassword')->name('_users.password.update');
        Route::get('users', 'UserController@index')->name('_users.index');
        Route::post('users/list', 'UserController@list')->name('_users.list');
        Route::get('users/create', 'UserController@create')->name('_users.create');
        Route::post('users/store', 'UserController@store')->name('_users.store');
        Route::get('users/edit/{user?}', 'UserController@edit')->name('_users.edit');
        Route::post('users/update/{user}', 'UserController@update')->name('_users.update');
        Route::post('users/active/{user?}', 'UserController@active')->name('_users.active');

        Route::get('logistics_companies', 'LogisticsCompanyController@index')->name('logistics_companies.index');
        Route::post('logistics_companies/list', 'LogisticsCompanyController@list')->name('logistics_companies.list');
        Route::get('logistics_companies/create', 'LogisticsCompanyController@create')->name('logistics_companies.create');
        Route::post('logistics_companies/store', 'LogisticsCompanyController@store')->name('logistics_companies.store');
        Route::get('logistics_companies/edit/{logistics_company?}', 'LogisticsCompanyController@edit')->name('logistics_companies.edit');
        Route::post('logistics_companies/update/{logistics_company}', 'LogisticsCompanyController@update')->name('logistics_companies.update');
        Route::post('logistics_companies/active/{logistics_company?}', 'LogisticsCompanyController@active')->name('logistics_companies.active');
    });

});

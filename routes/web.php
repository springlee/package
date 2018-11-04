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

Route::get('/test', 'IndexController@test');

Route::middleware(['setLocale'])->group(function () {
    Route::get('users/forbidden', 'UserController@forbidden')->name('_users.forbidden');
    Route::middleware(['auth', 'userEnable', 'verified'])->group(function () {
        Route::get('/', 'IndexController@index');  //首页
        Route::get('index/main', 'IndexController@main')->name('index.main');
        Route::get('user/password/reset', 'UserController@resetPasswordForm')->name('_users.password.reset');
        Route::post('user/password/reset', 'UserController@resetPassword')->name('_users.password.update');


        Route::middleware(['permission:package_info_input|package_receive|report'])->group(function () {
            Route::get('packages/logistics/{package?}', 'PackageController@logistics')->name('package.logistics');
            Route::post('packages/download', 'PackageController@download')->name('package.download');
            Route::get('packages/merchandiser/{package?}', 'PackageController@merchandiserEdit')->name('package.merchandiser.edit');
            Route::post('packages/merchandiser/{package}', 'PackageController@merchandiserUpdate')->name('package.merchandiser.update');
        });


        //包裹的增改
        Route::middleware(['permission:package_info_input'])->group(function () {
            Route::get('packages/merchandiser_index', 'PackageController@merchandiserIndex')->name('package.merchandiser.index');
            Route::post('packages/merchandiser_list', 'PackageController@merchandiserList')->name('package.merchandiser.list');
            Route::get('packages/merchandiser_create', 'PackageController@merchandiserCreate')->name('package.merchandiser.create');
            Route::post('packages/merchandiser_store', 'PackageController@merchandiserStore')->name('package.merchandiser.store');
            Route::get('packages/merchandiser_import', 'PackageController@merchandiserImport')->name('package.merchandiser.import');
            Route::post('packages/merchandiser_import_save', 'PackageController@merchandiserImportSave')->name('package.merchandiser.import.save');
        });

        //签收
        Route::middleware(['permission:package_receive'])->group(function () {
            Route::get('packages/warehouseman_index', 'PackageController@warehousemanIndex')->name('package.warehouseman.index');
            Route::post('packages/warehouseman_list', 'PackageController@warehousemanList')->name('package.warehouseman.list');
            Route::get('packages/warehouseman_import', 'PackageController@warehousemanImport')->name('package.warehouseman.import');
            Route::post('packages/warehouseman_import_save', 'PackageController@warehousemanImportSave')->name('package.warehouseman.import.save');
            Route::get('packages/warehouseman_receive/{package?}', 'PackageController@warehousemanReceive')->name('package.warehouseman.receive');
            Route::post('packages/warehouseman_receive_save/{package}/', 'PackageController@warehousemanReceiveSave')->name('package.warehouseman.receive.save');
        });

        //确认
        Route::middleware(['permission:report'])->group(function () {
            Route::get('packages/report', 'PackageController@reportIndex')->name('package.report.index');
            Route::post('packages/report_list', 'PackageController@reportList')->name('package.report.list');
        });





        Route::middleware(['role:Admin'])->group(function () {
            Route::get('users', 'UserController@index')->name('_users.index');
            Route::post('users/list', 'UserController@list')->name('_users.list');
            Route::get('users/create', 'UserController@create')->name('_users.create');
            Route::post('users/store', 'UserController@store')->name('_users.store');
            Route::get('users/edit/{user?}', 'UserController@edit')->name('_users.edit');
            Route::post('users/update/{user}', 'UserController@update')->name('_users.update');
            Route::post('users/active/{user?}', 'UserController@active')->name('_users.active');
        });

        Route::middleware(['role:Package Manger|Admin'])->group(function () {
            Route::get('logistics_companies', 'LogisticsCompanyController@index')->name('logistics_companies.index');
            Route::post('logistics_companies/list',
                'LogisticsCompanyController@list')->name('logistics_companies.list');
            Route::get('logistics_companies/create',
                'LogisticsCompanyController@create')->name('logistics_companies.create');
            Route::post('logistics_companies/store',
                'LogisticsCompanyController@store')->name('logistics_companies.store');
            Route::get('logistics_companies/edit/{logistics_company?}',
                'LogisticsCompanyController@edit')->name('logistics_companies.edit');
            Route::post('logistics_companies/update/{logistics_company}',
                'LogisticsCompanyController@update')->name('logistics_companies.update');
            Route::post('logistics_companies/active/{logistics_company?}',
                'LogisticsCompanyController@active')->name('logistics_companies.active');
        });

    });
});

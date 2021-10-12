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

Auth::routes();

Route::get('verify/{token}', '\App\Http\Controllers\Auth\RegisterController@verify')->name('account.verify');

Route::get('/rebuild', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    if (isset($_SERVER['HTTP_HOST'])) {
        $root = (isset($_SERVER['HTTPS']) ? "https://" : "http://") . $_SERVER['HTTP_HOST'];
        $root .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
        return "<script> window.location.href = '" . $root . "'; </script>";
    }
})->name('app.rebuild');

Route::group(['middleware' => ['SessionTimeout', 'XSS', 'auth']], function ($router) {

    Route::get('/', function () {
        $user = \Auth::user();
        if ($user->can("view_dashboards")) {
            return redirect()->route('dashboards.index');
        } else {
            return redirect()->route('profiles.index');
        }
    })->name("home");

    Route::get('/home', function () {
        return redirect()->route('home');
    });

    Route::resource('dashboards', '\App\Http\Controllers\Main\DashboardController');
    Route::resource('profiles', '\App\Http\Controllers\Main\ProfileController');

    Route::group(['prefix' => 'product'], function () {
        Route::resource('brands', '\App\Http\Controllers\Main\Product\BrandController');
        Route::resource('groups', '\App\Http\Controllers\Main\Product\GroupController');
        Route::resource('categories', '\App\Http\Controllers\Main\Product\CategoryController');
        Route::resource('items', '\App\Http\Controllers\Main\Product\ItemController');
        Route::resource('product_images', '\App\Http\Controllers\Main\Product\ProductImageController');
    });

    Route::group(['prefix' => 'reference'], function () {
        Route::resource('banks', '\App\Http\Controllers\Main\Reference\BankController');
        Route::resource('customers', '\App\Http\Controllers\Main\Reference\CustomerController');
        Route::resource('stakeholders', '\App\Http\Controllers\Main\Reference\StakeHolderController');
        Route::resource('suppliers', '\App\Http\Controllers\Main\Reference\SupplierController');
    });

    Route::group(['prefix' => 'transaction'], function () {
        Route::resource('transaction_sales', '\App\Http\Controllers\Main\Transaction\SaleController');
        Route::resource('transaction_purchases', '\App\Http\Controllers\Main\Transaction\PurchaseController');
        Route::resource('transaction_fees', '\App\Http\Controllers\Main\Transaction\FeeController');
        Route::get('invoice/{id}/{collections}', '\App\Http\Controllers\Main\Transaction\InvoiceController@preview')->name("invoice.preview");
        Route::get('invoice_loader', '\App\Http\Controllers\Main\Transaction\InvoiceController@previewLoader')->name("invoice.loader");
    });

    Route::resource('reports', '\App\Http\Controllers\Main\ReportController');

    Route::group(['prefix' => 'setting'], function () {
        Route::resource('settings', '\App\Http\Controllers\Main\Setting\SettingController');
        Route::resource('audits', '\App\Http\Controllers\Main\Setting\AuditController');
        Route::resource('users', '\App\Http\Controllers\Main\Setting\UserController');
        Route::resource('roles', '\App\Http\Controllers\Main\Setting\RoleController');
    });


});

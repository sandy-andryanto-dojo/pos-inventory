<?php

use Illuminate\Http\Request;

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

Route::group(['middleware' => ['api', 'XSS'], 'prefix' => 'auth'], function ($router) {
    Route::post('login', '\App\Http\Controllers\Api\AuthController@login');
    Route::post('logout', '\App\Http\Controllers\Api\AuthController@logout');
    Route::post('refresh', '\App\Http\Controllers\Api\AuthController@refresh');
    Route::post('me', '\App\Http\Controllers\Api\AuthController@me');
});

Route::group(['middleware' => ['jwt.auth', 'XSS']], function() {
    Route::post('skin/change', '\App\Http\Controllers\Api\SettingController@changeSkin');
    Route::post('product/get', '\App\Http\Controllers\Api\ProductController@getProduct');
    Route::post('datatable/get/{model}', '\App\Http\Controllers\Api\DataTableController@getDataTable');
    Route::post('datatable/transaction/{type}', '\App\Http\Controllers\Api\DataTableController@getTransactionDataTable');
    Route::post('datatable/delete', '\App\Http\Controllers\Api\DataTableController@removeDataTable');
    Route::group(['prefix' => 'upload'], function () {
        Route::post('user/profile', '\App\Http\Controllers\Api\UploadController@userProfile')->name("upload.user.profile");
    });
    Route::group(['prefix' => 'dashboard'], function () {
        Route::post('summary', '\App\Http\Controllers\Api\DashboardController@summary');
    });
   
});
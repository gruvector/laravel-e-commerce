<?php

use Illuminate\Support\Facades\Route;

Route::get('flash-sales', [
    'as' => 'admin.flash_sales.index',
    'uses' => 'FlashSaleController@index',
    'middleware' => 'can:admin.flash_sales.index',
]);

Route::get('flash-sales/create', [
    'as' => 'admin.flash_sales.create',
    'uses' => 'FlashSaleController@create',
    'middleware' => 'can:admin.flash_sales.create',
]);

Route::post('flash-sales', [
    'as' => 'admin.flash_sales.store',
    'uses' => 'FlashSaleController@store',
    'middleware' => 'can:admin.flash_sales.create',
]);

Route::get('flash-sales/{id}/edit', [
    'as' => 'admin.flash_sales.edit',
    'uses' => 'FlashSaleController@edit',
    'middleware' => 'can:admin.flash_sales.edit',
]);

Route::put('flash-sales/{id}', [
    'as' => 'admin.flash_sales.update',
    'uses' => 'FlashSaleController@update',
    'middleware' => 'can:admin.flash_sales.edit',
]);

Route::delete('flash-sales/{ids?}', [
    'as' => 'admin.flash_sales.destroy',
    'uses' => 'FlashSaleController@destroy',
    'middleware' => 'can:admin.flash_sales.destroy',
]);

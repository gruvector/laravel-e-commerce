<?php

use Illuminate\Support\Facades\Route;

Route::get('brands', [
    'as' => 'admin.brands.index',
    'uses' => 'BrandController@index',
    'middleware' => 'can:admin.brands.index',
]);

Route::get('brands/create', [
    'as' => 'admin.brands.create',
    'uses' => 'BrandController@create',
    'middleware' => 'can:admin.brands.create',
]);

Route::post('brands', [
    'as' => 'admin.brands.store',
    'uses' => 'BrandController@store',
    'middleware' => 'can:admin.brands.create',
]);

Route::get('brands/{id}/edit', [
    'as' => 'admin.brands.edit',
    'uses' => 'BrandController@edit',
    'middleware' => 'can:admin.brands.edit',
]);

Route::put('brands/{id}', [
    'as' => 'admin.brands.update',
    'uses' => 'BrandController@update',
    'middleware' => 'can:admin.brands.edit',
]);

Route::delete('brands/{ids?}', [
    'as' => 'admin.brands.destroy',
    'uses' => 'BrandController@destroy',
    'middleware' => 'can:admin.brands.destroy',
]);

// append

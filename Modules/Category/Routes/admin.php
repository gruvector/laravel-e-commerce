<?php

use Illuminate\Support\Facades\Route;

Route::get('categories/tree', [
    'as' => 'admin.categories.tree',
    'uses' => 'CategoryTreeController@index',
    'middleware' => 'can:admin.categories.index',
]);

Route::put('categories/tree', [
    'as' => 'admin.categories.tree.update',
    'uses' => 'CategoryTreeController@update',
    'middleware' => 'can:admin.categories.edit',
]);

Route::get('categories', [
    'as' => 'admin.categories.index',
    'uses' => 'CategoryController@index',
    'middleware' => 'can:admin.categories.index',
]);

Route::post('categories', [
    'as' => 'admin.categories.store',
    'uses' => 'CategoryController@store',
    'middleware' => 'can:admin.categories.create',
]);

Route::get('categories/{id}', [
    'as' => 'admin.categories.show',
    'uses' => 'CategoryController@show',
    'middleware' => 'can:admin.categories.edit',
]);

Route::put('categories/{id}', [
    'as' => 'admin.categories.update',
    'uses' => 'CategoryController@update',
    'middleware' => 'can:admin.categories.edit',
]);

Route::delete('categories/{id}', [
    'as' => 'admin.categories.destroy',
    'uses' => 'CategoryController@destroy',
    'middleware' => 'can:admin.categories.destroy',
]);

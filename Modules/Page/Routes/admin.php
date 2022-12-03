<?php

use Illuminate\Support\Facades\Route;

Route::get('pages', [
    'as' => 'admin.pages.index',
    'uses' => 'PageController@index',
    'middleware' => 'can:admin.pages.index',
]);

Route::get('pages/create', [
    'as' => 'admin.pages.create',
    'uses' => 'PageController@create',
    'middleware' => 'can:admin.pages.create',
]);

Route::post('pages', [
    'as' => 'admin.pages.store',
    'uses' => 'PageController@store',
    'middleware' => 'can:admin.pages.create',
]);

Route::get('pages/{id}/edit', [
    'as' => 'admin.pages.edit',
    'uses' => 'PageController@edit',
    'middleware' => 'can:admin.pages.edit',
]);

Route::put('pages/{id}/edit', [
    'as' => 'admin.pages.update',
    'uses' => 'PageController@update',
    'middleware' => 'can:admin.pages.edit',
]);

Route::delete('pages/{ids?}', [
    'as' => 'admin.pages.destroy',
    'uses' => 'PageController@destroy',
    'middleware' => 'can:admin.pages.destroy',
]);

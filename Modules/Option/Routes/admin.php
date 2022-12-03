<?php

use Illuminate\Support\Facades\Route;

Route::get('options', [
    'as' => 'admin.options.index',
    'uses' => 'OptionController@index',
    'middleware' => 'can:admin.options.index',
]);

Route::get('options/create', [
    'as' => 'admin.options.create',
    'uses' => 'OptionController@create',
    'middleware' => 'can:admin.options.create',
]);

Route::post('options', [
    'as' => 'admin.options.store',
    'uses' => 'OptionController@store',
    'middleware' => 'can:admin.options.create',
]);

Route::get('options/{id}', [
    'as' => 'admin.options.show',
    'uses' => 'OptionController@show',
    'middleware' => 'can:admin.options.edit',
]);

Route::get('options/{id}/edit', [
    'as' => 'admin.options.edit',
    'uses' => 'OptionController@edit',
    'middleware' => 'can:admin.options.edit',
]);

Route::put('options/{id}', [
    'as' => 'admin.options.update',
    'uses' => 'OptionController@update',
    'middleware' => 'can:admin.options.edit',
]);

Route::delete('options/{ids}', [
    'as' => 'admin.options.destroy',
    'uses' => 'OptionController@destroy',
    'middleware' => 'can:admin.options.destroy',
]);

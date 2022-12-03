<?php

use Illuminate\Support\Facades\Route;

Route::get('tags', [
    'as' => 'admin.tags.index',
    'uses' => 'TagController@index',
    'middleware' => 'can:admin.tags.index',
]);

Route::get('tags/create', [
    'as' => 'admin.tags.create',
    'uses' => 'TagController@create',
    'middleware' => 'can:admin.tags.create',
]);

Route::post('tags', [
    'as' => 'admin.tags.store',
    'uses' => 'TagController@store',
    'middleware' => 'can:admin.tags.create',
]);

Route::get('tags/{id}/edit', [
    'as' => 'admin.tags.edit',
    'uses' => 'TagController@edit',
    'middleware' => 'can:admin.tags.edit',
]);

Route::put('tags/{id}', [
    'as' => 'admin.tags.update',
    'uses' => 'TagController@update',
    'middleware' => 'can:admin.tags.edit',
]);

Route::delete('tags/{ids?}', [
    'as' => 'admin.tags.destroy',
    'uses' => 'TagController@destroy',
    'middleware' => 'can:admin.tags.destroy',
]);

// append


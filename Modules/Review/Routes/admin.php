<?php

use Illuminate\Support\Facades\Route;

Route::get('reviews', [
    'as' => 'admin.reviews.index',
    'uses' => 'ReviewController@index',
    'middleware' => 'can:admin.reviews.index',
]);

Route::get('reviews/{id}/edit', [
    'as' => 'admin.reviews.edit',
    'uses' => 'ReviewController@edit',
    'middleware' => 'can:admin.reviews.edit',
]);

Route::put('reviews/{id}', [
    'as' => 'admin.reviews.update',
    'uses' => 'ReviewController@update',
    'middleware' => 'can:admin.reviews.edit',
]);

Route::delete('reviews/{ids?}', [
    'as' => 'admin.reviews.destroy',
    'uses' => 'ReviewController@destroy',
    'middleware' => 'can:admin.reviews.destroy',
]);

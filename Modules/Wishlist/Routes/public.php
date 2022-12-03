<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::post('wishlist', 'WishlistController@store')->name('wishlist.store');
    Route::delete('wishlist/{productId}', 'WishlistController@destroy')->name('wishlist.destroy');

    Route::get('wishlist/products', 'WishlistProductController@index')->name('wishlist.products.index');
});

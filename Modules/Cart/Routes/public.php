<?php

use Illuminate\Support\Facades\Route;

Route::get('cart', 'CartController@index')->name('cart.index');

Route::post('cart/items', 'CartItemController@store')->name('cart.items.store');
Route::put('cart/items/{cartItemId}', 'CartItemController@update')->name('cart.items.update');
Route::delete('cart/items/{cartItemId}', 'CartItemController@destroy')->name('cart.items.destroy');

Route::post('cart/clear', 'CartClearController@store')->name('cart.clear.store');

Route::post('cart/shipping-method', 'CartShippingMethodController@store')->name('cart.shipping_method.store');

Route::get('cart/cross-sell-products', 'CartCrossSellProductsController@index')->name('cart.cross_sell_products.index');

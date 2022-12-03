<?php

use Illuminate\Support\Facades\Route;

Route::post('cart/taxes', 'CartTaxController@store')->name('cart.taxes.store');

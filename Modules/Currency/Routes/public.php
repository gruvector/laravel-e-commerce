<?php

use Illuminate\Support\Facades\Route;

Route::get('current-currency/{code}', 'CurrentCurrencyController@store')->name('current_currency.store');

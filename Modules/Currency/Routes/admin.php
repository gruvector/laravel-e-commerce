<?php

use Illuminate\Support\Facades\Route;

Route::get('currency-rates', [
    'as' => 'admin.currency_rates.index',
    'uses' => 'CurrencyRateController@index',
    'middleware' => 'can:admin.currency_rates.index',
]);

Route::get('currency-rates/{id}/edit', [
    'as' => 'admin.currency_rates.edit',
    'uses' => 'CurrencyRateController@edit',
    'middleware' => 'can:admin.currency_rates.edit',
]);

Route::put('currency-rates/{id}', [
    'as' => 'admin.currency_rates.update',
    'uses' => 'CurrencyRateController@update',
    'middleware' => 'can:admin.currency_rates.edit',
]);

Route::get('currency-rates/refresh', [
    'as' => 'admin.currency_rates.refresh',
    'uses' => 'CurrencyRateController@refresh',
    'middleware' => 'can:admin.currency_rates.edit',
]);

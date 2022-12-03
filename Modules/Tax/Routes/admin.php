<?php

use Illuminate\Support\Facades\Route;

Route::get('taxes', [
    'as' => 'admin.taxes.index',
    'uses' => 'TaxController@index',
    'middleware' => 'can:admin.taxes.index',
]);

Route::get('taxes/create', [
    'as' => 'admin.taxes.create',
    'uses' => 'TaxController@create',
    'middleware' => 'can:admin.taxes.create',
]);

Route::post('taxes', [
    'as' => 'admin.taxes.store',
    'uses' => 'TaxController@store',
    'middleware' => 'can:admin.taxes.create',
]);

Route::get('taxes/{id}/edit', [
    'as' => 'admin.taxes.edit',
    'uses' => 'TaxController@edit',
    'middleware' => 'can:admin.taxes.edit',
]);

Route::put('taxes/{id}', [
    'as' => 'admin.taxes.update',
    'uses' => 'TaxController@update',
    'middleware' => 'can:admin.taxes.edit',
]);

Route::delete('taxes/{ids?}', [
    'as' => 'admin.taxes.destroy',
    'uses' => 'TaxController@destroy',
    'middleware' => 'can:admin.taxes.destroy',
]);

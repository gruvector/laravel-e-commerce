<?php

use Illuminate\Support\Facades\Route;

Route::get('coupons', [
    'as' => 'admin.coupons.index',
    'uses' => 'CouponController@index',
    'middleware' => 'can:admin.coupons.index',
]);

Route::get('coupons/create', [
    'as' => 'admin.coupons.create',
    'uses' => 'CouponController@create',
    'middleware' => 'can:admin.coupons.create',
]);

Route::post('coupons', [
    'as' => 'admin.coupons.store',
    'uses' => 'CouponController@store',
    'middleware' => 'can:admin.coupons.create',
]);

Route::get('coupons/{id}/edit', [
    'as' => 'admin.coupons.edit',
    'uses' => 'CouponController@edit',
    'middleware' => 'can:admin.coupons.edit',
]);

Route::put('coupons/{id}', [
    'as' => 'admin.coupons.update',
    'uses' => 'CouponController@update',
    'middleware' => 'can:admin.coupons.edit',
]);

Route::delete('coupons/{ids?}', [
    'as' => 'admin.coupons.destroy',
    'uses' => 'CouponController@destroy',
    'middleware' => 'can:admin.coupons.destroy',
]);

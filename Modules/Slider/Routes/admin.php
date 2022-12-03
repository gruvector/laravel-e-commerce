<?php

use Illuminate\Support\Facades\Route;

Route::get('sliders', [
    'as' => 'admin.sliders.index',
    'uses' => 'SliderController@index',
    'middleware' => 'can:admin.sliders.index',
]);

Route::get('sliders/create', [
    'as' => 'admin.sliders.create',
    'uses' => 'SliderController@create',
    'middleware' => 'can:admin.sliders.create',
]);

Route::post('sliders', [
    'as' => 'admin.sliders.store',
    'uses' => 'SliderController@store',
    'middleware' => 'can:admin.sliders.create',
]);

Route::get('sliders/{id}/edit', [
    'as' => 'admin.sliders.edit',
    'uses' => 'SliderController@edit',
    'middleware' => 'can:admin.sliders.edit',
]);

Route::put('sliders/{id}', [
    'as' => 'admin.sliders.update',
    'uses' => 'SliderController@update',
    'middleware' => 'can:admin.sliders.edit',
]);

Route::delete('sliders/{ids?}', [
    'as' => 'admin.sliders.destroy',
    'uses' => 'SliderController@destroy',
    'middleware' => 'can:admin.sliders.destroy',
]);

Route::get('slider-options', [
    'as' => 'admin.slider_options.index',
    'uses' => 'SliderOptionController@index',
    'middleware' => 'can:admin.slider_options.index',
]);

Route::get('slider-options/create', [
    'as' => 'admin.slider_options.create',
    'uses' => 'SliderOptionController@create',
    'middleware' => 'can:admin.slider_options.create',
]);

Route::post('slider-options', [
    'as' => 'admin.slider_options.store',
    'uses' => 'SliderOptionController@store',
    'middleware' => 'can:admin.slider_options.create',
]);

Route::get('slider-options/{id}/edit', [
    'as' => 'admin.slider_options.edit',
    'uses' => 'SliderOptionController@edit',
    'middleware' => 'can:admin.slider_options.edit',
]);

Route::put('slider-options/{id}', [
    'as' => 'admin.slider_options.update',
    'uses' => 'SliderOptionController@update',
    'middleware' => 'can:admin.slider_options.edit',
]);

Route::delete('slider-options/{ids?}', [
    'as' => 'admin.slider_options.destroy',
    'uses' => 'SliderOptionController@destroy',
    'middleware' => 'can:admin.slider_options.destroy',
]);

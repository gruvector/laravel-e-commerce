<?php

use Illuminate\Support\Facades\Route;

Route::get('settings', [
    'as' => 'admin.settings.edit',
    'uses' => 'SettingController@edit',
    'middleware' => 'can:admin.settings.edit',
]);

Route::put('settings', [
    'as' => 'admin.settings.update',
    'uses' => 'SettingController@update',
    'middleware' => 'can:admin.settings.edit',
]);

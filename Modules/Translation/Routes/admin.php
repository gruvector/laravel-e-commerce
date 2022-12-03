<?php

use Illuminate\Support\Facades\Route;

Route::get('translations', [
    'uses' => 'TranslationController@index',
    'as' => 'admin.translations.index',
    'middleware' => 'can:admin.translations.index',
]);

Route::put('translations/{key}', [
    'uses' => 'TranslationController@update',
    'as' => 'admin.translations.update',
    'middleware' => 'can:admin.translations.edit',
]);

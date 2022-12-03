<?php

use Illuminate\Support\Facades\Route;

Route::get('tags/{tag}/products', 'TagProductController@index')->name('tags.products.index');

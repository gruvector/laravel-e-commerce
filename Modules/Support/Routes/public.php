<?php

use Illuminate\Support\Facades\Route;

Route::get('countries/{code}/states', 'CountryStateController@index')->name('countries.states.index');

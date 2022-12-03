<?php

use Illuminate\Support\Facades\Route;

Route::get('login', 'AuthController@getLogin')->name('admin.login');
Route::post('login', 'AuthController@postLogin')->name('admin.login.post');

Route::get('logout', 'AuthController@getLogout')->name('admin.logout');

Route::get('password/reset', 'AuthController@getReset')->name('admin.reset');
Route::post('password/reset', 'AuthController@postReset')->name('admin.reset.post');
Route::get('password/reset/{email}/{code}', 'AuthController@getResetComplete')->name('admin.reset.complete');
Route::post('password/reset/{email}/{code}', 'AuthController@postResetComplete')->name('admin.reset.complete.post');

Route::get('users', [
    'as' => 'admin.users.index',
    'uses' => 'UserController@index',
    'middleware' => 'can:admin.users.index',
]);

Route::get('users/create', [
    'as' => 'admin.users.create',
    'uses' => 'UserController@create',
    'middleware' => 'can:admin.users.create',
]);

Route::post('users', [
    'as' => 'admin.users.store',
    'uses' => 'UserController@store',
    'middleware' => 'can:admin.users.create',
]);

Route::get('users/{id}/edit', [
    'as' => 'admin.users.edit',
    'uses' => 'UserController@edit',
    'middleware' => 'can:admin.users.edit',
]);

Route::put('users/{id}/edit', [
    'as' => 'admin.users.update',
    'uses' => 'UserController@update',
    'middleware' => 'can:admin.users.edit',
]);

Route::delete('users/{ids?}', [
    'as' => 'admin.users.destroy',
    'uses' => 'UserController@destroy',
    'middleware' => 'can:admin.users.destroy',
]);

Route::get('users/{id}/reset-password', [
    'as' => 'admin.users.reset_password',
    'uses' => 'UserResetPasswordController@store',
    'middleware' => 'can:admin.users.edit',
]);

Route::get('roles', [
    'as' => 'admin.roles.index',
    'uses' => 'RoleController@index',
    'middleware' => 'can:admin.roles.index',
]);

Route::get('roles/create', [
    'as' => 'admin.roles.create',
    'uses' => 'RoleController@create',
    'middleware' => 'can:admin.roles.create',
]);

Route::post('roles', [
    'as' => 'admin.roles.store',
    'uses' => 'RoleController@store',
    'middleware' => 'can:admin.roles.create',
]);

Route::get('roles/{id}/edit', [
    'as' => 'admin.roles.edit',
    'uses' => 'RoleController@edit',
    'middleware' => 'can:admin.roles.edit',
]);

Route::put('roles/{id}/edit', [
    'as' => 'admin.roles.update',
    'uses' => 'RoleController@update',
    'middleware' => 'can:admin.roles.edit',
]);

Route::delete('roles/{ids?}', [
    'as' => 'admin.roles.destroy',
    'uses' => 'RoleController@destroy',
    'middleware' => 'can:admin.roles.destroy',
]);

// Profile
Route::get('profile', [
    'as' => 'admin.profile.edit',
    'uses' => 'ProfileController@edit',
]);

Route::put('profile', [
    'as' => 'admin.profile.update',
    'uses' => 'ProfileController@update',
]);

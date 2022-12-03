<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('account', 'AccountDashboardController@index')->name('account.dashboard.index');

    Route::get('account/profile', 'AccountProfileController@edit')->name('account.profile.edit');
    Route::put('account/profile', 'AccountProfileController@update')->name('account.profile.update');

    Route::get('account/orders', 'AccountOrdersController@index')->name('account.orders.index');
    Route::get('account/orders/{id}', 'AccountOrdersController@show')->name('account.orders.show');

    Route::get('account/downloads', 'AccountDownloadsController@index')->name('account.downloads.index');
    Route::get('account/downloads/{id}', 'AccountDownloadsController@show')->name('account.downloads.show');

    Route::get('account/wishlist', 'AccountWishlistController@index')->name('account.wishlist.index');

    Route::get('account/reviews', 'AccountReviewController@index')->name('account.reviews.index');

    Route::get('addresses', 'AccountAddressController@index')->name('account.addresses.index');
    Route::post('addresses', 'AccountAddressController@store')->name('account.addresses.store');
    Route::put('addresses/{id}', 'AccountAddressController@update')->name('account.addresses.update');
    Route::delete('addresses/{id}', 'AccountAddressController@destroy')->name('account.addresses.destroy');

    Route::post('addresses/change-default-address', 'AccountDefaultAddressController@update')->name('account.change_default_address');
});

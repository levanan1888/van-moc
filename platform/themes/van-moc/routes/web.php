<?php

// Custom routes for Van Moc theme

use Illuminate\Support\Facades\Route;
use Botble\Theme\Facades\ThemeFacade;

ThemeFacade::routes();

Route::group(['namespace' => 'Theme\VanMoc\Http\Controllers', 'middleware' => ['web', 'core']], function () {

    Route::group(['prefix' => 'van-moc', 'as' => 'van-moc.'], function () {
        Route::get('search', 'VanMocController@getSearch')->name('search');
        Route::get('sitemap', 'VanMocController@getSiteMap')->name('sitemap');
    });

    // Contact form route
    Route::post('send-contact', 'VanMocController@sendContact')->name('public.send.contact');
    
    // Products route
    Route::get('products', 'VanMocController@getProducts')->name('public.products');
});

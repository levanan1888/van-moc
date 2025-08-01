<?php

// Custom routes for Van Moc theme

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Theme\\VanMoc\\Http\\Controllers', 'middleware' => ['web', 'core']], function () {
    Route::group(apply_filters(BASE_FILTER_GROUP_PUBLIC_ROUTE, []), function () {
        // Add your custom route here

        Route::get('ajax/search', 'VanMocController@getSearch')->name('public.ajax.search');
    });
});

\Botble\Theme\Facades\ThemeFacade::routes();

Route::group(['namespace' => 'Theme\\VanMoc\\Http\\Controllers', 'middleware' => ['web', 'core']], function () {
    Route::group(apply_filters(BASE_FILTER_GROUP_PUBLIC_ROUTE, []), function () {
        Route::get('/', 'VanMocController@getIndex')->name('public.index');

        Route::get('sitemap.xml', [
            'as' => 'public.sitemap',
            'uses' => 'VanMocController@getSiteMap',
        ]);

        Route::get('{slug?}' . config('core.base.general.public_single_ending_url'), [
            'as' => 'public.single',
            'uses' => 'VanMocController@getView',
        ]);
    });
});

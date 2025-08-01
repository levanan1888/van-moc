<?php

Route::group([
    'middleware' => 'api',
    'prefix' => 'api/v1',
    'namespace' => 'Botble\Product\Http\Controllers\API',
], function () {
    Route::get('psearch', 'ProductController@getSearch');
    Route::get('products', 'ProductController@index');
    Route::get('pcategories', 'CategoryController@index');
    Route::get('ptags', 'TagController@index');

    Route::get('products/filters', 'ProductController@getFilters');
    Route::get('products/{slug}', 'ProductController@findBySlug');
    Route::get('pcategories/filters', 'CategoryController@getFilters');
    Route::get('pcategories/{slug}', 'CategoryController@findBySlug');
});

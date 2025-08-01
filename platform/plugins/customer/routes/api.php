<?php

Route::group([
    'middleware' => 'api',
    'prefix' => 'api/v1',
    'namespace' => 'Botble\Customer\Http\Controllers\API',
], function () {
    Route::get('customers', 'CustomerController@index');
    Route::get('customers/{slug}', 'CustomerController@findBySlug');
});

<?php

use Botble\Customer\Models\Customer;

Route::group(['namespace' => 'Botble\Customer\Http\Controllers', 'middleware' => ['web', 'core']], function () {
    Route::group(['prefix' => BaseHelper::getAdminPrefix() . '/customers', 'middleware' => 'auth'], function () {
        Route::group(['prefix' => '/', 'as' => 'customers.'], function () {
            Route::resource('', 'CustomerController')
                ->parameters(['' => 'customer']);

            Route::delete('items/destroy', [
                'as' => 'deletes',
                'uses' => 'CustomerController@deletes',
                'permission' => 'customers.destroy',
            ]);
            Route::get('widgets/recent-customers', [
                'as' => 'widget.recent-customers',
                'uses' => 'CustomerController@getWidgetRecentCustomer',
                'permission' => 'customers.index',
            ]);
        });
    });
});

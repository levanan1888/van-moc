<?php

use Botble\Product\Models\Category;
use Botble\Product\Models\Product;
use Botble\Product\Models\Tag;

Route::group(['namespace' => 'Botble\Product\Http\Controllers', 'middleware' => ['web', 'core']], function () {
    Route::group(['prefix' => BaseHelper::getAdminPrefix() . '/product', 'middleware' => 'auth'], function () {
        Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
            Route::resource('', 'ProductController')
                ->parameters(['' => 'product']);

            Route::delete('items/destroy', [
                'as' => 'deletes',
                'uses' => 'ProductController@deletes',
                'permission' => 'products.destroy',
            ]);

            Route::get('widgets/recent-products', [
                'as' => 'widget.recent-products',
                'uses' => 'ProductController@getWidgetRecentProduct',
                'permission' => 'products.index',
            ]);
        });

        Route::group(['prefix' => 'categories', 'as' => 'pcategories.'], function () {
            Route::resource('', 'CategoryController')
                ->parameters(['' => 'pcategory']);

            Route::delete('items/destroy', [
                'as' => 'deletes',
                'uses' => 'CategoryController@deletes',
                'permission' => 'pcategories.destroy',
            ]);
        });

        Route::group(['prefix' => 'tags', 'as' => 'ptags.'], function () {
            Route::resource('', 'TagController')
                ->parameters(['' => 'ptag']);

            Route::delete('items/destroy', [
                'as' => 'deletes',
                'uses' => 'TagController@deletes',
                'permission' => 'ptags.destroy',
            ]);

            Route::get('all', [
                'as' => 'all',
                'uses' => 'TagController@getAllTags',
                'permission' => 'ptags.index',
            ]);
        });
    });

    if (defined('THEME_MODULE_SCREEN_NAME')) {
        Route::group(apply_filters(BASE_FILTER_GROUP_PUBLIC_ROUTE, []), function () {
            Route::get('search', [
                'as' => 'public.product.search',
                'uses' => 'PublicController@getSearch',
            ]);

            if (SlugHelper::getPrefix(Tag::class, 'tag')) {
                Route::get(SlugHelper::getPrefix(Tag::class, 'tag') . '/{slug}', [
                    'as' => 'public.tag',
                    'uses' => 'PublicController@getTag',
                ]);
            }

            if (SlugHelper::getPrefix(Product::class)) {
                Route::get(SlugHelper::getPrefix(Product::class) . '/{slug}', [
                    'uses' => 'PublicController@getProduct',
                ]);
            }

            if (SlugHelper::getPrefix(Category::class)) {
                Route::get(SlugHelper::getPrefix(Category::class) . '/{slug}', [
                    'uses' => 'PublicController@getCategory',
                ]);
            }
        });
    }
});

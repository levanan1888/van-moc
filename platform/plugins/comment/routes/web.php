<?php

Route::group(['namespace' => 'Botble\Comment\Http\Controllers', 'middleware' => ['web', 'core']], function () {
    Route::group(['prefix' => BaseHelper::getAdminPrefix(), 'middleware' => 'auth'], function () {
        Route::group(['prefix' => 'comments', 'as' => 'comments.'], function () {
            Route::resource('', 'CommentController')->except(['create', 'store'])->parameters(['' => 'comment']);

            Route::delete('items/destroy', [
                'as' => 'deletes',
                'uses' => 'CommentController@deletes',
                'permission' => 'comments.destroy',
            ]);

            Route::post('reply/{id}', [
                'as' => 'reply',
                'uses' => 'CommentController@postReply',
                'permission' => 'comments.edit',
            ]);
        });
    });

    Route::group(apply_filters(BASE_FILTER_GROUP_PUBLIC_ROUTE, []), function () {
        Route::post('comment/send', [
            'as' => 'public.send.comment',
            'uses' => 'PublicController@postSendComment',
        ]);
    });
});

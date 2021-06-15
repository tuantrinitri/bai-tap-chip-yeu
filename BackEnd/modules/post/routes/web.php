<?php

Route::group(['namespace' => '\Modules\Post\Http\Controllers', 'middleware' => 'web'], function () {

    Route::group(['middleware' => 'auth', 'prefix' => config('cms.admin_prefix')], function () {

        Route::group(['prefix' => 'posts'], function () {
            Route::get('/', [
                'as' => 'post.admin.index',
                'uses' => 'PostController@getList'
            ]);
            Route::get('add', [
                'as' => 'post.admin.create',
                'uses' => 'PostController@getAdd'
            ]);
            Route::post('add', [
                'as' => 'post.admin.create',
                'uses' => 'PostController@postAdd'
            ]);
            Route::get('edit/{id}', [
                'as' => 'post.admin.edit',
                'uses' => 'PostController@getEdit'
            ]);
            Route::post('edit/{id}', [
                'as' => 'post.admin.edit',
                'uses' => 'PostController@postEdit'
            ]);
            Route::get('delete/{id}', [
                'as' => 'post.admin.delete',
                'uses' => 'PostController@delete'
            ]);
            Route::post('status', [
                'as' => 'post.admin.status',
                'uses' => 'PostController@status'
            ]);
        });
        Route::group(['prefix' => 'categories'], function () {
            Route::get('/', [
                'as' => 'category.admin.list',
                'uses' => 'CategoryController@getList'
            ]);
            Route::post('/add', [
                'as' => 'category.admin.add',
                'uses' => 'CategoryController@postAdd'
            ]);
            Route::get('/edit/{id}', [
                'as' => 'category.admin.edit',
                'uses' => 'CategoryController@getEdit'
            ]);
            Route::post('/edit/{id}', [
                'as' => 'category.admin.edit',
                'uses' => 'CategoryController@postEdit'
            ]);
            Route::get('/delete/{id}', [
                'as' => 'category.admin.delete',
                'uses' => 'CategoryController@getDelete'
            ]);
            Route::post('status', [
                'as' => 'category.ajax.status',
                'uses' => 'CategoryController@status'
            ]);

            Route::post('/oder', [
                'as' => 'category.ajax.order',
                'uses' => 'CategoryController@order'
            ]);
        });
    });
});

/**
 * ROUTES FOR API: Company
 */
Route::group(['namespace' => '\Modules\Post\Http\Controllers'], function () {
    Route::get('api/categories', [
        'as' => 'account.api.categories',
        'uses' => 'ApiController@categories'
    ]);

    Route::get('api/posts', [
        'as' => 'account.api.post',
        'uses' => 'ApiController@post'
    ]);
});
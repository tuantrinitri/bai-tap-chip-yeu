<?php

Route::group(['namespace' => '\Modules\Post\Http\Controllers', 'middleware' => 'web'], function () {

    Route::group(['middleware' => 'auth', 'prefix' => config('cms.admin_prefix')], function () {

        Route::group(['prefix' => 'posts'], function () {
            Route::get('/', [
                'as' => 'post.admin.index',
                'uses' => 'PostController@getList',
                'permission' => 'post.admin.index',
            ]);
            Route::get('add', [
                'as' => 'post.admin.create',
                'uses' => 'PostController@getAdd',
                'permission' => 'post.admin.index',
            ]);
            Route::post('add', [
                'as' => 'post.admin.create',
                'uses' => 'PostController@postAdd',
                'permission' => 'post.admin.index',
            ]);
            Route::get('edit/{id}', [
                'as' => 'post.admin.edit',
                'uses' => 'PostController@getEdit',
                'permission' => 'post.admin.index',
            ]);
            Route::post('edit/{id}', [
                'as' => 'post.admin.edit',
                'uses' => 'PostController@postEdit',
                'permission' => 'post.admin.index',
            ]);
            Route::get('delete/{id}', [
                'as' => 'post.admin.delete',
                'uses' => 'PostController@delete',
                'permission' => 'post.admin.index',
            ]);
            Route::post('status', [
                'as' => 'post.admin.status',
                'uses' => 'PostController@status',
                'permission' => 'post.admin.index',
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
    Route::get('api/categories/{slug}', [
        'as' => 'account.api.categories',
        'uses' => 'ApiController@categories'
    ]);

    Route::get('api/posts/{slug}', [
        'as' => 'account.api.post',
        'uses' => 'ApiController@post'
    ]);

    Route::get('api/categories', [
        'uses' => 'ApiController@listCategory'
    ]);

    Route::get('api/post-in-category/{slug}', [
        'uses' => 'ApiController@randomFivePost'
    ]);
});

<?php

Route::group(['namespace' => '\Modules\Post\Http\Controllers', 'middleware' => 'web'], function () {

    Route::group(['middleware' => 'auth', 'prefix' => config('cms.admin_prefix')], function () {
        Route::group(['prefix' => 'posts'], function () {
            Route::get('/', [
                'as' => 'post.admin.index',
                'uses' => 'PostController@index',
                'permission' => 'post.admin.index',
            ]);
            Route::get('create', [
                'as' => 'post.admin.create',
                'uses' => 'PostController@create',
                'permission' => 'post.admin.create',
            ]);
            Route::post('create', [
                'as' => 'post.admin.create',
                'uses' => 'PostController@store',
                'permission' => 'post.admin.create',
            ]);
            Route::get('edit/{id}', [
                'as' => 'post.admin.edit',
                'uses' => 'PostController@edit',
                'permission' => 'post.admin.edit'
            ]);
            Route::post('edit/{id}', [
                'as' => 'post.admin.edit',
                'uses' => 'PostController@update',
                'permission' => 'post.admin.edit'
            ]);
            Route::get('delete/{id}', [
                'as' => 'post.admin.delete',
                'uses' => 'PostController@delete',
                'permission' => 'post.admin.delete'
            ]);
            Route::post('status', [
                'as' => 'post.admin.status',
                'uses' => 'PostController@status',
                'permission' => 'dashboard',
            ]);
            Route::post('langue', [
                'as' => 'post.ajax.langue',
                'uses' => 'PostController@langue',
                'permission' => 'dashboard',
            ]);
        });
        Route::group(['prefix' => 'categories'], function () {
            Route::get('/', [
                'as' => 'category.admin.index',
                'uses' => 'CategoryController@index',
                'permission' => 'post.admin.index',
            ]);
            Route::get('/create', [
                'as' => 'category.admin.create',
                'uses' => 'CategoryController@create', 'permission' => 'post.admin.index'
            ]);
            Route::post('/create', [
                'as' => 'category.admin.add',
                'uses' => 'CategoryController@store', 'permission' => 'post.admin.index'
            ]);
            Route::get('/edit/{id}', [
                'as' => 'category.admin.edit',
                'uses' => 'CategoryController@edit', 'permission' => 'post.admin.index'
            ]);
            Route::post('/edit/{id}', [
                'as' => 'category.admin.edit',
                'uses' => 'CategoryController@update', 'permission' => 'post.admin.index'
            ]);
            Route::get('/delete/{id}', [
                'as' => 'category.admin.delete',
                'uses' => 'CategoryController@delete', 'permission' => 'post.admin.index'
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
Route::group(['namespace' => '\Modules\Post\Http\Controllers', 'middleware' => ['web']], function () {
    Route::get('bai-viet/{slug}', 'WebController@post')->name('post.web.post');
    Route::get('danh-muc/{slug}', 'WebController@category')->name('post.web.category');
});

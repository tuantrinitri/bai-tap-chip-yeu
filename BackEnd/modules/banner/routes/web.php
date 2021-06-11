<?php

Route::group(['namespace' => '\Modules\Banner\Http\Controllers', 'middleware' => 'web'], function () {
    /**
     * ROUTES FOR ADMIN: Banner
     */
    Route::group(['middleware' => ['auth'], 'prefix' => config('cms.admin_prefix') . '/banners'], function () {
        Route::get('/', [
            'as' => 'banner.admin.index',
            'uses' => 'BannerController@index',
            'permission' => 'banner.admin.index',
        ]);
        Route::get('/create', [
            'as' => 'banner.admin.create',
            'uses' => 'BannerController@create',
            'permission' => 'banner.admin.create'
        ]);
        Route::post('/create', [
            'as' => 'banner.admin.create',
            'uses' => 'BannerController@store',
            'permission' => 'banner.admin.create',
        ]);
        Route::get('edit/{id}', [
            'as' => 'banner.admin.edit',
            'uses' => 'BannerController@edit',
            'permission' => 'banner.admin.edit',
        ]);
        Route::post('edit/{id}', [
            'as' => 'banner.admin.edit',
            'uses' => 'BannerController@update',
            'permission' => 'banner.admin.edit',
        ]);
        Route::get('delete/{id}', [
            'as' => 'banner.admin.delete',
            'uses' => 'BannerController@delete',
            'permission' => 'banner.admin.delete',
        ]);

        Route::group(['middleware' => ['auth'], 'prefix' => config('cms.admin_prefix') . '/widget-baners'], function () {
            Route::get('/', [
                'as' => 'banner.admin.widget',
                'uses' => 'WidgetBanerController@index'
            ]);

            Route::get('edit/{id}', [
                'as' => 'banner.admin.widget.edit',
                'uses' => 'WidgetBanerController@edit'
            ]);

            Route::post('edit/{id}', [
                'as' => 'banner.admin.widget.edit',
                'uses' => 'WidgetBanerController@update'
            ]);
        });
    });
});

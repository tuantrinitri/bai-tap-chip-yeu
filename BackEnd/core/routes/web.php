<?php

Route::group(['middleware' => 'web'], function () {
    // Route::get('/', '\Core\Http\Controllers\WebController@getIndex')->name('index');

    Route::get('/admin-lang/{lang}', '\Core\Http\Controllers\DashboardController@getChangeLang')->name('admin.locale');

    Route::group(['middleware' => ['auth'], 'prefix' => config('cms.admin_prefix'), 'namespace' => 'Core\Http\Controllers'], function () {

        Route::get('/', [
            'as' => 'dashboard',
            'uses' => 'DashboardController@index'
        ]);
        Route::post('getslug', [
            'as' => 'get-slug',
            'uses' => 'DashboardController@slug',
            'permission' => 'dashboard',
        ]);
        Route::group(['prefix' => 'system'], function () {
            Route::get('cache', 'SystemController@getCache')->name('core.admin.system_cache');
            Route::post('clear-cache', 'SystemController@postClearCache')->name('core.admin.post_clear_cache');
        });

        Route::group(['prefix' => 'modules'], function () {
            Route::get('/', 'ModuleController@getListModule')->name('core.admin.list_module');
            Route::get('/install/{module}', 'ModuleController@getInstallModule')->name('core.admin.install_module');
            Route::get('/uninstall/{module}', 'ModuleController@getUninstallModule')->name('core.admin.uninstall_module');

            Route::get('edit/{name}', [
                'as' => 'core.admin.edit_module',
                'uses' => 'ModuleController@getEditModule'
            ]);
            Route::post('edit/{name}', [
                'as' => 'core.admin.edit_module',
                'uses' => 'ModuleController@postEditModule'
            ]);

            Route::post('/ajaxChangeStatus', 'ModuleController@ajaxChangeStatus')->name('core.admin.ajaxchangestatus_module');
            Route::post('/ajaxChangeOrderModule', 'ModuleController@ajaxChangeOrderModule')->name('core.admin.ajaxChangeOrderModule');
        });

        // Route::group(['prefix' => 'notifications'], function () {
        //     Route::get('', 'NotificationController@getList')->name('core.admin.list_notification');
        //     Route::post('/ajaxLoad', 'NotificationController@ajaxLoad')->name('core.ajax.load_notifications');
        //     Route::post('/bulkaction', 'NotificationController@postBulkaction')->name('core.admin.bulkaction_notification');
        // });

        Route::group(['prefix' => 'settings'], function () {
            Route::get('/', [
                'as' => 'core.admin.setting',
                'uses' => 'SettingController@getSetting'
            ]);
            Route::post('/', [
                'as' => 'core.admin.post_setting',
                'uses' => 'SettingController@postSetting'
            ]);

            Route::post('test-config-mail', [
                'as' => 'core.admin.test_config_mail',
                'uses' => 'SettingController@ajaxTestConfigMail'
            ]);
        });

        Route::group(['prefix' => 'files'], function () {
            Route::get('/', [
                'as' => 'core.admin.files',
                'uses' => 'FileController@getMain'
            ]);
        });

    });
});
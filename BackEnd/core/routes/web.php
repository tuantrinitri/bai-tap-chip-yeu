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

        // Route::group(['prefix' => 'backups'], function () {
        //     Route::get('/', 'BackupController@getListBackup')->name('core.admin.list_backup');
        //     Route::get('/run', 'BackupController@getRunBackup')->name('core.admin.run_backup');
        //     Route::get('/download/{filename}', 'BackupController@getDownloadBackup')->name('core.admin.download_backup');
        //     Route::get('/delete/{filename}', 'BackupController@getDeleteBackup')->name('core.admin.delete_backup');
        // });

        // Route::group(['prefix' => 'addons'], function () {
        //     Route::get('/', 'AddonsController@getAddons')->name('core.admin.addons');
        //     Route::post('/', 'AddonsController@postAddons')->name('core.admin.post_addons');
        // });

        // Route::group(['prefix' => 'activity-logs'], function () {
        //     Route::get('/', 'ActivityLogController@getList')->name('core.admin.list_activity_log');
        //     Route::get('/deleteAll', 'ActivityLogController@getDeleteAll')->name('core.admin.delete_all_activity_log');
        // });

        // Route::group(['prefix' => 'email-templates'], function () {
        //     Route::get('/', 'EmailTemplateController@getList')->name('core.admin.list_email_templates');
        //     Route::get('/{id}', 'EmailTemplateController@getEdit')->name('core.admin.edit_email_template');
        //     Route::post('/{id}', 'EmailTemplateController@postEdit')->name('core.admin.post_edit_email_template');
        // });

        // Route::group(['prefix' => 'layouts'], function () {
        //     Route::get('/', 'LayoutController@getLayouts')->name('core.admin.layouts');
        //     Route::post('/', 'LayoutController@ajaxSaveLayout')->name('core.admin.ajax_layout');
        // });
    });
});
<?php

Route::group(['namespace' => '\Modules\Widget\Http\Controllers', 'middleware' => 'web'], function () {
    /**
     * ROUTES FOR ADMIN: Widget
     */
    Route::group(['middleware' => ['auth'], 'prefix' => config('cms.admin_prefix') . '/widgets'], function () {

        Route::get('/', 'WidgetController@index')->name('widget.admin.list');
        Route::get('/add', 'WidgetController@getAdd')->name('widget.admin.create');
        Route::post('/add', 'WidgetController@postAdd')->name('widget.admin.store');
        Route::get('/edit/{id}', 'WidgetController@show')->name('widget.admin.show');
        Route::post('/edit/{id}', 'WidgetController@update')->name('widget.admin.update');
        Route::get('/delete/{id}', 'WidgetController@delete')->name('widget.admin.delete');

        Route::post('/change-widget', 'WidgetController@ajaxChangStatusWidget')->name('widget.admin.ajaxChangeStatusWidget');
        Route::post('/load-widget-module', 'WidgetController@ajaxLoadWidgetModule')->name('widget.admin.ajaxLoadWidgetModule');
        Route::post('/load-config-widget', 'WidgetController@ajaxLoadConfigWidget')->name('widget.admin.ajaxLoadConfigWidget');

        Route::post('/load-add-widget', 'WidgetController@ajaxLoadAddWidget')->name('widget.admin.ajaxLoadAddWidget');
        Route::post('/load-widget-to-group', 'WidgetController@ajaxLoadWidgetToGroup')->name('widget.admin.ajaxLoadWidgetToGroup');
        Route::post('/submit-add-widget', 'WidgetController@ajaxSubmitAddWidget')->name('widget.admin.ajaxSubmitAddWidget');
        Route::post('/submit-update-widget', 'WidgetController@ajaxSubmitUpdateWidget')->name('widget.admin.ajaxSubmitUpdateWidget');
        Route::post('/submit-delete-widget', 'WidgetController@ajaxSubmitDeleteWidget')->name('widget.admin.ajaxSubmitDeleteWidget');
        Route::post('/update-position-widget', 'WidgetController@ajaxUpdatePositionWidget')->name('widget.admin.ajaxUpdatePositionWidget');
    });
});

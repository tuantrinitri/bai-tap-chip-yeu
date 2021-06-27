<?php

Route::group(['namespace' => '\Modules\Contact\Http\Controllers', 'middleware' => 'web'], function () {
    /**
     * ROUTES FOR ADMIN: Contact
     */
    Route::group(['middleware' => ['auth'], 'prefix' => config('cms.admin_prefix') . '/contacts'], function () {
        Route::get('/', [
            'as' => 'contact.admin.list',
            'uses' => 'ContactController@getListContact',
            'permission' => 'contact.admin.list',
        ]);
        Route::post('/bulkaction', [
            'as' => 'contact.admin.bulkaction',
            'uses' => 'ContactController@postBulkAction',
            'permission' => 'contact.admin.list',
        ]);
        Route::get('/view/{id}', [
            'as' => 'contact.admin.view',
            'uses' => 'ContactController@viewContact',
            'permission' => 'contact.admin.list',
        ]);
        Route::post('/edit/{id}', [
            'as' => 'contact.admin.edit',
            'uses' => 'ContactController@postEditContact',
            'permission' => 'contact.admin.list',
        ]);
        Route::get('/config', [
            'as' => 'contact.admin.config',
            'uses' => 'ContactController@getConfigContact',
            'permission' => 'contact.admin.list',
        ]);
        Route::post('/config', [
            'as' => 'contact.admin.config',
            'uses' => 'ContactController@postConfigContact',
            'permission' => 'contact.admin.list',
        ]);
        Route::group(['prefix' => 'topics'], function () {
            Route::get('/', [
                'as' => 'contact.topic.admin.list',
                'uses' => 'TopicController@getListTopic',
                'permission' => 'contact.admin.list',
            ]);
            Route::get('create', [
                'as' => 'contact.topic.admin.create',
                'uses' => 'TopicController@getCreateTopic',
                'permission' => 'contact.admin.list',
            ]);
            Route::post('create', [
                'as' => 'contact.topic.admin.create',
                'uses' => 'TopicController@postCreateTopic',
                'permission' => 'contact.admin.list',
            ]);
            Route::get('edit/{id}', [
                'as' => 'contact.topic.admin.edit',
                'uses' => 'TopicController@getEditTopic',
                'permission' => 'contact.admin.list',
            ]);
            Route::post('edit/{id}', [
                'as' => 'contact.topic.admin.edit',
                'uses' => 'TopicController@postEditTopic',
                'permission' => 'contact.admin.list',
            ]);
            Route::post('/ajax-change-status', [
                'as' => 'contact.ajax.changeStatusTopic',
                'uses' => 'TopicController@postAjaxChangeStatus',
                'permission' => 'contact.admin.list',
            ]);
            Route::post('/ajax-change-status-auto-send-mail', [
                'as' => 'contact.ajax.changeStatusTopicAutoSendMail',
                'uses' => 'TopicController@postAjaxChangeStatusAutoSendMail',
                'permission' => 'contact.admin.list',
            ]);
            Route::get('delete/{id}', [
                'as' => 'contact.topic.admin.delete',
                'uses' => 'TopicController@getDeleteTopic',
                'permission' => 'contact.admin.list',
            ]);
        });
    });
});

/**
 * ROUTES FOR API: Contact
 * 
 */
Route::group(['namespace' => '\Modules\Contact\Http\Controllers'], function () {
    Route::post('api/contact', [
        'uses' => 'ApiController@postSendmail'
    ]);
});
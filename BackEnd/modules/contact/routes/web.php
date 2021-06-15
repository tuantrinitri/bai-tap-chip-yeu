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
            'permission' => 'contact.admin.bulkaction',
        ]);
        Route::get('/view/{id}', [
            'as' => 'contact.admin.view',
            'uses' => 'ContactController@viewContact',
            'permission' => 'contact.admin.view',
        ]);
        Route::post('/edit/{id}', [
            'as' => 'contact.admin.edit',
            'uses' => 'ContactController@postEditContact',
            'permission' => 'contact.admin.edit',
        ]);
        Route::get('/config', [
            'as' => 'contact.admin.config',
            'uses' => 'ContactController@getConfigContact',
            'permission' => 'contact.admin.config',
        ]);
        Route::post('/config', [
            'as' => 'contact.admin.config',
            'uses' => 'ContactController@postConfigContact',
            'permission' => 'user.admin.list',
        ]);
        Route::group(['prefix' => 'topics'], function () {
            Route::get('/', [
                'as' => 'contact.topic.admin.list',
                'uses' => 'TopicController@getListTopic',
                'permission' => 'contact.topic.admin.list',
            ]);
            Route::get('create', [
                'as' => 'contact.topic.admin.create',
                'uses' => 'TopicController@getCreateTopic',
                'permission' => 'contact.topic.admin.create',
            ]);
            Route::post('create', [
                'as' => 'contact.topic.admin.create',
                'uses' => 'TopicController@postCreateTopic',
                'permission' => 'contact.topic.admin.create',
            ]);
            Route::get('edit/{id}', [
                'as' => 'contact.topic.admin.edit',
                'uses' => 'TopicController@getEditTopic',
                'permission' => 'contact.topic.admin.edit',
            ]);
            Route::post('edit/{id}', [
                'as' => 'contact.topic.admin.edit',
                'uses' => 'TopicController@postEditTopic',
                'permission' => 'contact.topic.admin.edit',
            ]);
            Route::post('/ajax-change-status', [
                'as' => 'contact.ajax.changeStatusTopic',
                'uses' => 'TopicController@postAjaxChangeStatus',
                'permission' => 'contact.ajax.changeStatusTopic',
            ]);
            Route::post('/ajax-change-status-auto-send-mail', [
                'as' => 'contact.ajax.changeStatusTopicAutoSendMail',
                'uses' => 'TopicController@postAjaxChangeStatusAutoSendMail',
                'permission' => 'contact.ajax.changeStatusTopicAutoSendMail',
            ]);
            Route::get('delete/{id}', [
                'as' => 'contact.topic.admin.delete',
                'uses' => 'TopicController@getDeleteTopic',
                'permission' => 'contact.topic.admin.delete',
            ]);
        });
    });
});

Route::get('/test-sendmail', [
    'as' => 'contact.test_sendmail',
    'uses' => '\Modules\Contact\Http\Controllers\WebController@getTestSendmail'
]);
Route::post('/test-sendmail', [
    'as' => 'post.contact.test_sendmail',
    'uses' => '\Modules\Contact\Http\Controllers\WebController@postTestSendmail'
]);

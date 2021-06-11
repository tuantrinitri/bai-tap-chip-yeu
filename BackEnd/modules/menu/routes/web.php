<?php

Route::group(['namespace' => '\Modules\Menu\Http\Controllers', 'middleware' => 'web'], function () {
    /**
     * ROUTES FOR ADMIN: Menu
     */
    Route::group(['middleware' => ['auth'], 'prefix' => config('cms.admin_prefix') . '/menus'], function () {
        Route::get('/', 'MenuController@index')->name('menu.admin.index');
        Route::get('/create', 'MenuController@create')->name('menu.admin.create');
        Route::post('/create', 'MenuController@store')->name('menu.admin.create');
        Route::get('/edit/{id}', 'MenuController@edit')->name('menu.admin.edit');
        Route::post('/edit/{id}', 'MenuController@update')->name('menu.admin.edit');
        Route::get('/delete/{id}', 'MenuController@delete')->name('menu.admin.delete');
        Route::get('/{id}', 'MenuController@item')->name('menu.admin.item');
        Route::group(['prefix' => 'items'], function () {
            Route::get('/create/{id}', 'ItemController@create')->name('item.admin.create');
            Route::post('/create/{id}', 'ItemController@store')->name('item.admin.store');
            Route::get('/edit/{id}', 'ItemController@edit')->name('item.admin.edit');
            Route::post('/edit/{id}', 'ItemController@update')->name('item.admin.update');
            Route::get('/delete/{id}', 'ItemController@delete')->name('item.admin.delete');
            Route::post('/ajaxChangeOrderMenuItem', 'ItemController@ajaxChangeOderMenuItem')->name('item.admin.ajaxChangeOrderMenuItem');
            Route::post('/changeStatus', 'ItemController@ajaxChangeStatus')->name('item.ajax.changeStatus');
            Route::post('/loadlistitem', 'ItemController@ajaxLoadListItem')->name('item.admin.ajaxloadlistitem');
        });
    });
});

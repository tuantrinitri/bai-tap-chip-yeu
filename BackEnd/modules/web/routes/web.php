<?php

Route::group(['namespace' => '\Modules\Web\Http\Controllers', 'middleware' => 'web'], function () {
    Route::get('/', [
        'as' => 'index',
        'uses' => 'WebController@index',
    ]);
});

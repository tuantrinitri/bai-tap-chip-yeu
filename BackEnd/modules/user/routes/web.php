<?php

Route::group(['namespace' => '\Modules\User\Http\Controllers', 'middleware' => 'web'], function () {
    /**
     * Authentication
     */
    Route::get('/login', [
        'as' => 'user.admin.login',
        'uses' => 'AuthController@showLoginAdmin'
    ]);
    Route::post('login', [
        'as' => 'user.login',
        'uses' => 'AuthController@login',
    ]);
    Route::get('logout', [
        'as' => 'user.logout',
        'uses' => 'AuthController@logout'
    ]);

    Route::get('login/{provider}', [
        'as' => 'user.social.login',
        'uses' => 'AuthController@redirectToProvider'
    ]);
    Route::get('auth/{provider}/callback', [
        'as' => 'user.social.callback',
        'uses' => 'AuthController@handleProviderCallback'
    ]);

    /**
     * Required authentication
     */
    Route::group(['middleware' => 'auth'], function () {
        /**
         * Admin area
         */
        Route::group(['prefix' => config('cms.admin_prefix')], function () {
            /**
             * Users management
             */
            Route::group(['prefix' => 'users'], function () {
                Route::get('/', [
                    'as' => 'user.admin.list',
                    'uses' => 'UserController@getListUser',
                    'permission' => 'user.admin.list',
                ]);
                Route::get('create', [
                    'as' => 'user.admin.add',
                    'uses' => 'UserController@getAddUser',
                    'permission' => 'user.admin.add'
                ]);
                Route::post('add', [
                    'as' => 'user.admin.add',
                    'uses' => 'UserController@addUser',
                    'permission' => 'user.admin.add'
                ]);
                Route::get('edit/{id}', [
                    'as' => 'user.admin.edit',
                    'uses' => 'UserController@getEditUser'
                ]);
                Route::post('edit/{id}', [
                    'as' => 'user.admin.edit',
                    'uses' => 'UserController@editUser'
                ]);
                Route::get('delete/{id}', [
                    'as' => 'user.admin.delete',
                    'uses' => 'UserController@deleteUser'
                ]);
                Route::post('status', [
                    'as' => 'user.ajax.status',
                    'uses' => 'UserController@status'
                ]);
                Route::post('bulk-action', [
                    'as' => 'user.admin.bulk_action',
                    'uses' => 'UserController@bulkAction'
                ]);
            });

            /**
             * Profile (admin)
             */
            Route::get('profile', [
                'as' => 'user.admin.profile',
                'uses' => 'UserController@getEditProfile'
            ]);
            Route::post('profile', [
                'as' => 'user.admin.profile',
                'uses' => 'UserController@postEditProfile'
            ]);

            /**
             * Roles management
             */
            Route::group(['prefix' => 'roles'], function () {
                Route::get('/', [
                    'as' => 'role.admin.list',
                    'uses' => 'RoleController@getListRole'
                ]);
                Route::get('add', [
                    'as' => 'role.admin.add',
                    'uses' => 'RoleController@getAddRole'
                ]);
                Route::post('add', [
                    'as' => 'role.admin.add',
                    'uses' => 'RoleController@postAddRole'
                ]);
                Route::get('edit/{id}', [
                    'as' => 'role.admin.edit',
                    'uses' => 'RoleController@getEditRole'
                ]);
                Route::post('edit/{id}', [
                    'as' => 'role.admin.edit',
                    'uses' => 'RoleController@editRole'
                ]);
                Route::get('delete/{id}', [
                    'as' => 'role.admin.delete',
                    'uses' => 'RoleController@deleteRole'
                ]);
                Route::post('change-order', [
                    'as' => 'role.ajax.order',
                    'uses' => 'RoleController@ajaxChangeOrdeRole'
                ]);
            });

            /**
             * Permissions management
             */
            Route::group(['prefix' => 'permissions'], function () {
                Route::get('/', [
                    'as' => 'permission.admin.list',
                    'uses' => 'PermissionController@getList'
                ]);
                Route::post('sync', [
                    'as' => 'permission.admin.sync',
                    'uses' => 'PermissionController@ajaxSyncPermissions'
                ]);
            });

            /**
             * Departments management
             */
            Route::group(['prefix' => 'departments'], function () {
                Route::get('/', [
                    'as' => 'department.admin.list',
                    'uses' => 'DepartmentController@getListDepartment'
                ]);
                Route::post('add', [
                    'as' => 'department.admin.add',
                    'uses' => 'DepartmentController@postAddDepartment'
                ]);
                Route::get('edit/{id}', [
                    'as' => 'department.admin.edit',
                    'uses' => 'DepartmentController@getEditDepartment'
                ]);
                Route::post('edit/{id}', [
                    'as' => 'department.admin.edit',
                    'uses' => 'DepartmentController@postEditDepartment'
                ]);
                Route::get('delete/{id}', [
                    'as' => 'department.admin.delete',
                    'uses' => 'DepartmentController@getDeleteDepartment'
                ]);
            });
        });
    });
});

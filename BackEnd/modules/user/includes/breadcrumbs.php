<?php
Breadcrumbs::for('user', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans('user::user.user_management'), route('user.admin.list'));
});
/**
 * User
 */
Breadcrumbs::for('user.admin.list', function ($trail) {
    $trail->parent('user');
    $trail->push(trans('user::user.list_user'), route('user.admin.list'));
});
Breadcrumbs::for('user.admin.profile', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Thông tin tài khoản', route('user.admin.profile'));
});

Breadcrumbs::for('user.admin.add', function ($trail) {
    $trail->parent('user.admin.list');
    $trail->push('Thêm tài khoản', route('user.admin.add'));
});
Breadcrumbs::for('user.admin.edit', function ($trail, $id) {
    $trail->parent('user.admin.list');
    $trail->push('#' . $id, route('user.admin.edit', $id));
});

/**
 * Role
 */
Breadcrumbs::for('role.admin.list', function ($trail) {
    $trail->parent('user');
    $trail->push(trans('user::role.role_management'), route('role.admin.list'));
});
Breadcrumbs::for('role.admin.add', function ($trail) {
    $trail->parent('role.admin.list');
    $trail->push(trans('user::role.create_role'), route('role.admin.add'));
});
Breadcrumbs::for('role.admin.edit', function ($trail, $id) {
    $trail->parent('role.admin.list');
    $trail->push(trans('user::role.edit_role'), route('role.admin.edit', $id));
});

/**
 * Permissions
 */
Breadcrumbs::for('permission.admin.list', function ($trail) {
    $trail->parent('user');
    $trail->push(trans('user::permission.permission_management'), route('permission.admin.list'));
});

/**
 * Department
 */
Breadcrumbs::for('department.admin.list', function ($trail) {
    $trail->parent('user');
    $trail->push(trans('user::department.department_management'), route('department.admin.list'));
});
Breadcrumbs::for('department.admin.edit', function ($trail, $id) {
    $trail->parent('department.admin.list');

    $trail->push('#' . $id, route('department.admin.edit', $id));
});

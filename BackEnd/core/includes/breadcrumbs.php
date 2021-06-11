<?php

/**
 * Init breadcrumbs for admin routes
 */

Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('<i class="icon-home2 mr-2"></i>' . trans('core::common.dashboard'), route('dashboard'));
});
Breadcrumbs::for('core.admin.setting', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Cài đặt hệ thống', route('core.admin.setting'));
});
Breadcrumbs::for('core.admin.setting_system', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Thiết lập hệ thống', route('core.admin.setting_system'));
});
Breadcrumbs::for('core.admin.files', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans('core::common.file_management'), route('core.admin.files'));
});
Breadcrumbs::for('core.admin.list_notification', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Thông báo', route('core.admin.list_notification'));
});

Breadcrumbs::for('core.admin.list_module', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Quản lý module', route('core.admin.list_module'));
});

Breadcrumbs::for('core.admin.list_activity_log', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Nhật ký hoạt động', route('core.admin.list_activity_log'));
});

Breadcrumbs::for('core.admin.edit_module', function ($trail, $data) {
    $trail->parent('core.admin.list_module');
    $trail->push('Module: "' . $data . '"', route('core.admin.edit_module', $data));
});

Breadcrumbs::for('core.admin.list_backup', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Sao lưu dữ liệu', route('core.admin.list_backup'));
});

Breadcrumbs::for('core.admin.list_role', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Vai trò', route('core.admin.list_role'));
});

Breadcrumbs::for('core.admin.add_role', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Thêm vai trò', route('core.admin.add_role'));
});

Breadcrumbs::for('core.admin.edit_role', function ($trail, $id) {
    $trail->parent('core.admin.list_role');
    $trail->push('Sửa vai trò #' . $id, route('core.admin.edit_role', $id));
});

Breadcrumbs::for('core.admin.list_permission', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Danh sách quyền hạn', route('core.admin.list_permission'));
});

Breadcrumbs::for('core.admin.list_widget', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Widget', route('core.admin.list_widget'));
});

Breadcrumbs::for('core.admin.addons', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Quản lý tiện ích', route('core.admin.addons'));
});

Breadcrumbs::for('core.admin.layouts', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Thiết lập layout', route('core.admin.layouts'));
});

Breadcrumbs::for('core.admin.list_email_templates', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Mẫu email', route('core.admin.list_email_templates'));
});

Breadcrumbs::for('core.admin.edit_email_template', function ($trail, $id) {
    $trail->parent('core.admin.list_email_templates');
    $trail->push('#' . $id, route('core.admin.edit_email_template', $id));
});

Breadcrumbs::for('system', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Quản trị hệ thống', 'javascript:;');
});
Breadcrumbs::for('core.admin.system_cache', function ($trail) {
    $trail->parent('system');
    $trail->push('Quản lý bộ nhớ đệm', route('core.admin.system_cache'));
});
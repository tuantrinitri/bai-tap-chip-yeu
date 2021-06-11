<?php

return [
    'site_name' => 'Trang tin điện tử, Hiệp hội cá ngừ Việt Nam',
    'admin_prefix' => 'admincp',
    'version' => '1.2.0',
    'system_modules' => [
        'web',
        'user',
        // 'widget',
        // 'menu',
        // 'page',
        'post',
        // 'link',
        'banner'
    ],
    'system_roles' => [
        'superadmin' => [
            'name' => 'superadmin',
            'title' => 'Super Admin',
            'description' => 'Quản trị toàn quyền hệ thống'
        ],
        'user' => [
            'name' => 'user',
            'title' => 'Tài khoản thông thường',
            'description' => 'Tài khoản người dùng thông thường'
        ],
    ],
    'thumbnail_folder' => 'thumb',
];
<?php

return [
    'site_name' => 'GDST',
    'admin_prefix' => 'admincp',
    'version' => '4.0',
    'system_modules' => [
        'web',
        'user',
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
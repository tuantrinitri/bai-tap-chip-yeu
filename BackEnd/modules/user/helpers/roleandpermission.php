<?php

use Modules\User\Models\User;
use Modules\User\Repositories\Interfaces\PermissionInterface;
use Modules\User\Repositories\Interfaces\UserInterface;

if (!function_exists('user_check_permission')) {
    function user_check_permission($permission, User $user = null): bool
    {
        if ($user === null) {
            $user = auth()->user();
        }
        if ($user->hasRole('superadmin')) {
            return true;
        }
        if (!is_array($permission)) {
            $permission = (array) $permission;
        }
        return $user->hasAnyPermission($permission);
    }
}

function mod_user_text_role($id)
{
    $user = app(UserInterface::class)->with('roles')->where('id', $id)->first();
    $txt_result = '<em class="text-warning">Chưa phân quyền</em>';
    if ($user) {
        if ($user->roles && count($user->roles)) {
            $txt_result = '';
            foreach ($user->roles as $role) {
                $txt_result .= '<strong>' . $role['title'] . '</strong>' . ', ';
            }
        }
    }
    return trim(trim($txt_result), ',');
}

function get_list_permissions()
{
    $permissions = [];
    $modulePermissions = app(PermissionInterface::class)->where('type', 'system')->get();
    if ($modulePermissions && count($modulePermissions) > 0) {
        $permissions[] = [
            'module' => 'System',
            'title' => 'Hệ thống',
            'icon' => 'fa fa-cogs',
            'permissions' => $modulePermissions
        ];
    }

    $modules = cms_actived_modules(false);
    foreach ($modules as $mod) {
        $modulePermissions = app(PermissionInterface::class)->where([
            ['type', '=', 'module'],
            ['module', '=', $mod['name']],
        ])->get();

        if ($modulePermissions && count($modulePermissions) > 0) {
            $permissions[] = [
                'module' => $mod['name'],
                'title' => $mod['title'],
                'icon' => config($mod['name'] . '::module.icon'),
                'permissions' => $modulePermissions
            ];
        }
    }

    return $permissions;
}

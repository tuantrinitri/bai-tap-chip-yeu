<?php

namespace Modules\User\Services;

use File;
use Modules\User\Repositories\Interfaces\PermissionInterface;

class SyncPermissionService
{
    protected $permissionRepository;

    function __construct(PermissionInterface $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    public function execute()
    {
        $new_permissions = [];
        $permissions = config('core::permissions');
        if ($permissions) {
            foreach ($permissions as $iPermission) {
                $permission = app(PermissionInterface::class)->where([
                    ['name', '=', $iPermission['name']],
                    ['type', '=', 'system'],
                    ['module', '=', 'system']
                ])->first();
                if (!$permission) {
                    $iPermission['module'] = 'system';
                    $iPermission['type'] = 'system';
                    $permission = app(PermissionInterface::class)->create($iPermission);
                }
                $new_permissions[] = $permission['id'];
            }
        }

        // // foreach active modules
        // //// get all module permissions
        // //// foreach permission of module
        // ////// if (permission_name not in DB) insert
        // /////// get id of permission => $new_permissions
        $modules = cms_actived_modules();
        foreach ($modules as $mod) {
            $permissions = config($mod . '::permissions');
            if ($permissions) {
                foreach ($permissions as $iPermission) {
                    $permission = app(PermissionInterface::class)->where([
                        ['name', '=', $iPermission['name']],
                        ['type', '=', 'module'],
                        ['module', '=', $mod]
                    ])->first();
                    if (!$permission) {
                        $iPermission['module'] = $mod;
                        $iPermission['type'] = 'module';
                        $permission = app(PermissionInterface::class)->create($iPermission);
                    }
                    $new_permissions[] = $permission['id'];
                }
            }
        }
        // get all permissions not in $new_permissions => remove
        app(PermissionInterface::class)->whereNotIn('id', $new_permissions)->delete();
    }
}
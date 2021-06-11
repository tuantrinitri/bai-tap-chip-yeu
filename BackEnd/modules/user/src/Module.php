<?php

namespace Modules\User;

use Illuminate\Support\Facades\Schema;

class Module
{
    public static function uninstall()
    {
        $tableNames = config('permission.table_names');
        Schema::drop($tableNames['role_has_permissions']);
        Schema::drop($tableNames['model_has_roles']);
        Schema::drop($tableNames['model_has_permissions']);
        Schema::drop($tableNames['roles']);
        Schema::drop($tableNames['permissions']);

        Schema::dropIfExists('user_departments');

        Schema::dropIfExists('user_infos');
        Schema::dropIfExists('users');

        Schema::dropIfExists('user_social');
    }
}
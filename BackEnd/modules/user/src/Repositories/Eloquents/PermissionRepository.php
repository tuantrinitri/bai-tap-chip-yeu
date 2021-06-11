<?php

namespace Modules\User\Repositories\Eloquents;

use Core\Supports\Repositories\Eloquents\BaseRepository;
use Modules\User\Models\Permission;
use Modules\User\Repositories\Interfaces\PermissionInterface;

class PermissionRepository extends BaseRepository implements PermissionInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return Permission::class;
    }
}

<?php

namespace Modules\User\Repositories\Eloquents;

use Core\Supports\Repositories\Eloquents\BaseRepository;
use Modules\User\Models\Department;
use Modules\User\Repositories\Interfaces\DepartmentInterface;

class DepartmentRepository extends BaseRepository implements DepartmentInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return Department::class;
    }
}

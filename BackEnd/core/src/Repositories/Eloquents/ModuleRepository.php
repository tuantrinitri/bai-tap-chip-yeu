<?php

namespace Core\Repositories\Eloquents;

use Core\Models\Module;
use Core\Repositories\Interfaces\ModuleInterface;
use Core\Supports\Repositories\Eloquents\BaseRepository;

class ModuleRepository extends BaseRepository implements ModuleInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return Module::class;
    }
}

<?php

namespace Core\Repositories\Eloquents;

use Core\Models\Migration;
use Core\Repositories\Interfaces\MigrationInterface;
use Core\Supports\Repositories\Eloquents\BaseRepository;

class MigrationRepository extends BaseRepository implements MigrationInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return Migration::class;
    }
}

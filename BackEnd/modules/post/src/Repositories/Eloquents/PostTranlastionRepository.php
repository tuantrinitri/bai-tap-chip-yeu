<?php

namespace Modules\Post\Repositories\Eloquents;

use Core\Supports\Repositories\Eloquents\BaseRepository;
use Modules\Post\Models\PostTranslation;
use Modules\Post\Repositories\Interfaces\PostTranlastionInterface;

class PostTranlastionRepository extends BaseRepository implements PostTranlastionInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return PostTranslation::class;
    }
}

<?php

namespace Modules\Post\Repositories\Eloquents;

use Core\Supports\Repositories\Eloquents\BaseRepository;
use Modules\Post\Models\CategoryTranslation;
use Modules\Post\Repositories\Interfaces\CategoryTranslationInterface;

class CategoryTranslationRepository extends BaseRepository implements CategoryTranslationInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return CategoryTranslation::class;
    }
}

<?php

namespace Modules\Post\Repositories\Interfaces;

use Core\Supports\Repositories\Interfaces\BaseInterface;
use Modules\Post\Http\Requests\CategoryRequest;

interface CategoryInterface extends BaseInterface
{
   public function createCategory($request);
}

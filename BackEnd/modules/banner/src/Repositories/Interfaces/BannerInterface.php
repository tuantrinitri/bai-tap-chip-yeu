<?php

namespace Modules\Banner\Repositories\Interfaces;

use Core\Supports\Repositories\Interfaces\BaseInterface;

interface BannerInterface extends BaseInterface
{
    public function store($request);
}

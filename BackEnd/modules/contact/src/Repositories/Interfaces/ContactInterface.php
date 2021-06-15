<?php

namespace Modules\Contact\Repositories\Interfaces;

use Core\Supports\Repositories\Interfaces\BaseInterface;

interface ContactInterface extends BaseInterface
{
    public function delAllContact();
}

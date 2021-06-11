<?php

namespace Modules\User\Repositories\Eloquents;

use Core\Supports\Repositories\Eloquents\BaseRepository;
use Modules\User\Models\User;
use Modules\User\Repositories\Interfaces\UserInterface;

class UserRepository extends BaseRepository implements UserInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return User::class;
    }
}

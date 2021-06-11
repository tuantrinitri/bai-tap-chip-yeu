<?php

namespace Modules\User\Repositories\Eloquents;

use Core\Supports\Repositories\Eloquents\BaseRepository;
use Modules\User\Models\UserSocial;
use Modules\User\Repositories\Interfaces\UserSocialInterface;

class UserSocialRepository extends BaseRepository implements UserSocialInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return UserSocial::class;
    }
}

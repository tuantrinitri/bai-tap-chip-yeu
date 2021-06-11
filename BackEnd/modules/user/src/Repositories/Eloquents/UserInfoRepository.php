<?php

namespace Modules\User\Repositories\Eloquents;

use Core\Supports\Repositories\Eloquents\BaseRepository;
use Modules\User\Models\UserInfo;
use Modules\User\Repositories\Interfaces\UserInfoInterface;

class UserInfoRepository extends BaseRepository implements UserInfoInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return UserInfo::class;
    }
}

<?php

namespace Core\Repositories\Eloquents;

use Core\Models\Setting;
use Core\Repositories\Interfaces\SettingInterface;
use Core\Supports\Repositories\Eloquents\BaseRepository;

class SettingRepository extends BaseRepository implements SettingInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return Setting::class;
    }

    public function getByName(string $name): string
    {
        return 'OK';
    }
}
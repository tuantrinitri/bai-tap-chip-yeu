<?php

namespace Core\Facades;

use Core\Supports\Setting;
use Illuminate\Support\Facades\Facade;

class SettingFacade extends Facade
{
    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor()
    {
        return Setting::class;
    }
}
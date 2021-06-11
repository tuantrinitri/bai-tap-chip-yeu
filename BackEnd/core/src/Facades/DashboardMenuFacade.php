<?php

namespace Core\Facades;

use Core\Supports\DashboardMenu;
use Illuminate\Support\Facades\Facade;

class DashboardMenuFacade extends Facade
{
    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor()
    {
        return DashboardMenu::class;
    }
}
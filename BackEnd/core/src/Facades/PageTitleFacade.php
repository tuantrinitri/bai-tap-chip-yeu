<?php

namespace Core\Facades;

use Core\Supports\PageTitle;
use Illuminate\Support\Facades\Facade;

class PageTitleFacade extends Facade
{
    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor()
    {
        return PageTitle::class;
    }
}
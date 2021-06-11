<?php

namespace Modules\User\Providers;

use Illuminate\Support\ServiceProvider;
use Eventy;
use Modules\User\Repositories\Interfaces\UserInterface;

class HookServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Eventy::addFilter(CORE_FILTER_APPEND_MENU_NAME, [$this, 'getCountUser'], 20, 1);
    }

    public function getCountUser($menuId, $number = null)
    {
        if ($menuId == 'mod-user' || $menuId == 'mod-user-list') {
            $numUsers = $this->app->make(UserInterface::class)->count();
            if ($numUsers > 0) {
                return '<span class="badge bg-success-400 align-self-center ml-auto">' . $numUsers . '</span>';
            }
        }
        return $number;
    }
}
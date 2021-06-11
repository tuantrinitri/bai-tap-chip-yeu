<?php

namespace Modules\Menu\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Modules\Menu\Models\MenuItem;

class MainMenu extends AbstractWidget
{
    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        app()->getLocale();
        $data['parents'] = MenuItem::where('menu_id', 1)->where('parent_id', 0)->where('status', 1)->get();
        return view('menu::widgets.main_menu', $data);
    }

    /**
     * config
     */
    public function config()
    {
        // return view('Dashboard::widgets.test_config')->render();
    }
}

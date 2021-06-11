<?php

namespace Modules\Menu;

use Illuminate\Support\Facades\Schema;

class Module
{
    public static function uninstall()
    {
        Schema::dropIfExists('menus');
        Schema::dropIfExists('menu_items');
        Schema::dropIfExists('menu_item_transtion');
    }
}

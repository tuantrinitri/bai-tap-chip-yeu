<?php

namespace Modules\Banner;

use Illuminate\Support\Facades\Schema;

class Module
{
    public static function uninstall()
    {
        Schema::dropIfExists('banners');
        Schema::dropIfExists('banner_widgets');
    }
}

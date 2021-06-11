<?php

namespace Modules\Widget;

use Illuminate\Support\Facades\Schema;

class Module
{
    public static function uninstall()
    {
        Schema::dropIfExists('widgets');
        Schema::dropIfExists('admin_widgets');
    }
}

<?php

namespace Modules\Post;

use Illuminate\Support\Facades\Schema;

class Module
{
    public static function uninstall()
    {
        Schema::dropIfExists('posts');
        Schema::dropIfExists('post_categories');
    }
}

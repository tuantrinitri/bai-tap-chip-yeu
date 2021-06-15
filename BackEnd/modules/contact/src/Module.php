<?php

namespace Modules\Contact;

use Illuminate\Support\Facades\Schema;

class Module
{
    public static function uninstall()
    {
        Schema::dropIfExists('contacts');
        Schema::dropIfExists('contact_topics');
    }
}

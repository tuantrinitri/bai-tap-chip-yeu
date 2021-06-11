<?php

namespace Modules\Widget\Models;

use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{
    protected $table = 'widgets';

    protected $fillable = [
        'module',
        'name',
        'title',
        'group',
        'status',
        'order',
        'config'
    ];
}

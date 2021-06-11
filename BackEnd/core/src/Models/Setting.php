<?php

namespace Core\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cms_settings';

    /**
     * @var array
     */
    protected $fillable = [
        'key',
        'value',
    ];

    public $timestamps = false;
}
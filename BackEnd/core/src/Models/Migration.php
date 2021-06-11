<?php

namespace Core\Models;

use Illuminate\Database\Eloquent\Model;

class Migration extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'migrations';

    /**
     * @var array
     */
    protected $fillable = [
        'migration',
        'batch'
    ];

    public $timestamps = false;
}
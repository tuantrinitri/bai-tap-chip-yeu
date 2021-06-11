<?php

namespace Modules\Banner\Models;

use Illuminate\Database\Eloquent\Model;

class BannerWidget extends Model
{
    protected $table = 'banner_widgets';

    protected $fillable = [
        'id',
        'title',
        'banner_id',
        'position'
    ];

    public function banner()
    {
        return $this->hasMany(Banner::class, 'banner_id');
    }
}

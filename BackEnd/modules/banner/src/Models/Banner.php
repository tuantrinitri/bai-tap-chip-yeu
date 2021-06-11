<?php

namespace Modules\Banner\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banners';

    protected $fillable = [
        'widget_id',
        'title',
        'file_src',
        'link',
        'begin_time',
        'expired_time',
        'description',
        'clicks',
        'order',
        'status',
    ];

    public function widget()
    {
        return  $this->belongsTo(BannerWidget::class, 'widget_id');
    }
}

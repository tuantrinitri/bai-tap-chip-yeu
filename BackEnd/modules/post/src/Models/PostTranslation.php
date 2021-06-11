<?php

namespace Modules\Post\Models;

use Illuminate\Database\Eloquent\Model;

class PostTranslation extends Model
{
    protected $table = 'post_translations';

    protected $fillable = [
        'id',
        'title',
        'content',
        'post_id',
        'locale',
        'description',
        'status'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class)->where('status', 1)->get();
    }
}

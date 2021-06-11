<?php

namespace Modules\Post\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'post_category_translations';

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'locale',
        'title',
        'description',
        'category_id'
    ];

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function post()
    {
        return $this->hasMany(PostTranslation::class, 'id');
    }
}

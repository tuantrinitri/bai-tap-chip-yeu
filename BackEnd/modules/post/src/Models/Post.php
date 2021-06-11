<?php

namespace Modules\Post\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Core\Traits\Filterable;

class Post extends Model implements TranslatableContract
{
    use Translatable;
    use Filterable;
    protected $table = 'posts';
    public $translatedAttributes = ['title', 'content', 'description'];
    protected $fillable = [
        'slug',
        'image',
        'source',
        'author',
        'featured',
        'created_by',
        'public_at',
        'tags',
        'totalhits',
        'status',
        'category_id',
    ];
    protected $filterable = [
        'title',
        'category_id',
    ];

    public function postTranlastion()
    {
        return $this->hasMany(PostTranslation::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}

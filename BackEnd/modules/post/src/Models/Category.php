<?php

namespace Modules\Post\Models;

use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Model;

class Category extends Model implements TranslatableContract
{
    use Translatable;
    protected $table = 'post_categories';
    public $translatedAttributes = ['title'];
    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'order',
        'parent_id',
        'image',
        'featured',
        'slug',
        'status'
    ];
    public function categoryTranstion()
    {
        return $this->hasMany(CategoryTranslation::class);
    }
    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id')->where('status', 1)->paginate(20);
    }
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
}

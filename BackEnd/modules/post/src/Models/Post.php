<?php

namespace Modules\Post\Models;

use Core\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Filterable;

    public $timestamps = true;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * @var array
     */
    protected $fillable = [
        'lang',
        'category_id',
        'title',
        'slug',
        'image',
        'description',
        'content',
        'source',
        'attachments',
        'tags',
        'author',
        'featured',
        'created_by',
        'public_at',
        'totalhits',
        'seo_title',
        'seo_image',
        'seo_keywords',
        'seo_description',
        'status'
    ];

    public $dates = ['created_at', 'updated_at', 'public_at', 'deleted_at'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function filterTitle($query, $value)
    {

        return $query->where('title', 'LIKE', '%' . $value . '%');
    }
    public function filterCategoryId($query, $value)
    {
        if ($value != -1) {
            return $query->where('category_id', $value);
        }
    }
    public function filterCreatedAt($query, $value)
    {
        if ($value) {
            $value = urldecode($value);
            $arr_time = explode(' - ', $value);
            $begintime = Carbon::createFromFormat('d/m/Y', $arr_time[0])->format('Y-m-d ');
            $endtime = Carbon::createFromFormat('d/m/Y', $arr_time[1])->format('Y-m-d');
            if ($endtime <  date("Y-m-d")) {
                return $query->where('posts.created_at', '>=', $begintime)->where('posts.created_at', '<=', $endtime);
            }
        }
    }

    public function getSearchResult(): SearchResult
    {
        $url = route('mod_post.web.detail_post', $this->slug);
        return new SearchResult(
            $this,
            $this->title,
            $url
        );
    }
}

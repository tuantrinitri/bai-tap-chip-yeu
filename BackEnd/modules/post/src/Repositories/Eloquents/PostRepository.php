<?php

namespace Modules\Post\Repositories\Eloquents;

use Core\Supports\Repositories\Eloquents\BaseRepository;
use Modules\Post\Models\Post;
use Modules\Post\Repositories\Interfaces\CategoryInterface;
use Modules\Post\Repositories\Interfaces\PostInterface;

class PostRepository extends BaseRepository implements PostInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return Post::class;
    }

    public function createPost($request)
    {
        return $this->create([
            'title' => $request->title,
            'slug' => empty($request->slug) ? str_slug($request->title) : $request->slug,
            'image' => $request->image,
            'description' => $request->description,
            'content' => $request->content,
            'source' => $request->source,
            'category_id' => $request->category_id,
            'author' => $request->author,
            'tags' => $request->tags,
            'featured' => $request->has('featured') ? 1 : 0,
            'created_by' => auth()->id(),
            'status' => $request->status
        ]);
    }
    public function updatePost($request)
    {
        return $this->update([
            'title' => $request->title,
            'slug' => empty($request->slug) ? str_slug($request->title) : $request->slug,
            'image' => $request->image,
            'description' => $request->description,
            'content' => $request->content,
            'source' => $request->source,
            'category_id' => $request->category_id,
            'author' => $request->author,
            'tags' => $request->tags,
            'featured' => $request->has('featured') ? 1 : 0,
            'created_by' => auth()->id(),
            'status' => $request->status
        ], $request->id);
    }
    public function posts($request)
    {
        $param = $request->all();
        $filterdata = $this->filter($param);
        $data['posts'] = $filterdata->orderBy('id', 'desc')->paginate(20)->appends(request()->except('page'));
        if (isset($param['created_at'])) {
            $arr_time = explode(' - ', $param['created_at']);
            $param['begindate'] = $arr_time[0];
            $param['enddate'] = $arr_time[1];
        }
        $data['param'] = $param;
        $data['categories'] = $this->categories();
        return $data;
    }
    public function categories($parent_id = 0, $prefix = '')
    {
        $list_category = app(CategoryInterface::class)->where('parent_id', $parent_id)->orderBy('order', 'asc')->get()->toArray();
        $result = [];
        foreach ($list_category as $iCategory) {
            $iCategory['prefix'] = $prefix;
            array_push($result, $iCategory);
            $result = array_merge($result, $this->categories($iCategory['id'], $prefix . '------ '));
        }
        return $result;
    }
}
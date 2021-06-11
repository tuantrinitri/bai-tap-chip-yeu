<?php

namespace Modules\Post\Repositories\Eloquents;

use Core\Supports\Repositories\Eloquents\BaseRepository;
use Illuminate\Support\Facades\DB;
use Modules\Post\Models\Category;
use Modules\Post\Models\Post;
use Modules\Post\Repositories\Interfaces\CategoryInterface;
use Modules\Post\Repositories\Interfaces\CategoryTranslationInterface;
use Modules\Post\Repositories\Interfaces\PostInterface;
use Modules\Post\Repositories\Interfaces\PostTranlastionInterface;

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

    public function index($request)
    {
        $param = $request->all();
        if (isset($param)) {
            $filterdata = $this->filter($param);
            $data['posts'] = $filterdata->with('postTranlastion')->orderBy('id', 'desc')->paginate(15)->appends(request()->except('page'));
            $data['param'] = $param;
        } else {
            $data['posts'] = $this->with('postTranlastion')->orderBy('id', 'desc')->paginate(15);
        }
        $data['categories'] = $this->categories();
        return $data;
    }

    public function store($request)
    {
        try {
            $data = $request->all();
            $oldPost = $this->where('slug', $data['slug'])->first();
            if ($oldPost) {
                app(PostTranlastionInterface::class)->create([
                    'title' => $data['title'],
                    'description' => $data['description'],
                    'post_id' => $oldPost['id'],
                    'content' => $data['content'],
                    'locale' => $data['locale']
                ]);
                return true;
            } else {
                DB::transaction(function () use ($data) {
                    $id_post = $this->create([
                        'slug' => empty($data['slug']) ? str_slug($data['title']) : $data['slug'],
                        'image' => $data['image'],
                        'source' => $data['source'],
                        'author' => $data['author'],
                        'tags' => $data['tags'],
                        'featured' => isset($data['featured']) ? 1 : 0,
                        'category_id' => $data['category_id'],
                        'created_by' => auth()->id(),
                        'status' => $data['status']
                    ])->id;
                    if ($id_post) {
                        app(PostTranlastionInterface::class)->create([
                            'title' => $data['title'],
                            'description' => $data['description'],
                            'content' => $data['content'],
                            'post_id' => $id_post,
                            'locale' => $data['locale'],
                        ]);
                    }
                });
                return true;
            }
        } catch (Throwable $th) {
            return $th;
        }
    }

    public function updatePost($request, $id)
    {
        try {
            DB::transaction(function () use ($request) {
                app(PostTranlastionInterface::class)->where('post_id', $request->id)->where('locale', $request->locale)->update([
                    'content' => $request->content,
                    'title' => $request->title,
                    'description' => $request->description,
                    'post_id' => $request->id,
                ]);
                $parentCategory = app(CategoryTranslationInterface::class)->where('id', $request->category_id)->first()['category_id'];
                $this->update([
                    'image' => $request->image,
                    'slug' => $request->slug,
                    'status' => $request->status,
                    'image' => $request->image,
                    'source' => $request->source,
                    'author' => $request->author,
                    'category_id' => $parentCategory,
                    'tags' => $request->tags,
                    'featured' => isset($request->featured) ? 1 : 0,
                ], $request->id);
            });
        } catch (Throwable $th) {
            return $th;
        }
    }

    public function categories($parent_id = 0, $prefix = '')
    {
        $categories = app(CategoryInterface::class)->where('parent_id', $parent_id)->orderBy('order', 'asc')->with('categoryTranstion')->get()->toArray();
        $result = [];
        foreach ($categories as $category) {
            $category['prefix'] = $prefix;
            array_push($result, $category);
            $result = array_merge($result, $this->categories($category['id'], $prefix . '------ '));
        }
        return $result;
    }
}

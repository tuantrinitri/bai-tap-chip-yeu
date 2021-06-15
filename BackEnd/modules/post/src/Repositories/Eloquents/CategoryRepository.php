<?php

namespace Modules\Post\Repositories\Eloquents;

use Core\Supports\Repositories\Eloquents\BaseRepository;
use Modules\Post\Models\Category;
use Modules\Post\Repositories\Interfaces\CategoryInterface;

class CategoryRepository extends BaseRepository implements CategoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return Category::class;
    }

    public function createNewCategory($request)
    {
        return $this->create([
            'title' => $request->title,
            'slug' => $request->slug,
            'parent_id' => $request->parent_id,
            'image' => $request->image,
            'description' => $request->description,
            'status' => $request->status
        ]);
    }
    public function updateCategory($request)
    {
        $id = $request->id;
        return $this->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'parent_id' => $request->parent_id,
            'image' => $request->image,
            'description' => $request->description,
            'status' => $request->status
        ], $id);
    }
    public function deleteAllCategory($id)
    {
        $category = app(CategoryInterface::class)->find($id);
        if ($category) {
            if ($category->children->count()) {
                $children_cat = $category->children;
                foreach ($children_cat as $childcat) {
                    deleteAllCategory($childcat['id']);
                }
            }
            if ($category->posts()->count()) {
                $posts = $category->posts;
                foreach ($posts as $post) {
                    $post->delete();
                }
            }
            $category->delete();
        }
        return true;
    }
}
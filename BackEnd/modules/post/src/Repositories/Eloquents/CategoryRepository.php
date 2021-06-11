<?php

namespace Modules\Post\Repositories\Eloquents;

use Core\Supports\Repositories\Eloquents\BaseRepository;
use Illuminate\Support\Facades\DB;
use Modules\Post\Models\Category;
use Modules\Post\Repositories\Interfaces\CategoryInterface;
use Modules\Post\Repositories\Interfaces\CategoryTranslationInterface;
use Modules\Post\Repositories\Interfaces\PostInterface;
use Modules\Post\Repositories\Interfaces\PostTranlastionInterface;

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

    public function createCategory($request)
    {
        try {
            $data = $request->all();
            $oldCategory = $this->where('slug', $data['slug'])->first();
            if ($oldCategory) {
                app(CategoryTranslationInterface::class)->create([
                    'title' => $data['title'],
                    'description' => $data['description'],
                    'category_id' => $oldCategory['id'],
                    'locale' => $data['locale']
                ]);
                return true;
            } else {
                DB::transaction(function () use ($data) {
                    $id_category = $this->create([
                        'image' => $data['image'],
                        'slug' => $data['slug'],
                        'parent_id' => $data['parent_id'],
                        'status' => $data['status'],
                        'image' => $data['image'],
                        'order' => $this->max('order') ? $this->max('order') + 1 : 1
                    ])->id;
                    if ($id_category) {
                        app(CategoryTranslationInterface::class)->create([
                            'title' => $data['title'],
                            'description' => $data['description'],
                            'category_id' => $id_category,
                            'locale' => $data['locale']
                        ]);
                    }
                });
                return true;
            }
        } catch (Throwable $th) {
            return $th;
        }
    }

    public function updateCategory($request)
    {

        try {
            DB::transaction(function () use ($request) {
                app(CategoryTranslationInterface::class)->where('category_id', $request->id)->where('locale', $request->locale)->update([
                    'title' => $request->title,
                    'description' => $request->description
                ]);
                $this->update([
                    'image' => $request->image,
                    'slug' => $request->slug,
                    'status' => $request->status,
                ], $request->id);
            });
        } catch (Throwable $th) {
            return $th;
        }
    }
    public function deleteAllCategory($id)
    {
        $deleteTranslation =  app(CategoryTranslationInterface::class)->find($id);
        $deletedParentCategory = $this->find($deleteTranslation['category_id']);
        $checkDelete = app(CategoryTranslationInterface::class)->where('category_id', $deleteTranslation['category_id'])->get()->count();
        if ($checkDelete == 2) {
            /**
             * check delete post 
             * @param checkDelete
             * param = 2 check post relation param 
             * @param checkDeletePost 
             */
            if ($deletedParentCategory->posts()->count()) {
                $posts = $deletedParentCategory->posts();
                foreach ($posts as $post) {
                    $checkDeletePost =  app(PostTranlastionInterface::class)->where('post_id', $post->id)->where('locale', $deleteTranslation['locale'])->count();
                    if ($checkDeletePost == 1) {
                        app(PostTranlastionInterface::class)->where('post_id', $post->id)->where('locale', $deleteTranslation['locale'])->delete();
                        app(PostInterface::class)->where('id', $post->id)->delete();
                    } else {
                        app(PostTranlastionInterface::class)->where('post_id', $post->id)->where('locale', $deleteTranslation['locale'])->delete();
                    }
                }
            }
            app(CategoryTranslationInterface::class)->delete($id);
        } else {
            if ($deletedParentCategory->posts()->count()) {
                $posts = $deletedParentCategory->posts();
                foreach ($posts as $post) {
                    $checkDeletePost =  app(PostTranlastionInterface::class)->where('post_id', $post->id)->where('locale', $deleteTranslation['locale'])->count();
                    if ($checkDeletePost == 1) {
                        app(PostTranlastionInterface::class)->where('post_id', $post->id)->where('locale', $deleteTranslation['locale'])->delete();
                        app(PostInterface::class)->where('id', $post->id)->delete();
                    } else {
                        app(PostTranlastionInterface::class)->where('post_id', $post->id)->where('locale', $deleteTranslation['locale'])->delete();
                    }
                }
            }
            app(CategoryTranslationInterface::class)->delete($id);
            $this->where('id', $deleteTranslation['category_id'])->delete();
        }
        return true;
    }
}

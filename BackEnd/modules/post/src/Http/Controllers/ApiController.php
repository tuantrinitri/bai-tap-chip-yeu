<?php

namespace Modules\Post\Http\Controllers;

use Core\Supports\Controllers\BaseController;
use Modules\Post\Models\Category;
use Modules\Post\Models\Post;

class ApiController extends BaseController
{
      public function post($slugPost)
      {
            try {
                  $post = Post::where('slug', $slugPost)->first();
                  return response()->json([
                        'status' => 200,
                        'message' => 'Lấy dữ liệu danh muc thanh cong',
                        'post' => $post
                  ], 200);
            } catch (Exception $e) {
                  return response()->json(['status' => 500, 'message' => 'Đã xảy ra lỗi'], 500);
            }
      }


      public function categories($slugCategories)
      {
            $category = Category::where('slug', $slugCategories)->first();
            // dd($category->posts);
            $posts = $category->posts;
            return response()->json([
                  'status' => 200,
                  'message' => 'Lấy dữ liệu danh muc thanh cong',
                  "posts" => $posts
            ], 200);
      }

      public function listCategory()
      {
            $category = Category::get();
            // dd($category->posts);
            // $posts = $category->posts;
            return response()->json([
                  'status' => 200,
                  'message' => 'Lấy dữ liệu danh muc thanh cong',
                  "categories" => $category
            ], 200);
      }

      public function randomFivePost($slug)
      {

            $category = Category::where('slug', $slug)->first();

            $posts = $category->posts->random(5);

            return $posts;
      }
}
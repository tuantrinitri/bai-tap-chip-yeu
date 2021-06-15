<?php

namespace Modules\Post\Http\Controllers;

use Core\Supports\Controllers\BaseController;
use Modules\Post\Models\Category;
use Modules\Post\Models\Post;

class ApiController extends BaseController
{
      public function categories()
      {
            try {
                  return Category::get();
            } catch (Exception $e) {
                  return response()->json(['status' => 500, 'message' => 'Đã xảy ra lỗi'], 500);
            }
      }

      public function post()
      {
            try {
                  return Post::get();
            } catch (Exception $e) {
                  return response()->json(['status' => 500, 'message' => 'Đã xảy ra lỗi'], 500);
            }
      }
}
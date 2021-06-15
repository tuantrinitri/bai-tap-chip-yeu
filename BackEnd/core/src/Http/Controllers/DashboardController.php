<?php

namespace Core\Http\Controllers;

use Core\Supports\Controllers\BaseController;
use Modules\Post\Models\Post;

class DashboardController extends BaseController
{
    public function index()
    {
        $data['numPost'] = Post::count();
        return view('core::dashboard.index', $data);
    }

    public function getChangeLang($lang)
    {
        if ($lang != false) {
            session(['admin-locale' => $lang]);
        }
        return redirect()->back();
    }

    public function slug()
    {
        return response()->json(str_slug(request()->plainText));
    }
}
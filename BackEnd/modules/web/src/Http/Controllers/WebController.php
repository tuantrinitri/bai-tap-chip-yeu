<?php

namespace Modules\Web\Http\Controllers;

use Core\Supports\Controllers\BaseController;
use File;

class WebController extends BaseController
{
    public static function index()
    {
        return redirect('login');
        // page_title()->setTitle('Trang chủ');
        // $images = File::allFiles(public_path('/upload/image-gallery'));
        // $videos = File::allFiles(public_path('/upload/video-gallery'));
        // return view('web::web.index', compact('images', 'videos'));
    }

    // public static function test()
    // {
    //     page_title()->setTitle('Trang chủ');
    //     $images = File::allFiles(public_path('/upload/image-gallery'));
    //     $videos = File::allFiles(public_path('/upload/video-gallery'));
    //     return view('web::web.test', compact('images', 'videos'));
    // }
}
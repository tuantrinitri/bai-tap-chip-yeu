<?php

namespace Core\Http\Controllers;

use Core\Supports\Controllers\BaseController;

class FileController extends BaseController
{
    public function getMain()
    {
        page_title()->setTitle(trans('core::common.file_management'));

        return view('core::file.main');
    }
}
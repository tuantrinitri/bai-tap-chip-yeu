<?php

namespace Core\Http\Controllers;

use Core\Supports\Controllers\BaseController;
use Modules\Web\Http\Controllers\WebController as ModuleWebController;

class WebController extends BaseController
{
    function __construct()
    {
        parent::__construct();
    }

    public function getIndex()
    {
        // if (module_check_active('web')) {
        //     return ModuleWebController::index();
        // }
        return redirect()->route('dashboard');
    }
}

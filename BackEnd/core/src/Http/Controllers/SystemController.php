<?php

namespace Core\Http\Controllers;

use Core\Console\Kernel;
use Core\Supports\Controllers\BaseController;
use Illuminate\Http\Request;

class SystemController extends BaseController
{
    public function getCache()
    {
        return view('core::system.cache');
    }

    public function postClearCache(Request $request, Kernel $kernel)
    {
        switch ($request->input('btn_clear_cache')) {
            case 'clear_all_cache':
                $kernel->call('cache:clear');
                break;
            case 'clear_view_cache':
                $kernel->call('view:clear');
                break;
            case 'clear_config_cache':
                $kernel->call('config:clear');
                break;
            case 'clear_route_cache':
                $kernel->call('route:clear');
                break;
        }

        return redirect()->route('core.admin.system_cache')->with('flash_data', ['type' => 'success', 'message' => 'Đã xóa bộ nhớ đệm']);
    }
}

<?php

namespace Modules\User\Http\Controllers;

use Core\Supports\Controllers\BaseController;
use Modules\User\Services\SyncPermissionService;

class PermissionController extends BaseController
{
    protected $syncPermissionService;

    function __construct(SyncPermissionService $syncPermissionService)
    {
        $this->syncPermissionService = $syncPermissionService;
    }

    public function getList()
    {
        return view('user::permission.list');
    }

    public function ajaxSyncPermissions()
    {
        try {
            $this->syncPermissionService->execute();
            return response()->json([
                'status' => true,
                'msg' => 'Đã đồng bộ tất cả quyền hạn',
                'html' => view('user::permission.sync')->render()
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'msg' => 'Đã xảy ra lỗi. Thử lại hoặc liên hệ với kỹ thuật viên.'
            ]);
        }
    }
}
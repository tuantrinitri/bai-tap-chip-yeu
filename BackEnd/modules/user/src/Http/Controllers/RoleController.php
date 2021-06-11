<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Core\Supports\Controllers\BaseController;
use Modules\User\Http\Requests\RoleRequest;
use Modules\User\Repositories\Interfaces\RoleInterface;
use Spatie\Permission\PermissionRegistrar;

class RoleController extends BaseController
{
    protected $roleRepository;

    function __construct(RoleInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function getListRole()
    {
        cms_fix_order_model(RoleInterface::class);
        $roles = $this->roleRepository->orderBy('order', 'asc')->get();
        $minOrder = $this->roleRepository->min('order');
        $maxOrder = $this->roleRepository->max('order');

        return view('user::role.list', compact('roles', 'minOrder', 'maxOrder'));
    }

    public function getAddRole()
    {
        return view('user::role.create');
    }

    public function postAddRole(RoleRequest $request)
    {
        $role = $this->roleRepository->create([
            'title' => $request->title,
            'name' => $request->name,
            'description' => $request->description,
            'order' => $this->roleRepository->max('order') + 1
        ]);

        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        } else {
            $role->syncPermissions(null);
        }

        app()->make(PermissionRegistrar::class)->forgetCachedPermissions();
        return redirect()->route('role.admin.list')->with('flash_data', ['type' => 'success', 'message' => trans('core::notification.create_success')]);
    }

    public function getEditRole($id)
    {
        $role = $this->roleRepository->find($id);
        $role['arr_permissions'] = $role->getPermissionNames()->toArray();
        return view('user::role.edit', compact('role'));
    }

    public function editRole($id, RoleRequest $request)
    {
        $role = $this->roleRepository->find($id);
        $role->update([
            'title' => $request->title,
            'name' => $request->name,
            'description' => $request->description
        ]);

        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        } else {
            $role->syncPermissions(null);
        }
        app()->make(PermissionRegistrar::class)->forgetCachedPermissions();
        return redirect()->route('role.admin.list')->with('flash_data', ['type' => 'success', 'message' => trans('core::notification.update_success')]);
    }

    public function deleteRole($id)
    {
        $role = $this->roleRepository->find($id);
        $role->syncPermissions(null);
        $role->delete();
        app()->make(PermissionRegistrar::class)->forgetCachedPermissions();
        return redirect()->route('role.admin.list')->with('flash_data', ['type' => 'success', 'message' => trans('core::notification.delete_success')]);
    }

    public function ajaxChangeOrdeRole(Request $request)
    {
        $this->roleRepository->updateOrder($request->id, $request->order);
        cms_fix_order_model(RoleInterface::class);
        cache()->flush();
        $request->session()->flash('flash_data', ['type' => 'success', 'message' => trans('core::notification.update_success')]);
        return response()->json([
            'status' => true,
            'message' => trans('core::notification.update_success')
        ]);
    }
}
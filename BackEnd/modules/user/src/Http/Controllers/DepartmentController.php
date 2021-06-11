<?php

namespace Modules\User\Http\Controllers;

use Core\Supports\Controllers\BaseController;
use Modules\User\Http\Requests\DepartmentRequest;
use Modules\User\Repositories\Interfaces\DepartmentInterface;

class DepartmentController extends BaseController
{
    protected $departmentRepository;

    function __construct(DepartmentInterface $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    public function getListDepartment()
    {
        page_title()->setTitle(trans('user::department.department_management'));

        $departments = $this->departmentRepository->orderBy('id', 'asc')->all();
        return view('user::department.list', compact('departments'));
    }

    public function getEditDepartment($id)
    {
        page_title()->setTitle(trans('user::department.edit_department') . ' #' . $id);

        $departments = $this->departmentRepository->orderBy('id', 'asc')->all();
        $current_department = $this->departmentRepository->find($id);
        return view('user::department.edit', compact('departments', 'current_department'));
    }

    public function getDeleteDepartment($id)
    {
        $this->departmentRepository->delete($id);
        return redirect()->route('department.admin.list')->with('flash_data', ['type' => 'success', 'message' => trans('core::notification.delete_success')]);
    }

    public function postAddDepartment(DepartmentRequest $request)
    {
        $this->departmentRepository->create([
            'name' => $request->name,
            'description' => $request->description
        ]);
        return redirect()->route('department.admin.list')->with('flash_data', ['type' => 'success', 'message' => trans('core::notification.create_success')]);
    }

    public function postEditDepartment($id, DepartmentRequest $request)
    {
        $this->departmentRepository->update([
            'name' => $request->name,
            'description' => $request->description
        ], $id);
        return redirect()->route('department.admin.list')->with('flash_data', ['type' => 'success', 'message' => trans('core::notification.update_success')]);
    }
}
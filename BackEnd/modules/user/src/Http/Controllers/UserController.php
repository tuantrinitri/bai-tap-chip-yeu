<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Core\Supports\Controllers\BaseController;
use Hash;
use Illuminate\Support\Facades\Mail;
use Modules\User\Http\Requests\BulkActionUserRequest;
use Modules\User\Models\User;
use Modules\User\Models\UserInfo;
use Modules\User\Repositories\Interfaces\DepartmentInterface;
use Modules\User\Repositories\Interfaces\RoleInterface;
use Modules\User\Repositories\Interfaces\UserInfoInterface;
use Modules\User\Repositories\Interfaces\UserInterface;
use Modules\User\Tables\UserTable;

class UserController extends BaseController
{
    /**
     * @var UserInterface
     */
    protected $userRepository;
    /**
     * @var UserInfoInterface
     */
    protected $userInfoRepository;
    /**
     * @var RoleInterface
     */
    protected $roleRepository;
    /**
     * @var DepartmentInterface
     */
    protected $departmentRepository;

    /**
     * UserController Constructor
     *
     * @param UserInterface $userRepository
     * @param UserInfoInterface $userInfoRepository
     * @param RoleInterface $roleRepository
     * @param DepartmentInterface $departmentRepository
     */
    function __construct(
        UserInterface $userRepository,
        UserInfoInterface $userInfoRepository,
        RoleInterface $roleRepository,
        DepartmentInterface $departmentRepository
    ) {
        $this->userRepository = $userRepository;
        $this->userInfoRepository = $userInfoRepository;
        $this->roleRepository = $roleRepository;
        $this->departmentRepository = $departmentRepository;
    }

    /**
     * Show list users
     *
     * @return void
     */
    public function getListUser(UserTable $dataTable)
    {
        page_title()->setTitle(trans('user::user.list_user'));
        return $dataTable->render('core::table.table');
    }

    public function getAddUser()
    {
        page_title()->setTitle(trans('user::user.create_user'));
        $roles = $this->roleRepository->allNotSuperadmin();
        $rolesWithPermissions = $this->roleRepository->allNotSuperadmin(true);
        $departments = $this->departmentRepository->orderBy('name', 'asc')->all();

        return view('user::admin.user.add', compact('roles', 'rolesWithPermissions', 'departments'));
    }

    /**
     * post add user
     */
    public function addUser(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:users,email|max:50',
            'password' => 'required',
            'repassword' => 'required|same:password',
            'display_name' => 'max:191',
            'info.fullname' => 'max:191',
            'info.phone' => 'nullable|numeric|max:999999999999999',
            'info.address' => 'max:191',
        ], [
            'email.required' => 'Chưa nhập email',
            'email.unique' => 'Email đã tồn tại',
            'email.max' => 'Email khoong vượt quá 50 ký tự',
            'password.required' => 'Chưa nhập mật khẩu',
            'repassword.required' => 'Chưa nhập lại mật khẩu',
            'repassword.same' => 'Hai mật khẩu không khớp',
            'display_name.max' => 'Tên hiển thị quá dài',
            'info.fullname.max' => 'Họ tên quá dài',
            'info.phone.numeric' => 'Điện thoại chỉ được nhập số',
            'info.phone.max' => 'Điện thoại quá dài',
            'info.address.max' => 'Địa chỉ quá dài',
        ]);

        // execute add to db
        $user = $this->userRepository->create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'display_name' => $request->display_name ? $request->display_name : $request->email,
            'status' => $request->status,
        ]);

        $new_user_info = $request->info;
        $new_user_info['user_id'] = $user['id'];
        $this->userInfoRepository->create($new_user_info);

        if ($request->has('is_superadmin')) {
            $user->assignRole('superadmin');
            $user->syncPermissions(null);
        } else {
            if ($request->has('roles') && $request->roles != null) {
                foreach ($request->roles as $iRole) {
                    // $role = $this->roleRepository->find($iRole);
                    $user->assignRole($iRole);
                }
            }
            if ($request->has('permissions') && $request->permissions != null) {
                foreach ($request->permissions as $iPermission) {
                    $user->givePermissionTo($iPermission);
                }
            }
        }

        if ($request->has('send_mail')) {
            // thực hiện gửi mail or add vào hàng đợi
            $data = [
                'email' => $request->email,
                'password' => $request->password,
                'mail_title' => 'Thông tin tài khoản mới'
            ];
            Mail::send('user::mail.new_user', $data, function ($message) use ($request) {
                $message->to($request->email, $request->display_name ? $request->display_name : $request->email)->subject('Thông tin tài khoản mới được tạo');
            });

            if (Mail::failures()) {
                return redirect()->route('user.admin.list')->with('flash_data', ['type' => 'warning', 'message' => 'Đã thêm tài khoản thành công. Nhưng chưa gửi được email.']);
            } else {
                return redirect()->route('user.admin.list')->with('flash_data', ['type' => 'success', 'message' => 'Đã thêm tài khoản và gửi email thành công']);
            }
        }
        return redirect()->route('user.admin.list')->with('flash_data', ['type' => 'success', 'message' => 'Đã thêm tài khoản thành công']);
    }

    /**
     * edit user
     */
    public function getEditUser($id)
    {
        $user = $this->userRepository->with('roles')->find($id);
        if ($user) {
            if (!$user->info) {
                UserInfo::create(['user_id' => $id]);
            }
            $arr_roles = [];
            foreach ($user->roles as $iRole) {
                $arr_roles[] = $iRole['id'];
            }
            $user['arr_roles'] = $arr_roles;
            $listPermissions = [];
            foreach ($user->permissions as $iPermission) {
                $listPermissions[] = $iPermission['name'];
            }
            $user['arr_permissions'] = $listPermissions;
            $data['user'] = $user;
            $data['page_title'] = 'Sửa tài khoản #' . $user['id'];

            $data['listRole'] = $this->roleRepository->where([
                ['name', '<>', 'superadmin']
            ])->orderBy('order', 'asc')->get();
            $listRoleWithPermissions = [];
            foreach ($data['listRole'] as $iRole) {
                foreach ($iRole->permissions as $iPermission) {
                    $listRoleWithPermissions[$iRole['id']][] = $iPermission['id'];
                }
            }
            $data['listRoleWithPermissions'] = json_encode($listRoleWithPermissions);
            $data['listDepartment'] = $this->departmentRepository->orderBy('name', 'asc')->all();
            return view('user::admin.user.edit', $data);
        }

        return redirect()->route('user.admin.list')->with('flash_data', ['type' => 'error', 'message' => 'Không tìm thấy tài khoản để sửa']);
    }

    /**
     * post edit user
     */
    public function editUser($id, Request $request)
    {
        $request->validate([
            'email' => 'required|unique:users,email,' . $id,
            'repassword' => 'same:password',
            'display_name' => 'max:191',
            'info.fullname' => 'max:191',
            'info.phone' => 'nullable|numeric|max:999999999999999',
            'info.address' => 'max:191',
        ], [
            'email.required' => 'Chưa nhập email',
            'email.unique' => 'Email đã tồn tại',
            'repassword.same' => 'Hai mật khẩu không khớp',
            'display_name.max' => 'Tên hiển thị quá dài',
            'info.fullname.max' => 'Họ tên quá dài',
            'info.phone.numeric' => 'Điện thoại chỉ được nhập số',
            'info.phone.max' => 'Điện thoại quá dài',
            'info.address.max' => 'Địa chỉ quá dài',
        ]);

        $data_update = [
            'email' => $request->email,
            'display_name' => $request->display_name ? $request->display_name : $request->email,
            'status' => auth()->id() == $id ? 1 : $request->status,
        ];

        if (!empty($request->password)) {
            $data_update['password'] = Hash::make($request->password);
        }

        $this->userRepository->update($data_update, $id);
        $user = $this->userRepository->find($id, ['id']);
        $this->userInfoRepository->where('user_id', $id)->update($request->info);
        if ($request->has('is_superadmin')) {
            $user->syncRoles(['superadmin']);
            $user->syncPermissions(null);
        } else {
            if ($request->has('roles') && $request->roles != null) {
                $tmpRoles = [];
                foreach ($request->roles as $iRole) {
                    $tmpRoles[] = intval($iRole);
                }
                $user->syncRoles($tmpRoles);
            } else {
                $user->syncRoles(null);
            }

            if ($request->has('permissions') && $request->permissions != null) {
                $user->syncPermissions($request->permissions);
            } else {
                $user->syncPermissions(null);
            }
        }

        if ($request->has('send_mail')) {
            // thực hiện gửi mail or add vào hàng đợi
            $data = [
                'email' => $request->email,
                'password' => $request->password,
                'mail_title' => 'Thông tin tài khoản mới'
            ];
            Mail::send('User::mail.newuser', $data, function ($message) use ($request) {
                $message->to($request->email, $request->display_name ? $request->display_name : $request->email)->subject('Thông tin tài khoản mới được tạo');
            });

            if (Mail::failures()) {
                return redirect()->route('user.admin.list')->with('flash_data', ['type' => 'warning', 'message' => 'Đã thêm tài khoản thành công. Nhưng chưa gửi được email.']);
            } else {
                return redirect()->route('user.admin.list')->with('flash_data', ['type' => 'success', 'message' => 'Đã thêm tài khoản và gửi email thành công']);
            }
        }
        return redirect()->route('user.admin.list')->with('flash_data', ['type' => 'success', 'message' => 'Cập nhật thông tin tài khoản thành công']);
    }

    /**
     * delete user
     */
    public function deleteUser(Request $request, $id)
    {
        try {
            if (auth()->id() == $id) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Không thể xóa tài khoản của chính mình'
                    ]);
                }
                return redirect()->route('user.admin.list')->with('flash_data', ['type' => 'error', 'message' => 'Không thể xóa tài khoản của chính mình']);
            }

            $user = $this->userRepository->find($id);
            if ($user) {
                $user->syncPermissions(null);
                $user->syncRoles(null);
                $user->info->delete();
                $user->delete();
            }

            if ($request->expectsJson()) {
                return response()->json([
                    'status' => true,
                    'message' => trans('core::notification.delete_success')
                ]);
            }
            return redirect()->route('user.admin.list')->with('flash_data', ['type' => 'success', 'message' => trans('core::notification.delete_success')]);
        } catch (\Throwable $th) {
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => false,
                    'message' => trans('core::notification.action_error')
                ]);
            }
            return redirect()->route('user.admin.list')->with('flash_data', ['type' => 'error', 'message' => trans('core::notification.action_error')]);
        }
    }

    public function status(Request $request)
    {
        try {
            if (auth()->id() == $request->id) {
                return response()->json(['status' => false, 'msg' => 'Không thể cập nhật trạng thái của chính mình']);
            }
            $user  = $this->userRepository->find($request->id);
            if ($user->hasRole('superadmin') && !auth()->user()->hasRole('superadmin')) {
                return response()->json(['status' => false, 'msg' => 'Không thể cập nhật trạng thái của Super Admin']);
            } else {
                $this->userRepository->update([
                    'status' => $request->status,
                ], $request->id);
            }
            return response()->json(['status' => true, 'msg' => 'Đã cập nhật trạng thái']);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'msg' => 'Đã có lỗi xảy ra']);
        }
    }

    public function bulkAction(BulkActionUserRequest $request)
    {
        $action = $request->action;
        $ids = $request->ids;

        switch ($action) {
            case 'activate':
                foreach ($ids as $id) {
                    $this->userRepository->update([
                        'status' => 1
                    ], $id);
                }
                break;

            case 'deactivate':
                foreach ($ids as $id) {
                    $user = $this->userRepository->find($id);
                    if (auth()->id() != $id) {
                        if ($user->hasRole('superadmin')) {
                            if (auth()->user()->hasRole('superadmin')) {
                                $this->userRepository->update([
                                    'status' => 0
                                ], $id);
                            }
                        } else {
                            $this->userRepository->update([
                                'status' => 0
                            ], $id);
                        }
                    }
                }
                break;

            case 'delete':
                foreach ($ids as $id) {
                    $user = $this->userRepository->find($id);
                    if (auth()->id() != $id) {
                        if ($user->hasRole('superadmin')) {
                            if (auth()->user()->hasRole('superadmin')) {
                                $this->userRepository->delete($id);
                            }
                        } else {
                            $this->userRepository->delete($id);
                        }
                    }
                }
                return redirect()->route('user.admin.list')->with('flash_data', ['type' => 'success', 'message' => trans('core::notification.delete_success')]);
                break;

            default:
                # code...
                break;
        }

        return redirect()->route('user.admin.list')->with('flash_data', ['type' => 'success', 'message' => trans('core::notification.update_success')]);
    }


    /**
     * getProfile
     * Show page for staff can update their profile
     */
    public function getEditProfile()
    {
        // dd($this->userRepository->test());
        $user = $this->userRepository->with('roles')->findWhere([
            'id' => auth()->id()
        ])->first();
        if ($user) {
            if (!$user->info) {
                $this->userInfoRepository->create([
                    'user_id' => auth()->id()
                ]);
            }
            $page_title = trans('user::admin.account_info');

            return view('user::admin.profile', compact('user', 'page_title'));
        }
        return redirect()->route('dashboard');
    }

    public function postEditProfile(Request $request)
    {
        $id = auth()->id();
        if (!is_null($request->info['phone'])) {
            $request->validate([
                'email' => 'required|unique:users,email,' . $id,
                'display_name' => 'max:191',
                'info.fullname' => 'max:191',
                "info.phone" => "max:10|regex:/(^([0-9]+)?$)/",
                'info.address' => 'max:191',
                'repassword' => 'same:password'
            ], [
                'email.required' => 'Chưa nhập email',
                'email.unique' => 'Email đã tồn tại',
                'display_name.max' => 'Tên hiển thị quá dài',
                'info.fullname.max' => 'Họ tên quá dài',
                'info.phone.max' => 'Số điện thoại không vượt quá 10 số',
                'info.phone.regex' => 'Số điện thoại không hợp lệ',
                'info.address.max' => 'Địa chỉ quá dài',
                'repassword.same' => 'Hai mật khẩu không khớp'
            ]);
        } else {
            $request->validate([
                'email' => 'required|unique:users,email,' . $id,
                'display_name' => 'max:191',
                'info.fullname' => 'max:191',
                'info.address' => 'max:191',
                'repassword' => 'same:password'
            ], [
                'email.required' => 'Chưa nhập email',
                'email.unique' => 'Email đã tồn tại',
                'display_name.max' => 'Tên hiển thị quá dài',
                'info.fullname.max' => 'Họ tên quá dài',
                'info.address.max' => 'Địa chỉ quá dài',
                'repassword.same' => 'Hai mật khẩu không khớp'
            ]);
        }
        if ($request->old_password) {
            if (!Hash::check($request->old_password, auth()->user()->password)) {
                return redirect()->route('user.admin.profile')->withInput()->withErrors('Mật khẩu cũ không đúng');
            }
        }

        $data_update = [
            'email' => $request->email,
            'display_name' => $request->display_name ? $request->display_name : $request->email,
            'status' => auth()->id() == $id ? 1 : $request->status,
        ];

        if (!empty($request->password)) {
            $data_update['password'] = Hash::make($request->password);
        }

        User::where('id', $id)->update($data_update);
        UserInfo::where('user_id', $id)->update($request->info);
        return redirect()->route('user.admin.profile')->with('flash_data', ['type' => 'success', 'message' => 'Cập nhật thông tin tài khoản thành công']);
    }
}

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


    /**
     * UserController Constructor
     *
     * @param UserInterface $userRepository
     * @param UserInfoInterface $userInfoRepository
     * @param RoleInterface $roleRepository
     * 
     */
    function __construct(
        UserInterface $userRepository,
        UserInfoInterface $userInfoRepository,
        RoleInterface $roleRepository
    ) {
        $this->userRepository = $userRepository;
        $this->userInfoRepository = $userInfoRepository;
        $this->roleRepository = $roleRepository;
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


        return view('user::admin.user.add', compact('roles', 'rolesWithPermissions'));
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
            'email.required' => 'Ch??a nh???p email',
            'email.unique' => 'Email ???? t???n t???i',
            'email.max' => 'Email khoong v?????t qu?? 50 k?? t???',
            'password.required' => 'Ch??a nh???p m???t kh???u',
            'repassword.required' => 'Ch??a nh???p l???i m???t kh???u',
            'repassword.same' => 'Hai m???t kh???u kh??ng kh???p',
            'display_name.max' => 'T??n hi???n th??? qu?? d??i',
            'info.fullname.max' => 'H??? t??n qu?? d??i',
            'info.phone.numeric' => '??i???n tho???i ch??? ???????c nh???p s???',
            'info.phone.max' => '??i???n tho???i qu?? d??i',
            'info.address.max' => '?????a ch??? qu?? d??i',
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
            // th???c hi???n g???i mail or add v??o h??ng ?????i
            $data = [
                'email' => $request->email,
                'password' => $request->password,
                'mail_title' => 'Th??ng tin t??i kho???n m???i'
            ];
            Mail::send('user::mail.new_user', $data, function ($message) use ($request) {
                $message->to($request->email, $request->display_name ? $request->display_name : $request->email)->subject('Th??ng tin t??i kho???n m???i ???????c t???o');
            });

            if (Mail::failures()) {
                return redirect()->route('user.admin.list')->with('flash_data', ['type' => 'warning', 'message' => '???? th??m t??i kho???n th??nh c??ng. Nh??ng ch??a g???i ???????c email.']);
            } else {
                return redirect()->route('user.admin.list')->with('flash_data', ['type' => 'success', 'message' => '???? th??m t??i kho???n v?? g???i email th??nh c??ng']);
            }
        }
        return redirect()->route('user.admin.list')->with('flash_data', ['type' => 'success', 'message' => '???? th??m t??i kho???n th??nh c??ng']);
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
            $data['page_title'] = 'S???a t??i kho???n #' . $user['id'];

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

            return view('user::admin.user.edit', $data);
        }

        return redirect()->route('user.admin.list')->with('flash_data', ['type' => 'error', 'message' => 'Kh??ng t??m th???y t??i kho???n ????? s???a']);
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
            'email.required' => 'Ch??a nh???p email',
            'email.unique' => 'Email ???? t???n t???i',
            'repassword.same' => 'Hai m???t kh???u kh??ng kh???p',
            'display_name.max' => 'T??n hi???n th??? qu?? d??i',
            'info.fullname.max' => 'H??? t??n qu?? d??i',
            'info.phone.numeric' => '??i???n tho???i ch??? ???????c nh???p s???',
            'info.phone.max' => '??i???n tho???i qu?? d??i',
            'info.address.max' => '?????a ch??? qu?? d??i',
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
            // th???c hi???n g???i mail or add v??o h??ng ?????i
            $data = [
                'email' => $request->email,
                'password' => $request->password,
                'mail_title' => 'Th??ng tin t??i kho???n m???i'
            ];
            Mail::send('User::mail.newuser', $data, function ($message) use ($request) {
                $message->to($request->email, $request->display_name ? $request->display_name : $request->email)->subject('Th??ng tin t??i kho???n m???i ???????c t???o');
            });

            if (Mail::failures()) {
                return redirect()->route('user.admin.list')->with('flash_data', ['type' => 'warning', 'message' => '???? th??m t??i kho???n th??nh c??ng. Nh??ng ch??a g???i ???????c email.']);
            } else {
                return redirect()->route('user.admin.list')->with('flash_data', ['type' => 'success', 'message' => '???? th??m t??i kho???n v?? g???i email th??nh c??ng']);
            }
        }
        return redirect()->route('user.admin.list')->with('flash_data', ['type' => 'success', 'message' => 'C???p nh???t th??ng tin t??i kho???n th??nh c??ng']);
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
                        'message' => 'Kh??ng th??? x??a t??i kho???n c???a ch??nh m??nh'
                    ]);
                }
                return redirect()->route('user.admin.list')->with('flash_data', ['type' => 'error', 'message' => 'Kh??ng th??? x??a t??i kho???n c???a ch??nh m??nh']);
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
                return response()->json(['status' => false, 'msg' => 'Kh??ng th??? c???p nh???t tr???ng th??i c???a ch??nh m??nh']);
            }
            $user  = $this->userRepository->find($request->id);
            if ($user->hasRole('superadmin') && !auth()->user()->hasRole('superadmin')) {
                return response()->json(['status' => false, 'msg' => 'Kh??ng th??? c???p nh???t tr???ng th??i c???a Super Admin']);
            } else {
                $this->userRepository->update([
                    'status' => $request->status,
                ], $request->id);
            }
            return response()->json(['status' => true, 'msg' => '???? c???p nh???t tr???ng th??i']);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'msg' => '???? c?? l???i x???y ra']);
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
                'email.required' => 'Ch??a nh???p email',
                'email.unique' => 'Email ???? t???n t???i',
                'display_name.max' => 'T??n hi???n th??? qu?? d??i',
                'info.fullname.max' => 'H??? t??n qu?? d??i',
                'info.phone.max' => 'S??? ??i???n tho???i kh??ng v?????t qu?? 10 s???',
                'info.phone.regex' => 'S??? ??i???n tho???i kh??ng h???p l???',
                'info.address.max' => '?????a ch??? qu?? d??i',
                'repassword.same' => 'Hai m???t kh???u kh??ng kh???p'
            ]);
        } else {
            $request->validate([
                'email' => 'required|unique:users,email,' . $id,
                'display_name' => 'max:191',
                'info.fullname' => 'max:191',
                'info.address' => 'max:191',
                'repassword' => 'same:password'
            ], [
                'email.required' => 'Ch??a nh???p email',
                'email.unique' => 'Email ???? t???n t???i',
                'display_name.max' => 'T??n hi???n th??? qu?? d??i',
                'info.fullname.max' => 'H??? t??n qu?? d??i',
                'info.address.max' => '?????a ch??? qu?? d??i',
                'repassword.same' => 'Hai m???t kh???u kh??ng kh???p'
            ]);
        }
        if ($request->old_password) {
            if (!Hash::check($request->old_password, auth()->user()->password)) {
                return redirect()->route('user.admin.profile')->withInput()->withErrors('M???t kh???u c?? kh??ng ????ng');
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
        return redirect()->route('user.admin.profile')->with('flash_data', ['type' => 'success', 'message' => 'C???p nh???t th??ng tin t??i kho???n th??nh c??ng']);
    }
}
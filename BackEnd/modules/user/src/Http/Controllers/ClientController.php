<?php

namespace Modules\User\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Modules\User\Models\User;
use Modules\User\Models\Userinfo;
use Core\Controllers\WebController as SystemWebController;

class ClientController extends SystemWebController
{
    public function getMyAccount()
    {
        $page_title = 'Thông tin tài khoản';
        $user = auth('web')->user();
        return view('User::client.my_accounts', compact('user', 'page_title'));
    }

    public function postMyAccount(Request $request)
    {
        $id = auth('web')->id();
        $data_update = [
            'display_name' => $request->display_name ? $request->display_name : $request->email,
        ];

        User::where('id', $id)->update($data_update);
        $user = User::find($id, ['id']);
        Userinfo::where('user_id', $id)->update($request->info);

        return redirect()->route('client.my_account')->with('flash_data', ['type' => 'success', 'message' => 'Cập nhật thông tin tài khoản thành công']);
    }

    public function getChangePassword()
    {
        $data['page_title'] = 'Thay đổi mật khẩu';
        return view('User::client.change_password', $data);
    }

    public function postChangePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required',
            'repassword' => 'required|same:password'
        ], [
            'old_password.required' => 'Chưa nhập mật khẩu cũ',
            'password.required' => 'Chưa nhập mật khẩu mới',
            'repassword.required' => 'Chưa nhập lại mật khẩu mới',
            'repassword.same' => 'Hai mật khẩu không khớp'
        ]);

        if (!Hash::check($request->old_password, auth('web')->user()->password)) {
            return redirect()->route('client.change_password')->withErrors('Mật khẩu cũ không đúng');
        }

        User::where('id', auth('web')->id())->update(['password' => Hash::make($request->password)]);

        auth('web')->logout();
        session()->flush();

        return redirect()->route('login')->with('flash_data', ['type' => 'success', 'message' => 'Mật khẩu đã được thay đổi thành công. Hãy đăng nhập bằng mật khẩu mới!']);
    }
}

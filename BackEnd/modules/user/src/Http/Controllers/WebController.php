<?php

namespace Modules\User\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Modules\User\Models\User;
use Modules\User\Models\Userinfo;
use Core\Controllers\WebController as SystemWebController;
use Core\Models\Role;
use Mail;

class WebController extends SystemWebController
{
    public function getLogin(Request $request)
    {
        if (auth('web')->check()) {
            $redirect_to = !empty($request->input('redirect_to')) ? base64_decode($request->redirect_to) : route('client.index');
            return redirect()->to($redirect_to);
        }
        return view('User::web.login');
    }

    public function postLogin(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Chưa nhập email',
            'password.required' => 'Chưa nhập mật khẩu'
        ]);

        if ($validation->fails()) {
            return response()->json(['status' => false, 'message' => 'Vui lòng nhập đầy đủ thông tin']);
        }

        $is_remember = $request->has('is_remember') ? true : false;

        if (auth('web')->attempt(['email' => $request->email, 'password' => $request->password], $is_remember)) {
            if (auth('web')->user()->status == 0) {
                auth('web')->logout();
                session()->flush();
                return response()->json(['status' => false, 'message' => 'Tài khoản của bạn đang bị khóa']);
            } else {
                $redirect_to = ($request->has('redirect_to') && !empty($request->redirect_to)) ? base64_decode($request->redirect_to) : route('client.index');
                return response()->json(['status' => true, 'message' => 'Đăng nhập thành công', 'redirect_to' => $redirect_to]);
            }
        } else {
            return response()->json(['status' => false, 'message' => 'Thông tin đăng nhập không chính xác']);
        }
    }

    public function getLogout()
    {
        if (auth('web')->check()) {
            auth('web')->logout();
            session()->flush();
        }
        return redirect()->back();
    }

    public function getRegister()
    {
        return view('User::web.register');
    }

    public function postRegister(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'fullname' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'password' => 'required',
            'repassword' => 'required|same:password'
        ]);

        if ($validation->fails()) {
            return response()->json(['status' => false, 'message' => 'Thông tin không hợp lệ, vui lòng kiểm tra lại.']);
        }

        if (User::where('email', $request->email)->count()) {
            return response()->json(['status' => false, 'message' => 'Email đã được sử dụng, vui lòng chọn email khác.']);
        }

        try {
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'display_name' => $request->fullname
            ]);

            $new_user_info['user_id'] = $user['id'];
            $new_user_info['fullname'] = $request->fullname;
            $new_user_info['phone'] = $request->phone;
            Userinfo::create($new_user_info);

            // // check role
            if (Role::where('name', 'customer')->count() == 0) {
                Role::create([
                    'title' => 'Khách hàng',
                    'name' => 'customer',
                    'description' => 'Tài khoản dành cho khách hàng',
                    'order' => Role::max('order') + 1
                ]);
            }
            $user->assignRole('customer');

            if (Role::where('name', 'applicant')->count() == 0) {
                Role::create([
                    'title' => 'Ứng viên',
                    'name' => 'applicant',
                    'description' => 'Tài khoản của ứng viên xin việc',
                    'order' => Role::max('order') + 1
                ]);
            }
            $user->assignRole('applicant');

            $redirect_to = ($request->has('redirect_to') && !empty($request->redirect_to)) ? base64_decode($request->redirect_to) : route('login');
            return response()->json(['status' => true, 'message' => 'Đăng ký thành công', 'redirect_to' => $redirect_to]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Đã xảy ra lỗi, vui lòng thử lại.']);
        }
    }

    public function getForgotPass()
    {
        return view('User::web.forgot_password');
    }

    public function postForgotPass(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $active_code = rand(100000, 999999);
            $user->fill(['forgotpasskey' => $active_code])->update();
            $data = [
                'active_code' => $active_code,
                'email' => $user['email'],
                'mail_title' => 'Yêu cầu lấy lại mật khẩu',
            ];

            Mail::send('User::mail.forgotpass', $data, function ($message) use ($user) {
                $message->to($user['email'], $user['display_name'])->subject('Yêu cầu lấy lại mật khẩu');
            });

            if (Mail::failures()) {
                return redirect()->route('forgot_password')->withErrors('Xảy ra lỗi khi gửi mail, vui lòng thử lại');
            } else {
                return redirect()->route('forgot_password')->with('flash_data', ['type' => 'success', 'message' => 'Gửi yêu cầu thành công, vui lòng kiểm tra email']);
            }
        } else {
            return redirect()->route('forgot_password')->withErrors('Không tìm thấy tài khoản');
        }
    }

    public function getResetPass()
    {
        if (auth('web')->check()) {
            return redirect()->route('client.index');
        }
        return view('User::web.reset_pass');
    }

    public function postResetPass(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'code' => 'required',
            'password' => 'required',
            'repassword' => 'required|same:password'
        ], [
            'email.required' => 'Vui lòng nhập username hoặc email',
            'code.required' => 'Vui lòng nhập mã CODE',
            'password.required' => 'Chưa nhập mật khẩu mới',
            'repassword.required' => 'Chưa nhập lại mật khẩu mới',
            'repassword.same' => 'Hai mật khẩu không trùng nhau'
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user) {
            if ($user['forgotpasskey'] == $request->code) {
                $user->fill(['password' => Hash::make($request->password), 'forgotpasskey' => null])->update();
                return redirect()->route('login')->with('flash_data', ['type' => 'success', 'message' => 'Đặt lại mật khẩu thành công, bạn có thể đăng nhập bằng mật khẩu mới']);
            } else {
                return redirect()->route('reset_password')->withInput()->withErrors('Mã CODE bạn nhập không đúng, kiểm tra lại');
            }
        }
        return redirect()->route('reset_password')->withInput()->withErrors('Không tìm thấy tài khoản với thông tin bạn nhập');
    }
}

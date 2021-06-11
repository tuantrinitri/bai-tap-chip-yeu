<?php

namespace Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Core\Supports\Controllers\BaseController;

class SettingController extends BaseController
{
    public function getSetting()
    {
        return view('core::setting.setting');
    }

    public function postSetting(Request $request)
    {
        $data = $request->except(['_token', 'test_email']);
        foreach ($data as $config_name => $config_value) {
            setting()->set($config_name, $config_value);
        }
        cache()->flush();
        // Log
        activity('setting')
            ->causedBy(auth()->user())
            ->withProperties($data)
            ->log('Cập nhật thông tin website');
        return redirect()->route('core.admin.setting')->with('flash_data', ['type' => 'success', 'message' => 'Đã cập nhật thông tin cấu hình']);
    }

    public function ajaxTestConfigMail(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'mail.host' => 'required',
            'mail.port' => 'required',
            'mail.username' => 'required',
            'mail.password' => 'required',
            'mail.from.name' => 'required',
            'mail.from.address' => 'required',
            'test_email' => 'required',
        ], [
            'mail.host.required' => 'Chưa nhập máy chủ mail',
            'mail.port.required' => 'Chưa nhập cổng gửi mail',
            'mail.username.required' => 'Chưa nhập tài khoản',
            'mail.password.required' => 'Chưa nhập mật khẩu',
            'mail.from.name.required' => 'Chưa nhập đầy đủ định danh người gửi',
            'mail.from.address.required' => 'Chưa nhập đầy đủ định danh người gửi',
            'test_email.required' => 'Chưa nhập địa chỉ mail nhận tin',
        ]);

        if ($validation->fails()) {
            return response()->json(['status' => false, 'message' => $validation->messages()->first()]);
        }
        $mail_config = $request->mail;
        config([
            'mail.driver' => 'smtp',
            'mail.host' => $mail_config['host'],
            'mail.port' => $mail_config['port'],
            'mail.encryption' => $mail_config['encryption'],
            'mail.username' => $mail_config['username'],
            'mail.password' => $mail_config['password'],
            'mail.from.address' => $mail_config['from']['address'],
            'mail.from.name' => $mail_config['from']['name'],
        ]);

        try {
            Mail::send('core::mail.test_config_mail', [], function ($message) use ($request) {
                $message->to($request->test_email, $request->test_email)->subject('Kiểm tra cấu hình gửi mail');
            });
            if (Mail::failures()) {
                return response()->json(['status' => false, 'message' => 'Gửi không thành công, vui lòng kiểm tra lại thông tin cấu hình.']);
            } else {
                return response()->json(['status' => true, 'message' => 'Đã gửi thư thành công, bạn có thể sử dụng thông tin này để lưu cấu hình.']);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Gửi không thành công, vui lòng kiểm tra lại thông tin cấu hình.']);
        }
    }
}
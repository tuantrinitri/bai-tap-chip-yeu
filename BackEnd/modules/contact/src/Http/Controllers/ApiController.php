<?php

namespace Modules\Contact\Http\Controllers;

use Core\Supports\Controllers\BaseController;
use Illuminate\Http\Request;
use Modules\Contact\Jobs\SendMailNewContact;
use Modules\Contact\Models\Contact;

class ApiController extends BaseController
{
    /**
     * function Lien Hệ
     * Nhận thông tin từ angular lưu vào table contact băng phuong pháp post
     */
    public function postSendmail(Request $request)
    {

        try {
            $contact = Contact::create([
                'title' => $request->title,
                'sender_name' => $request->sender_name,
                'sender_email' => $request->sender_email,
                'sender_content' => $request->sender_content,
                'sender_phone' => $request->sender_phone
            ]);

            dispatch(new SendMailNewContact($contact));

            return response()->json([
                'status' => 200,
                'message' => 'Đã gửi thành công'
            ], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => 'Đã xảy ra lỗi'], 500);
        }
    }
}
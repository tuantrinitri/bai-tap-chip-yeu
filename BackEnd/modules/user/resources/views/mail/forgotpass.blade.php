@extends('mail.layout')

@section('mail_title', $mail_title)

@section('mail_content')
<p>
    <p>
        Chúng tôi vừa nhận được yêu cầu đặt lại mật khẩu của bạn trên hệ thống EMC.
        <br>
        Nhấp vào liên kết sau và nhập mã CODE để đặt lại mật khẩu mới.
    </p>
    <p>
        <a href="{{ route('reset_password', ['email' => $email, 'code' => $active_code]) }}" target="_blank">{{ route('reset_password', ['email' => $email, 'code' => $active_code]) }}</a>
    </p>
    <p>
        Mã CODE <span style="padding: 10px 20px;font-weight: 900;font-size: 2rem;background: #f0f0f0;border-radius: 5px;">{{ $active_code }}</span>
    </p>
</p>
@endsection

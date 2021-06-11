@extends('Client::layouts.default')
@section('page_content')
<main id="main">
    <div id="content" role="main" class="content-area">
        <div class="container">
            <div class="info-account">
                <section id="my-account">
                    <h3 class="title">Thông tin tài khoản</h3>
                    <form method="post" action="{{ route('client.post_my_account') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" readonly="readonly" name="email" placeholder="Nhập email" value="{{ old('email', $user['email']) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Tên hiển thị</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="display_name" placeholder="Nhập tên hiển thị" value="{{ old('display_name', $user['display_name']) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Họ tên</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="info[fullname]" placeholder="Nhập họ tên" value="{{ old('info.fullname', $user->info['fullname']) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Điện thoại</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="info[phone]" placeholder="Nhập điện thoại" value="{{ old('info.phone', $user->info['phone']) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Tên doanh nghiệp</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="info[company]" placeholder="Nhập tên doanh nghiệp" value="{{ old('info.company', $user->info['company']) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Mã số thuế</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="info[tax_number]" placeholder="Nhập mã số thuế" value="{{ old('info.tax_number', $user->info['tax_number']) }}">
                            </div>
                        </div>

                        {{-- <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Mobile</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" readonly="readonly" id="myEdit" name="" value="+84-583892288">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Fax</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" readonly="readonly" id="myEdit" name="" value="">
                            </div>
                        </div> --}}
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Địa chỉ</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="info[address]" placeholder="Nhập địa chỉ" value="{{ old('info.address', $user->info['address']) }}">
                            </div>
                        </div>
                        @php
                        $userSocialFB = auth('web')->user()->social()->where('provider', 'facebook')->first();
                        $userSocialGG = auth('web')->user()->social()->where('provider', 'google')->first();
                        @endphp
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Liên kết Facebook</label>
                            <div class="col-sm-9 col-form-label">
                                {!! $userSocialFB ? '<strong>' . $userSocialFB['social_id'] . '</strong> <a class="btn btn-danger btn-sm ml-3" href="' . route('client.unlink_social', 'facebook') . '">Xóa</a>' : '<em>Chưa liên kết</em> <a class="btn btn-info btn-sm ml-3" onclick="login_social(\''. route('login.social', 'facebook') .'\');" href="javascript:;">Liên kết</a>' !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Liên kết Google</label>
                            <div class="col-sm-9 col-form-label">
                                {!! $userSocialGG ? '<strong>' . $userSocialGG['social_id'] . '</strong> <a class="btn btn-danger btn-sm ml-3" href="' . route('client.unlink_social', 'google') . '">Xóa</a>' : '<em>Chưa liên kết</em> <a class="btn btn-info btn-sm ml-3" onclick="login_social(\''. route('login.social', 'google') .'\');" href="javascript:;">Liên kết</a>' !!}
                            </div>
                        </div>
                        <div class="mt-2 text-right">
                            <button type="submit" class="btn btn-success">Lưu thay đổi</button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</main>
@endsection

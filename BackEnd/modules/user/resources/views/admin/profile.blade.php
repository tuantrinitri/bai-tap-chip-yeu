@extends('core::theme.layouts.default')
@section('page_header')
<div class="page-header-content header-elements-md-inline">
    <div class="page-title d-flex">
        <h4><i class="fa fa-users mr-2"></i> <span class="font-weight-semibold">Thông tin tài khoản</span></h4>
    </div>
</div>
@endsection
@section('page_content')
<form action="{{ route('user.admin.profile') }}" method="post">
    {{ csrf_field() }}

    <div class="card-body">
        <div class="form-group row">
            <label class="col-form-label col-lg-3"><strong>Email</strong> <sup class="text-danger">(*)</sup></label>
            <div class="col-lg-9">
                <input autocomplete="new-password" readonly type="email" class="form-control" name="email" value="{{ old('email', $user['email']) }}" placeholder="Nhập email">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-form-label col-lg-3"><strong>Tên hiển thị</strong></label>
            <div class="col-lg-9">
                <input autocomplete="new-password" type="text" class="form-control" name="display_name" value="{{ old('display_name', $user['display_name']) }}" placeholder="Nhập tên hiển thị">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-form-label col-lg-3"><strong>Họ tên</strong></label>
            <div class="col-lg-9">
                <input autocomplete="new-password" type="text" class=" form-control" name="info[fullname]" value="{{ old('info.fullname', $user->info['fullname']) }}" placeholder="Nhập họ tên">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-form-label col-lg-3"><strong>Điện thoại</strong></label>
            <div class="col-lg-9">
                <input autocomplete="new-password" type="text" class=" form-control" name="info[phone]" value="{{ old('info.phone', $user->info['phone']) }}" placeholder="Nhập điện thoại">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-form-label col-lg-3"><strong>Giới tính</strong></label>
            <div class="col-lg-9">
                <div class="form-check form-check-inline">
                    <label class="form-check-label">
                        <div class="uniform-choice">
                            <div class="uniform-choice">
                                <input name="info[gender]" type="radio" class="form-check-input-styled" {{ old('info.gender', $user->info['gender']) == 1 ? 'checked' : '' }} value="1">
                            </div>
                        </div>
                        Nam
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label">
                        <div class="uniform-choice">
                            <div class="uniform-choice">
                                <input name="info[gender]" type="radio" class="form-check-input-styled" {{ old('info.gender', $user->info['gender']) == 2 ? 'checked' : '' }} value="2">
                            </div>
                        </div>
                        Nữ
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-form-label col-lg-3"><strong>Địa chỉ</strong></label>
            <div class="col-lg-9">
                <input autocomplete="new-password" type="text" class=" form-control" name="info[address]" value="{{ old('info.address', $user->info['address']) }}" placeholder="Nhập địa chỉ">
            </div>
        </div>

        <h5 class="text-center">ĐỔI MẬT KHẨU</h5>
        <p class="text-center"><em>Nếu không đổi mật khẩu vui lòng bỏ trống 2 ô bên dưới</em></p>

        <div class="form-group row">
            <label class="col-form-label col-lg-3"><strong>Mật khẩu cũ</strong></label>
            <div class="col-lg-9">
                <input autocomplete="off" type="password" class="form-control input-inline" name="old_password" value="{{ old('old_password') }}" placeholder="Nhập mật khẩu cũ">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-form-label col-lg-3"><strong>Mật khẩu mới</strong></label>
            <div class="col-lg-9">
                <input autocomplete="new-password" type="password" class="form-control input-inline" name="password" value="{{ old('password') }}" placeholder="Nhập mật khẩu mới">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-form-label col-lg-3"><strong>Nhập lại mật khẩu mới</strong></label>
            <div class="col-lg-9">
                <input autocomplete="new-password" type="password" class="form-control" name="repassword" value="{{ old('repassword') }}" placeholder="Nhập lại mật khẩu mới">
            </div>
        </div>
    </div>

    <div class="text-center mb-5">
        <button type="submit" class="btn btn-info btn-sm">Lưu lại</button>
    </div>
</form>
@endsection
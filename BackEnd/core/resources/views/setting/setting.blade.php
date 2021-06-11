@extends('core::theme.layouts.default')
@section('page_content')
<form action="{{ route('core.admin.setting') }}" id="frmSetting" method="post">
    {{ csrf_field() }}
    <div class="p-2 text-center bg-light">
        <button type="submit" class="btn btn-primary btn-sm"><i class="icon-check mr-1"></i> Lưu lại</button>
    </div>

    <div class="d-md-flex setting">
        <ul class="nav nav-tabs nav-tabs-vertical flex-column wmin-md-200 mb-md-0 border-bottom-0">
            <li class="nav-item"><a href="#setting-info" class="nav-link active" data-toggle="tab"><i class="fa fa-info mr-2"></i> Thông tin website</a></li>
            <li class="nav-item"><a href="#setting-smtp" class="nav-link" data-toggle="tab"><i class="fa fa-envelope mr-2"></i> SMTP</a></li>

        </ul>

        <div class="tab-content">
            <div class="tab-pane fade active show" id="setting-info">
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3"><strong>Tình trạng website</strong></label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <select name="site_status" class="form-control">
                                    <option value="1" {{ old('site_status', setting('site_status')) == 1 ? 'selected' : '' }}>Website hoạt động bình thường</option>
                                    <option value="0" {{ old('site_status', setting('site_status')) == 0 ? 'selected' : '' }}>Tạm đóng cửa website</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3"><strong>URL website</strong></label>
                        <div class="col-lg-9">
                            <input placeholder="Nhập URL website" type="text" name="site_url" class="form-control" value="{{ old('site_url', setting('site_url')) }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3"><strong>Tên website</strong> <sup class="text-danger">(*)</sup></label>
                        <div class="col-lg-9">
                            <input placeholder="Nhập tên website" type="text" name="site_name" class="form-control" value="{{ old('site_name', setting('site_name')) }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3"><strong>Logo</strong> <sup class="text-danger">(*)</sup></label>
                        <div class="col-lg-9">
                            <div class="input-group areaBrowserFile">
                                <input placeholder="Chọn ảnh" readonly type="text" id="img-logo" class="form-control" name="site_logo" value="{{ old('site_logo', setting('site_logo')) }}">
                                <div class="input-group-prepend mr-0">
                                    <button class="btn btn-light btn-sm btn-remove-file text-danger" type="button"><i class="fa fa-times"></i></button>
                                    <button class="btn btn-dark btn-sm btn-choose-file" data-id="img-logo" type="button"><i class="fa fa-image mr-1"></i> Chọn ảnh</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3"><strong>Email</strong> <sup class="text-danger">(*)</sup></label>
                        <div class="col-lg-9">
                            <input placeholder="Nhập tên email" type="text" name="site_email" class="form-control" value="{{ old('site_email', setting('site_email')) }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3"><strong>Mô tả</strong></label>
                        <div class="col-lg-9">
                            <input placeholder="Nhập mô tả website" type="text" name="site_description" class="form-control" value="{{ old('site_description', setting('site_description')) }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3"><strong>Từ khóa máy chủ tìm kiếm</strong></label>
                        <div class="col-lg-9">
                            <input placeholder="Nhập từ khóa máy chủ tìm kiếm" type="text" name="site_keywords" class="form-control" value="{{ old('site_keywords', setting('site_keywords')) }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3"><strong>Điện thoại</strong></label>
                        <div class="col-lg-9">
                            <input placeholder="Nhập điện thoại" type="text" name="site_phone" class="form-control" value="{{ old('site_phone', setting('site_phone')) }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3"><strong>Địa chỉ</strong></label>
                        <div class="col-lg-9">
                            <input placeholder="Nhập địa chỉ" type="text" name="site_address" class="form-control" value="{{ old('site_address', setting('site_address')) }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="setting-smtp">
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3"><strong>Máy chủ mail</strong> <sup class="text-danger">(*)</sup></label>
                        <div class="col-lg-9">
                            <input placeholder="smtp.gmail.com" type="text" name="mail[host]" class="form-control" value="{{ old('mail.host', setting('mail.host')) }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3"><strong>Cổng gửi mail</strong> <sup class="text-danger">(*)</sup></label>
                        <div class="col-lg-9">
                            <input style="width:75px" placeholder="587" type="text" name="mail[port]" class="form-control" value="{{ old('mail.port', setting('mail.port')) }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3"><strong>Loại mã hóa</strong></label>
                        <div class="col-lg-9">
                            <select name="mail[encryption]" class="form-control">
                                <option value="">Không</option>
                                <option value="ssl" {{ old('mail.encryption', setting('mail.encryption')) == 'ssl' ? 'selected' : '' }}>SSL</option>
                                <option value="tls" {{ old('mail.encryption', setting('mail.encryption')) == 'tls' ? 'selected' : '' }}>TLS</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3"><strong>Tài khoản</strong> <sup class="text-danger">(*)</sup></label>
                        <div class="col-lg-9">
                            <input autocomplete="new-password" placeholder="user@gmail.com" type="text" name="mail[username]" class="form-control" value="{{ old('mail.username', setting('mail.username')) }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3"><strong>Mật khẩu</strong> <sup class="text-danger">(*)</sup></label>
                        <div class="col-lg-9">
                            <input autocomplete="new-password" placeholder="Mật khẩu" type="password" name="mail[password]" class="form-control" value="{{ old('mail.password', setting('mail.password')) }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3"><strong>Định danh người gửi</strong> <sup class="text-danger">(*)</sup></label>
                        <div class="col-lg-4">
                            <input autocomplete="new-password" placeholder="MITECH CENTER" type="text" name="mail[from][name]" class="form-control" value="{{ old('mail.from.name', setting('mail.from.name')) }}">
                        </div>
                        <div class="col-lg-5">
                            <input autocomplete="new-password" placeholder="info@mitech.vn" type="text" name="mail[from][address]" class="form-control" value="{{ old('mail.from.address', setting('mail.from.address')) }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3"><strong>Kiểm tra cấu hình</strong> </label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <input name="test_email" type="text" class="form-control" placeholder="Nhập địa chỉ mail nhận tin">
                                <div class="input-group-prepend mr-0">
                                    <button class="btn btn-dark btn-sm" type="button" onclick="sendTestConfigMail();"><i class="fas fa-paper-plane mr-2"></i>Gửi</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="p-2 text-center bg-light">
        <button type="submit" class="btn btn-primary btn-sm"><i class="icon-check mr-1"></i> Lưu lại</button>
    </div>
</form>
@endsection
@section('custom_js')
<script>
    $(document).ready(() => {
        $('body').addClass('sidebar-xs');
        var url = window.location.href;
        var hash = url.substring(url.indexOf('#'));
        $(".nav-tabs").find("li a").each(function(key, val) {
            if (hash == $(val).attr('href')) {
                $(val).click();
            }

            $(val).click(function(ky, vl) {
                location.hash = $(this).attr('href');
            });
        });
    });

    function sendTestConfigMail()
    {
        var card_el = $('body');
        $(card_el).block({
            message: '<i class="icon-spinner2 spinner"></i>',
            overlayCSS: {
                backgroundColor: '#fff',
                opacity: 0.8,
                cursor: 'wait'
            },
            css: {
                border: 0,
                padding: 0,
                backgroundColor: 'none'
            }
        });

        $.ajax({
            type: 'post',
            url: "{{ route('core.admin.test_config_mail') }}",
            data: $('#frmSetting').serialize(),
            dataType: 'json',
            success: function(res) {
                $(card_el).unblock();
                if (res.status) {
                    app.showNotify(res.message, 'success');
                } else {
                    app.showNotify(res.message, 'error');
                }
            }
        });
    }
</script>
@endsection

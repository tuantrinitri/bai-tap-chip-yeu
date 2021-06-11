<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Tạo tài khoản đầu tiên{{ isset($global_config['site_name']) ? ' | ' . $global_config['site_name'] : '' }}
        </title>
        @include('core::theme.partials.head_link')

        <style>
            .bg-login {
                background: url("{{ asset('images/bg-login-admin.jpg') }}");
                background-size: cover;
                height: 100vh;
                background-position: bottom;
            }

            .login-right {
                position: relative;
                height: 100%;
            }

            .login-form {
                position: absolute;
                top: 40%;
                left: 50%;
                transform: translateX(-50%) translateY(-50%);
                width: 24rem;
            }

            .login-form .img-logo {
                width: 100px;
                max-width: 100%;
            }

            .form-control-feedback {
                padding-left: 10px;
            }

        </style>
    </head>

    <body>
        <!-- Login form -->
        <form class="login-form" action="{{ route('user.login') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="type" value="first_user">
            <input type="hidden" name="redirect_to" value="{{ old('redirect_to', request()->input('redirect_to')) }}">
            <div class="text-center mb-3">
                <figure>
                    <img class="img-logo" src="{{ asset('assets/admin/images/logo.png') }}" alt="Logo AdminCP">
                </figure>
            </div>
            <div class="card mb-0">
                <div class="card-body">
                    <div class="text-center mb-3">
                        <h3><strong>HỆ THỐNG QUẢN LÝ</strong></h3>
                        <div class="alert alert-success p-1">Tạo tài khoản đầu tiên</div>
                    </div>

                    <div class="form-group form-group-feedback form-group-feedback-left">
                        <input autocomplete="new-password" name="display_name" value="{{ old('display_name') }}"
                            type="text" class="form-control" placeholder="Nhập tên hiển thị">
                        <div class="form-control-feedback">
                            <i class="icon-user text-muted"></i>
                        </div>
                    </div>

                    <div class="form-group form-group-feedback form-group-feedback-left">
                        <input autocomplete="new-password" name="email" value="{{ old('email') }}" type="text"
                            class="form-control" placeholder="Nhập email">
                        <div class="form-control-feedback">
                            <i class="icon-envelope text-muted"></i>
                        </div>
                    </div>

                    <div class="form-group form-group-feedback form-group-feedback-left">
                        <input autocomplete="new-password" name="password" type="password" class="form-control"
                            placeholder="Nhập mật khẩu">
                        <div class="form-control-feedback">
                            <i class="icon-lock2 text-muted"></i>
                        </div>
                    </div>

                    <div class="form-group form-group-feedback form-group-feedback-left">
                        <input autocomplete="new-password" name="repassword" type="password" class="form-control"
                            placeholder="Nhập lại mật khẩu">
                        <div class="form-control-feedback">
                            <i class="icon-lock2 text-muted"></i>
                        </div>
                    </div>

                    <div class="form-group text-center mb-0">
                        <button type="submit" class="btn btn-success">TẠO TÀI KHOẢN</button>
                    </div>
                    @if (module_check_active('web'))
                    <a href="{{ route('index') }}">&larr; Quay về Trang chủ</a>
                    @endif
                </div>
            </div>
            <p class="text-center mt-2">Hệ thống được phát triển bởi <a href="https://mitechcenter.vn"
                    target="_blank"><strong>MITECH</strong></a>. Phiên bản <span
                    class="badge badge-warning">{{ config('cms.version') }}</span></p>
        </form>
        <!-- /login form -->

        <script src="{{ asset('assets/admin/js/main/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/admin/js/plugins/loaders/blockui.min.js') }}"></script>
        <script src="{{ asset('assets/admin/js/plugins/ui/ripple.min.js') }}"></script>
        <!-- /core JS files -->

        <script src="{{ asset('assets/js.cookie.min.js') }}"></script>

        <script src="{{ asset('assets/admin/js/plugins/forms/styling/uniform.min.js') }}"></script>
        <script src="{{ asset('assets/admin/js/plugins/forms/styling/switchery.min.js') }}"></script>
        <script src="{{ asset('assets/admin/js/plugins/forms/styling/switch.min.js') }}"></script>
        <script src="{{ asset('assets/admin/js/app.js') }}"></script>
        <script src="{{ asset('assets/admin/js/noty.min.js') }}"></script>
        <script src="{{ asset('assets/admin/js/dev.custom.js') }}"></script>
        <!-- /theme JS files -->
        <script>
            $(document).ready(function(){
        $('.form-check-input-styled').uniform();

        @if (isset($errors) && count($errors->all()) > 0)
            @foreach ($errors->all() as $message)
                app.showNotify("{{ $message }}", "error");
            @endforeach
        @endif

        @if(session('flash_data'))
            @php
                $flash_data = session('flash_data');
            @endphp
            app.showNotify("{{ $flash_data['message'] }}", "{{ $flash_data['type'] }}");
        @endif
    });
        </script>

    </body>

</html>

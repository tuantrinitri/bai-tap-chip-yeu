<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ trans('user::login.login_page_title') }}{{ isset($global_config['site_name']) ? ' | ' . $global_config['site_name'] : '' }}</title>
    @include('core::theme.partials.head_link')

    <head>
        <link rel="icon" href="{{ asset('assets/web/images/favicon.ico') }}" type="image" sizes="16x16">
    </head>
    <style>
        .bg-login {
            background: url("{{ asset('assets/admin/images/login_cover.jpg') }}");
            background-size: cover;
            height: 100vh;
            background-position: center center;
        }

        .login-right {
            position: relative;
            height: 100vh;
        }

        .login-form {
            position: absolute;
            top: 40%;
            left: 50%;
            transform: translateX(-50%) translateY(-50%);
            padding: 0 30px;
            width: 100%;
        }

        .login-form .img-logo {
            width: 100px;
            max-width: 100%;
        }

        .form-control-feedback {
            padding-left: 10px;
        }

        .bottom {
            position: absolute;
            bottom: 0;
            padding: 30px 50px;
        }

        @media (max-width: 767.98px) {
            .login-form {
                padding: 30px;
                width: 90%;
                background: #fff;
                border-radius: 5px;
            }

            .login-right {
                position: unset;
                height: unset;
            }
        }
    </style>
</head>

<body style="background-color:#fff;">
    <div class="row m-0">
        <div class="col-12 col-md-8 login-left bg-login">
            <div class="bottom">
                <h1><strong>{{ setting('site_name', config('cms.site_name')) }}</strong></h1>
                <p class="mt-2">{{ trans('core::common.powered_by') }} <a href="https://mitechcenter.vn" target="_blank" class="text-white"><strong>MITECH</strong></a>. {{ trans('core::common.version') }}: {{ config('cms.version') }}</p>

            </div>
        </div>
        <div class="col-12 col-md-4 login-right">
            <form class="login-form" action="{{ route('user.login') }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="redirect_to" value="{{ old('redirect_to', request()->input('redirect_to')) }}">
                <div class="text-center mb-3">
                    <figure>
                        <a href="{{ route('index') }}">
                            <img class="img-logo" src="{{ asset('upload/default/Logo.png') }}" alt="Logo AdminCP">
                        </a>
                    </figure>
                </div>
                <div class="text-center mb-3">
                    <h3><strong>Đăng nhập vào hệ thống</strong></h3>
                </div>

                <div class="form-group form-group-feedback form-group-feedback-left">
                    <input autocomplete="new-password" name="email" value="{{ old('email') }}" type="text" class="form-control" placeholder="{{ trans('user::login.email_placeholder') }}">
                    <div class="form-control-feedback">
                        <i class="icon-envelope text-muted"></i>
                    </div>
                </div>

                <div class="form-group form-group-feedback form-group-feedback-left">
                    <input autocomplete="new-password" name="password" type="password" class="form-control" placeholder="{{ trans('user::login.password_placeholder') }}">
                    <div class="form-control-feedback">
                        <i class="icon-lock2 text-muted"></i>
                    </div>
                </div>
                <div class="form-group d-flex align-items-center">
                    <div class="form-check mb-0">
                        <label class="form-check-label">
                            <input type="checkbox" name="is_remember" class="form-check-input-styled" {{ old('is_remember') == 1 ? 'checked' : '' }} value="1">
                            {{ trans('user::login.remember_login') }}
                        </label>
                    </div>

                </div>
                <div class="form-group text-center mb-0">
                    <button type="submit" class="btn btn-primary">{{ trans('user::login.login_button') }}</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Login form -->

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
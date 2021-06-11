<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Đăng ký tài khoản</title>
    @include('Web::partials.head_link')
</head>

<body>
    <div id="wrapper">
        <main id="main">
            <div id="content" role="main" class="content-area">
                <div class="container-fluid p-0">
                    <section id="login-form">
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 f-login-img"></div>
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-flogin">
                                <div class="wrap-login100">
                                    <form class="login100-form validate-form" onsubmit="ajax_register(this);return false;" data-action="{{ route('post_register') }}">
                                        @csrf
                                        <input type="hidden" name="redirect_to" value="{{ old('redirect_to', request()->input('redirect_to')) }}">
                                        <figure class="text-center">
                                            <a href="{{ route('home') }}"><img src="{{ logo_src($global_config['site_logo']) }}" alt="{{ $global_config['site_name'] }}" style="width:50%"></a>
                                        </figure>
                                        <span class="login100-form-title">
                                            Đăng ký tài khoản
                                        </span>
                                        <div class="wrap-input100 validate-input" data-validate="Valid username is required">
                                            <input class="input100" type="text" name="fullname" placeholder="Họ và tên" required="required">
                                            <span class="focus-input100"></span>
                                            <span class="symbol-input100">
                                                <i class="fas fa-user"></i>
                                            </span>
                                        </div>
                                        <div class="wrap-input100 validate-input" data-validate="Valid username is required">
                                            <input class="input100" type="email" name="email" placeholder="Email" required="required">
                                            <span class="focus-input100"></span>
                                            <span class="symbol-input100">
                                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <div class="wrap-input100 validate-input" data-validate="Phone username is required">
                                            <input class="input100" type="text" name="phone" placeholder="Số điện thoại" required="required">
                                            <span class="focus-input100"></span>
                                            <span class="symbol-input100">
                                                <i class="fas fa-phone-alt"></i>
                                            </span>
                                        </div>
                                        <div class="wrap-input100 validate-input" data-validate="Password is required">
                                            <input class="input100" type="password" name="password" placeholder="Mật khẩu" required="required">
                                            <span class="focus-input100"></span>
                                            <span class="symbol-input100">
                                                <i class="fa fa-lock" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <div class="wrap-input100 validate-input" data-validate="Password is required">
                                            <input class="input100" type="password" name="repassword" placeholder="Nhập lại mật khẩu" required="required">
                                            <span class="focus-input100"></span>
                                            <span class="symbol-input100">
                                                <i class="fa fa-lock" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="confirm_rule" id="defaultCheck1" required="required">
                                            <label class="form-check-label" for="defaultCheck1">
                                                Tôi đồng ý với các <a href="#">điều khoản</a> và <a href="#">chính sách bảo mật</a>.
                                            </label>
                                        </div>
                                        <div class="container-login100-form-btn">
                                            <span id="resultRegisterMessage" class="mt-1 mb-1" style="display:none;"></span>
                                            <button type="submit" class="login100-form-btn">
                                                Đăng ký
                                            </button>
                                        </div>
                                        <div class="text-center p-t-12 p-t-136">
                                            <span class="txt1">
                                                Đã có tài khoản?
                                            </span>
                                            <a class="txt2" href="{{ route('login') }}">
                                                Đăng nhập
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </main>
    </div>
    @include('Web::partials.foot_script')
</body>

</html>

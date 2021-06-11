<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Quên mật khẩu</title>
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
                                    <form class="login100-form validate-form" action="{{ route('post_forgot_password') }}" method="post">
                                        @csrf
                                        <figure class="text-center">
                                            <a href="{{ route('home') }}"><img src="{{ logo_src($global_config['site_logo']) }}" alt="{{ $global_config['site_name'] }}" style="width:50%"></a>
                                        </figure>
                                        <span class="login100-form-title">
                                            Quên mật khẩu
                                        </span>
                                        <p>
                                            <div class="alert alert-info" role="alert">
                                                Bạn sẽ nhận được một email sau khi gửi yêu cầu, vui lòng kiểm tra email và làm theo hướng dẫn.
                                            </div>
                                        </p>
                                        <div class="wrap-input100 validate-input" data-validate="Valid username is required">
                                            <input class="input100" type="text" name="email" placeholder="Nhập email" value="{{ old('email') }}" required="required">
                                            <span class="focus-input100"></span>
                                            <span class="symbol-input100">
                                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        @include('Web::partials.errors')
                                        <div class="container-login100-form-btn">
                                            <button type="submit" class="login100-form-btn">
                                                Gửi yêu cầu
                                            </button>
                                        </div>
                                        <div class="text-center p-t-136">
                                            <a class="txt2" href="{{ route('login') }}">
                                                <i class="fas fa-long-arrow-alt-left"></i>
                                                Quay về trang <strong>Đăng nhập</strong>
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
    @if(session('flash_data'))
    @php
    $flash_data = session('flash_data');
    @endphp
    <script>
        $(document).ready(()=>{
            setTimeout(() => {
                alert("{{ $flash_data['message'] }}");
            }, 300);
        });
    </script>
    @endif
</body>

</html>

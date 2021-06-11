<header id="header" class="header">
    <div class="header-head">
        <div class="container">
            <div class="box">
                <div class="d-flex justify-content-start align-items-center">
                    <div class="logo">
                        <a href="{{ route('index') }}" title="{{ setting('site_name') }}">
                            <img src="{{ logo_src(setting('site_logo'))  }}" alt="{{ setting('site_name') }}">
                        </a>
                    </div>
                    <div class="header-head__info">
                        <p class="header-head__text">TRANG TIN ĐIỆN TỬ</p>
                        <h3 class="heading-3">HIỆP HỘI CÁ NGỪ VIỆT NAM</h3>
                        <h4 class="heading-4 heading-4--header">VIETNAM TUNA ASSOCIATION</h4>
                    </div>
                </div>
                <div class="header__box-login">
                    <div class="header__form">
                        <ul>
                            <li>
                                @if (auth('web')->check())
                                @if (auth()->user()->hasRole(['superadmin']))
                                <a href="{{ route('dashboard') }}" class="form-login">{{ user_display_name(auth()->user()['id']) }}</a>
                                <a href="{{ route('user.logout') }}">| Đăng xuất</a>
                                @endif
                                @else
                                <a href="{{ route('user.admin.login') }}" class="form-login">Đăng nhập</a>
                                @endif
                            </li>
                            <li>
                                {{-- {{ route('web.locale', 'vi') }} --}}
                                <a href="{{ route('admin.locale','vi') }}">
                                    <img src="{{ asset('assets/admin/images/vn.svg') }}" width="16" alt="Tiếng Việt">
                                </a>

                            </li>
                            <li>
                                {{-- {{ route('web.locale', 'en') }} --}}
                                <a href="{{ route('admin.locale','en') }}" class="ml-3">
                                    <img src="{{ asset('assets/admin/images/en.svg') }}" width="16" alt="English">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @widgetGroup('MAIN_MENU')
</header>
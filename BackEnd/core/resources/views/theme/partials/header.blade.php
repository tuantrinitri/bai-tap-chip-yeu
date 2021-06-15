<!-- Main navbar -->
<div class="navbar navbar-expand-md navbar-dark bg-indigo navbar-slide-top navbar-topheader fixed-top">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
                <i class="icon-paragraph-justify3"></i>
            </a>
        </li>
    </ul>
    <span class="navbar-text ml-md-3">
        <i class="icon-alarm font-size-sm mr-1 font-weight-semibold"></i>
        <span id="timer_header"></span>
    </span>
    <div class="navbar-brand d-flex justify-content-center">
        <a href="{{ route('dashboard') }}" class="d-block">
            <strong style="text-transform: uppercase;">{{ trans('core::common.management_system') }}</strong>
        </a>
    </div>
    <div class="d-md-none">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
            <i class="icon-tree5"></i>
        </button>
        <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
            <i class="icon-paragraph-justify3"></i>
        </button>
    </div>
    @if (auth()->user()->hasRole('superadmin'))
    @if (module_check_active('information'))
    <div class="collapse navbar-collapse" id="navbar-mobile">
        <ul class="navbar-nav ml-md-auto">
            @if (auth()->user()->hasRole('superadmin'))
            <li class="nav-item dropdown">
                <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                    <i class="fas fa-bible fa-2x"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-content wmin-md-350">
                    <div class="dropdown-content-body p-2">
                        <div class="row no-gutters">
                            <div class="col-6 col-sm-4">
                                <a href="{{ route('information.admin.location') }}" class="d-block text-default text-center ripple-dark rounded p-3">
                                    <i class="fas fa-map-marked-alt fa-2x"></i>
                                    <div class="font-size-sm font-weight-semibold text-uppercase mt-2">QUẢN LÝ<br>VỊ TRÍ</div>
                                </a>
                            </div>
                            <div class="col-6 col-sm-4">
                                <a href="{{ route('information.admin.project') }}" class="d-block text-default text-center ripple-dark rounded p-3">
                                    <i class="fab fa-r-project fa-2x"></i>
                                    <div class="font-size-sm font-weight-semibold text-uppercase mt-2">QUẢN LÝ<br>DỰ ÁN</div>
                                </a>
                            </div>
                            <div class="col-6 col-sm-4">
                                <a href="{{ route('information.admin.gear') }}" class="d-block text-default text-center ripple-dark rounded p-3">
                                    <img class="img-thumbnail" style="height: 35px;" hrea src="{{ asset('assets/admin/images/icons/hook-iocn.png') }}" alt="">
                                    <div class="font-size-sm font-weight-semibold text-uppercase mt-2">QUẢN LÝ<br>NGƯ CỤ KHAI THÁC</div>
                                </a>
                            </div>

                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-6 col-sm-4">
                            <a href="{{ route('information.admin.species') }}" class="d-block text-default text-center ripple-dark rounded p-3">
                                <i class="fas fa-fish fa-2x"></i>
                                <div class="font-size-sm font-weight-semibold text-uppercase mt-2">QUẢN LÝ<br>LOÀI KHAI THÁC</div>
                            </a>
                        </div>
                        <div class="col-6 col-sm-4">
                            <a href="{{ route('information.admin.product') }}" class="d-block text-default text-center ripple-dark rounded p-3">
                                <i class="fa fa-folder fa-2x"></i>
                                <div class="font-size-sm font-weight-semibold text-uppercase mt-2">QUẢN LÝ<br>DẠNG SẢN PHẨM</div>
                            </a>
                        </div>
                        <div class="col-6 col-sm-4">
                            <a href="{{ route('information.admin.port') }}" class="d-block text-default text-center ripple-dark rounded p-3">
                                <i class="fa fa-address-book fa-2x"></i>
                                <div class="font-size-sm font-weight-semibold text-uppercase mt-2">QUẢN LÝ<br>Cảng biển</div>
                            </a>
                        </div>
                    </div>
                    @endif
                </div>

        </ul>
    </div>
    @endif
    @endif
    {{-- seting asccest --}}

    <div class="collapse navbar-collapse" id="navbar-mobile">
        <ul class="navbar-nav ml-md-auto">
            @if (auth()->user()->hasRole('superadmin'))
            <li class="nav-item dropdown">
                <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                    <i class="fas fa-tools"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-content wmin-md-350">
                    <div class="dropdown-content-body p-2">
                        <div class="row no-gutters">
                            <div class="col-6 col-sm-4">
                                <a href="{{ route('core.admin.setting') }}" class="d-block text-default text-center ripple-dark rounded p-3">
                                    <i class="fa fa-cogs fa-2x"></i>
                                    <div class="font-size-sm font-weight-semibold text-uppercase mt-2">CÀI ĐẶT<br>HỆ THỐNG</div>
                                </a>
                            </div>
                            <div class="col-6 col-sm-4">
                                <a href="{{ route('core.admin.files') }}" class="d-block text-default text-center ripple-dark rounded p-3">
                                    <i class="fa fa-file-image fa-2x"></i>
                                    <div class="font-size-sm font-weight-semibold text-uppercase mt-2">QUẢN LÝ<br>FILE</div>
                                </a>
                            </div>
                            <div class="col-6 col-sm-4">
                                <a href="{{ route('core.admin.list_module') }}" class="d-block text-default text-center ripple-dark rounded p-3">
                                    <i class="fa fa-cubes fa-2x"></i>
                                    <div class="font-size-sm font-weight-semibold text-uppercase mt-2">QUẢN LÝ<br>MODULE</div>
                                </a>
                            </div>
                            <div class="col-6 col-sm-4">
                                <a href="{{ route('core.admin.system_cache') }}" class="d-block text-default text-center ripple-dark rounded p-3">
                                    <i class="fas fa-magic fa-2x"></i>
                                    <div class="font-size-sm font-weight-semibold text-uppercase mt-2">QUẢN LÝ<br>BỘ ĐỆM</div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        @if (module_check_active('menu'))
                        <div class="col-6 col-sm-4">
                            <a href="{{ route('menu.admin.index') }}" class="d-block text-default text-center ripple-dark rounded p-3">
                                <i class="icon-tree7 fa-2x"></i>
                                <div class="font-size-sm font-weight-semibold text-uppercase mt-2">QUẢN LÝ<br>MENU</div>
                            </a>
                        </div>
                        @endif
                    </div>

                </div>
            </li>
            @endif
            @if (session('admin-locale'))
            {{-- <li class="nav-item dropdown dropdown-user">
                <a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle legitRipple" data-toggle="dropdown" aria-expanded="false">
                    @if (session('admin-locale') == 'vi')
                    <img src="{{ asset('assets/admin/images/vn.svg') }}" width="16" alt="Tiếng Việt">
            <span class="ml-1">Tiếng Việt</span>
            @endif
            @if (session('admin-locale') == 'en')
            <img src="{{ asset('assets/admin/images/en.svg') }}" width="16" alt="English">
            <span class="ml-1">English</span>
            @endif
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{ route('admin.locale', 'vi') }}" class="dropdown-item">
                    <img src="{{ asset('assets/admin/images/vn.svg') }}" width="16" alt="Tiếng Việt">
                    <span>Tiếng Việt</span>
                </a>
                <a href="{{ route('admin.locale', 'en') }}" class="dropdown-item">
                    <img src="{{ asset('assets/admin/images/en.svg') }}" width="16" alt="English">
                    <span>English</span>
                </a>
            </div>
            </li> --}}
            @endif
            <li class="nav-item">
                <a href="{{ route('index') }}" class="navbar-nav-link" target="_blank" data-popup="tooltip" title="Xem website">
                    <i class="fas fa-home"></i>
                </a>
            </li>
            <li class="nav-item dropdown dropdown-user">
                <a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle legitRipple" data-toggle="dropdown" aria-expanded="false">
                    {{-- <img src="{{ logo_src(cms_get_config('site_logo')) }}" class="rounded-circle mr-2" height="34" alt=""> --}}
                    <span><strong>{{ user_display_name(auth()->id()) }}</strong></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{ route('user.admin.profile') }}" class="dropdown-item">{{ trans('user::admin.account_info') }}</a>
                    <div class="dropdown-divider opacity-75"></div>
                    <a href="javascript:;" onclick="askToLogout('{{ route('user.logout') }}')" class="dropdown-item text-danger">{{ trans('user::common.logout') }}</a>
                </div>
            </li>
        </ul>
    </div>

</div>
<!-- /main navbar -->
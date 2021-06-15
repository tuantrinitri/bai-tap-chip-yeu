<!-- Main sidebar: sidebar-fixed  -->
<div class="sidebar sidebar-light sidebar-main sidebar-fixed sidebar-expand-md">

    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        <span class="font-weight-semibold">DANH MỤC CHỨC NĂNG</span>
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->

    <!-- Sidebar content -->
    <div class="sidebar-content">
        <!-- Main navigation -->
        <div class="card card-sidebar-mobile">
            <ul class="nav nav-sidebar" data-nav-type="accordion">
                @foreach ($menus = dashboard_menu()->getAll() as $menu)
                <li class="nav-item @if (isset($menu->children) && $menu->children->count()) nav-item-submenu @if ($menu->active) nav-item-expanded nav-item-open @endif @endif" id="{{ $menu->id }}">
                    <a href="{{ $menu->url }}" class="nav-link nav-toggle @if ($menu->active) active @endif"><i class="{{ $menu->icon }}"></i>
                        <span>{{ trans($menu->name) }}</span>
                        @filter(CORE_FILTER_APPEND_MENU_NAME, $menu->id)
                    </a>

                    @if (isset($menu->children) && $menu->children->count())
                    <ul class="nav nav-group-sub" data-submenu-title="{{ trans($menu->name) }}">
                        @foreach ($menu->children as $item)
                        <li class="nav-item" id="{{ $item->id }}">
                            <a href="{{ $item->url }}" class="nav-link @if ($item->active) active @endif">
                                <i class="{{ $item->icon }}"></i>
                                <span>{{ trans($item->name) }}</span>
                                @filter(CORE_FILTER_APPEND_MENU_NAME, $item->id)
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </li>
                @endforeach
            </ul>
        </div>
        <!-- /main navigation -->

    </div>
    <!-- /sidebar content -->

</div>
<!-- /main sidebar -->
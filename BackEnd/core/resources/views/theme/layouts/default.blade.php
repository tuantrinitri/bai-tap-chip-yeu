<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ page_title()->getTitle() }}</title>
    @include('core::theme.partials.head_link')
    @yield('custom_css')
</head>

<body class="navbar-top {{ $classFullsidebar }}">
    @include('core::theme.partials.header')
    <!-- Page content -->
    <div class="page-content">
        @include('core::theme.partials.sidebar')
        <!-- Main content -->
        <div class="content-wrapper">
            <!-- Page header -->
            <div class="page-header page-header-light">
                <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                    <div class="d-flex">
                        <div class="breadcrumb">
                            {{ Breadcrumbs::render() }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- /page header -->
            <!-- Content area -->
            <div class="content">
                @yield('page_content')
            </div>
            <!-- /content area -->
            @include('core::theme.partials.footer')
        </div>
        <!-- /main content -->
    </div>
    <!-- /page content -->
    @include('core::theme.partials.foot_script')
    @yield('custom_js')
</body>

</html>
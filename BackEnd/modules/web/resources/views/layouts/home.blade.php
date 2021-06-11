<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ page_title()->getTitle() }}</title>
    <!-- open-graph -->
    <meta property="og:site_name" content="Colby Fayock" />
    <meta property="og:title" content="" />
    <meta property="og:description" content="" />
    <meta property="og:url" content="" />
    <meta property="og:type" content="article" />
    <meta property="article:publisher" content="" />
    <meta property="article:section" content="" />
    <meta property="article:tag" content="" />
    <meta property="og:image" content="" />
    <meta property="og:image:secure_url" content="" />
    <meta property="og:image:width" content="" />
    <meta property="og:image:height" content="" />
    <meta property="twitter:card" content="" />
    <meta property="twitter:image" content="" />
    <meta property="twitter:site" content="" />
    <link rel="shortcut icon" href="{{ logo_src(setting('site_logo')) }}" />
    @include('web::partials.head_style')
    @yield('custom_css')
</head>

<body>
    {{-- {!! Widget::listPost() !!} --}}
    @include('web::partials.header')
    <main>
        @yield('page_content')
    </main>
    @include('web::partials.footer')
    @include('web::partials.foot_script')
    @yield('custom_js')
</body>

</html>
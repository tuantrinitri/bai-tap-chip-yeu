<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ page_title()->getTitle() }}</title>
    @include('web::partials.head_style')
    @yield('custom_css')
</head>

<body>
    @include('web::partials.header')
    @yield('page_content')
    @include('web::partials.footer')
    @include('web::partials.foot_script')
    @yield('custom_js')
</body>

</html>

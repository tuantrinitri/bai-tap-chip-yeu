<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ page_title()->getTitle() }}</title>
</head>

<body>
    @include('web::partials.header')
    <main>
        @yield('page_content')
    </main>
    @include('web::partials.footer')
    @include('web::partials.foot_script')
    @yield('custom_js')
</body>

</html>
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
    @include('web::partials.header')
    <main>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-7 col-lg-9">
                    @yield('page_content')
                    <div class="list-news">
                        <div class="title">
                            <h2>Các bài viết khác</h2>
                        </div>
                        <ul>
                            @widgetGroup('POST_MORE')
                        </ul>
                    </div>
                </div>

                <div class="col-xs-12 col-md-5 col-lg-3">
                    <div class="sidebar pt-3">
                        @widgetGroup('SIDEBAR_RIGHT')
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('web::partials.footer')
    @include('web::partials.foot_script')
    @yield('custom_js')
</body>

</html>
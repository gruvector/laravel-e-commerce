<!DOCTYPE html>
<html>
    <head>
        <base href="{{ url('/') }}">
        <meta charset="UTF-8">

        <title>
            @yield('title') - FleetCart
        </title>

        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <link href="https://fonts.googleapis.com/css?family=Open+Sans:600|Roboto:400,500" rel="stylesheet">

        @foreach ($assets->allCss() as $css)
            <link media="all" type="text/css" rel="stylesheet" href="{{ v($css) }}">
        @endforeach

        @include('admin::partials.globals')
    </head>

    <body class="clearfix">
        <div class="login-page">
            @include('admin::partials.notification')

            @yield('content')
        </div>

        @foreach ($assets->allJs() as $js)
            <script src="{{ v($js) }}"></script>
        @endforeach
    </body>
</html>

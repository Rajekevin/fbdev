<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pardon Maman | @yield('title')</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}" />
    <!--[if IE]><link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" /><![endif]-->
    <!-- Library / Fonts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('css')
    <!-- Javascript -->
    <script src="{{ asset('js/facebook_extension.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    @yield('js')
</head>
<body>
@include('frontend.html.header')
<div class="content">
    <div id="container">
        @yield('content')
    </div>
</div>
@include('frontend.html.footer')
</body>
</html>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=9">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
    <meta name="description"
          content="Order management system for restaurants and food shops with easy in-house order taking app and analytic portal. Process unlimited order with minimal setup in Quickly for Restaurants. Everything you need to get boost up sales with less effort.">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="icon" href="{{ \App\Helpers\asset('home-resources/img/restrogreen-36x36.png') }}">
    <link rel="manifest" href="{{ \App\Helpers\asset('manifest.json') }}">

    <link href="{{ \App\Helpers\asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ \App\Helpers\asset('css/sticky-footer-navbar.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ \App\Helpers\asset('css/icon.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ \App\Helpers\asset('css/style-custom.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ \App\Helpers\asset('css/theme.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ \App\Helpers\asset('css/jquery-confirm.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ \App\Helpers\asset('css/introLoader.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ \App\Helpers\asset('css/loader.css') }}" rel="stylesheet" type="text/css">
    <link href="{{\App\Helpers\asset('/css/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{\App\Helpers\asset('/css/flags/flag-icon.min.css')}}" rel="stylesheet"/>
    <link href="{{\App\Helpers\asset('/css/sign-up.css')}}" rel="stylesheet"/>
    <link href="{{ \App\Helpers\asset('css/toastr/toastr.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ \App\Helpers\asset('css/select2-bootstrap-5-theme.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ \App\Helpers\asset('css/daterangepicker.css') }}" rel="stylesheet" type="text/css">

    <script src="{{ \App\Helpers\asset('js/jquery-3.7.1.min.js') }}"></script>
    @yield('popover-js')
    <script src="{{ \App\Helpers\asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ \App\Helpers\asset('js/toastr/toastr.min.js') }}"></script>
    <script src="{{ \App\Helpers\asset('js/commonFunctions.js') }}"></script>
    <script src="{{ \App\Helpers\asset('js/jquery-confirm.min.js') }}"></script>
    <script src="{{\App\Helpers\asset('js/jquery.dirrty.js')}}"></script>
    <script src="{{\App\Helpers\asset('js/letter-initials.js')}}"></script>
    <script src="{{ \App\Helpers\asset('js/datepicker/moment.min.js') }}"></script>
    <script src="{{ \App\Helpers\asset('js/datepicker/daterangepicker.min.js') }}"></script>
    <script src="{{ \App\Helpers\asset('js/select2.min.js') }}"></script>

    @yield('styles')
    <style>
        .logo img{
            width: 130px !important;
        }
        .avatar-drawer{
            background: white;
            padding: 3px;
            width: 42px;
            cursor: pointer;
            border-radius: 5px;
        }
        .avatar-img{
            height: 36px;
            width: 36px;
        }

    </style>
</head>

<body>
<header class="p-3 bg-dark text-white sticky-top">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
            </a>
        </div>
    </div>
</header>

<main role="main" class="container container-custom pb-5" style="margin-top: 60px; min-height: calc(100vh - 230px); padding-top:0px;">
    @yield('content')
</main>

<footer class="footer">
    @include('includes.footer')
</footer>

@yield('scripts')

<script>

    $('document').ready(function () {
        $('#navBarDropDown').click(function () {
            console.log($("#drawer"));
            $("#drawer").toggle("fast");
        });
    });
</script>
</body>
</html>

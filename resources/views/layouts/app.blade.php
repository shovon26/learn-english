<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FoodCourt')</title>

    <link href="{{ \App\Helpers\asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ \App\Helpers\asset('css/jqueryUI/jquery-ui.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ \App\Helpers\asset('css/jquery-confirm.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ \App\Helpers\asset('css/toastr/toastr.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ \App\Helpers\asset('css/ladda.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ \App\Helpers\asset('css/select2.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ \App\Helpers\asset('css/select2-bootstrap-5-theme.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ \App\Helpers\asset('css/daterangepicker.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ \App\Helpers\asset('css/style-custom.css') }}" rel="stylesheet" type="text/css">
    @yield('styles')

    <style>
        html, body {
            position: relative;
            background-color: #e6ebef;
        }
        #toast-container.toast-top-right {
            top: 80px !important;
            right: 20px !important;
        }
    </style>
</head>

<body>
    @include('includes.header')
    <div class="container" style="min-height: 75vh;">
        @yield('content')
    </div>
    @include('includes.footer')

    <script src="{{ \App\Helpers\asset('js/popper.min.js') }}"></script>
    <script src="{{ \App\Helpers\asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ \App\Helpers\asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ \App\Helpers\asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ \App\Helpers\asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ \App\Helpers\asset('js/jquery-confirm.min.js') }}"></script>
    <script src="{{ \App\Helpers\asset('js/spin.min.js') }}"></script>
    <script src="{{ \App\Helpers\asset('js/ladda.min.js') }}"></script>
    <script src="{{ \App\Helpers\asset('js/toastr/toastr.min.js') }}"></script>
    <script src="{{ \App\Helpers\asset('js/select2.min.js') }}"></script>
    <script src="{{ \App\Helpers\asset('js/datepicker/moment.min.js') }}"></script>
    <script src="{{ \App\Helpers\asset('js/datepicker/daterangepicker.min.js') }}"></script>
    <script src="{{ asset('js/commonFunctions.js') }}"></script>
    @yield('scripts')
    <script>
        toastr.options = {
            closeButton: true,
            progressBar: true,
            positionClass: "toast-top-right",
            timeOut: "3000",
        };
    </script>
</body>
</html>

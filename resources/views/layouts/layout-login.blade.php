<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=9">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
    <meta name="description" content="Order management system for restaurants and food shops with easy in-house order taking app and analytic portal. Process unlimited order with minimal setup in Quickly for Restaurants. Everything you need to get boost up sales with less effort.">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> Sign In to your FoodCourt | Quickly FoodCourt</title>
    <link rel="icon" href="{{ asset('img/restrogreen-36x36.png') }}">
    <link href="{{ \App\Helpers\asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ \App\Helpers\asset('css/jqueryUI/jquery-ui.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ \App\Helpers\asset('css/jquery-confirm.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ \App\Helpers\asset('css/toastr/toastr.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ \App\Helpers\asset('css/style-custom.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ \App\Helpers\asset('css/introLoader.css') }}" rel="stylesheet" type="text/css">
    <link href="{{\App\Helpers\asset('/css/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{\App\Helpers\asset('/css/flags/flag-icon.min.css')}}" rel="stylesheet"/>
    <link href="{{\App\Helpers\asset('/css/sign-up.css')}}" rel="stylesheet"/>
    <link href="{{\App\Helpers\asset('/css/icon.css')}}" rel="stylesheet"/>
    @yield('styles')
    <script src="{{ \App\Helpers\asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ \App\Helpers\asset('js/toastr/toastr.min.js') }}"></script>
    <script src="{{ \App\Helpers\asset('js/datepicker/moment.min.js') }}"></script>
    <script src="{{ \App\Helpers\asset('js/datepicker/daterangepicker.min.js') }}"></script>
    <script>
        toastr.options = {
            closeButton: true,
            progressBar: true,
            positionClass: "toast-top-right",
            timeOut: "3000",
        };
    </script>
    @yield('popover-js')
</head>

<body>


<div class="container col-md-12 pl-0 pr-0">
    <main role="main" style="min-height: 100vh;">
        @yield('content')
    </main>
</div>
<script >

    let timer;
    let seconds = 1000 * 60;
    let resendCount = 0 ;
    let csrf_token = $('meta[name="csrf-token"]').attr('content');

    function validateEmail(email) {
        var re = /^([_a-z0-9]+(\.[_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,5}))|\d+$/;
        return re.test(email);
    }
    $(document).ready(function() {
        $('#send_forget_password').click(function(){
            var errorElement = document.getElementById('forget_pass_error');
            errorElement.style.visibility = "hidden";
            var email = document.getElementById('email_forget_pass').value;

            if(email && validateEmail(email))
            {
                $.post("/account/forget-password",{email:email, _token: csrf_token}).done(function(data){
                    //console.log(data);
                    if(data["message"] == 'mail sent')
                    {
                        errorElement.style.visibility="visible";
                        errorElement.innerHTML = "E-mail is sent to the specified account";
                    }
                    else if(data["message"] == 'email or phone not registered!')
                    {
                        errorElement.style.visibility="visible";
                        errorElement.innerHTML = "Email or Phone is not registered!";
                    }
                    else if(data["message"] == 'verification code sent')
                    {
                        errorElement.style.visibility="visible";
                        errorElement.innerHTML = "Verification code is sent to the specified account";
                        $('#showVerificationBox').show();
                        $('#forget_pass').hide();
                    }else{
                        errorElement.style.visibility="visible";
                        errorElement.innerHTML = data["message"];
                    }
                });
            }
            else if(!email)
            {
                //enter email
                errorElement.style.visibility="visible";
                errorElement.innerHTML = "Required";
            }
            else if(!validateEmail(email))
            {
                //enter valid email
                errorElement.style.visibility="visible";
                errorElement.innerHTML = "Invalid Email or Phone No";
            }
            return false;
        });
        $('#cancel_forget_password').click(function(){
            document.getElementById('forget_pass_section').style.display = "none";
        });
        $('#forget_password').click(function(){
            if(document.getElementById('forget_pass_section').style.display == "none")
                document.getElementById('forget_pass_section').style.display = "inherit";
            else
                document.getElementById('forget_pass_section').style.display = "none";
            return false;
        });

        function resendFunction() {
            let email = $('#email_forget_pass').val();

            $.post("/account/resend-otp",{email:email, _token: csrf_token}).done(function(data){

            });
        }
    });
</script>
@yield('scripts')

</body>

</html>


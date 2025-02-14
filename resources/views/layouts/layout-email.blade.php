<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compitable" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quickly Email</title>
    <style type="text/css">
        @media screen and (max-width:600px) {}

        @media screen and (max-width:400px) {}
    </style>
</head>

<body style="margin: 0; padding: 0; background-color: #ffffff;">
<!--dynamic content-->
@yield('content')
<center class="footer-wrapper " style="width: 100%; table-layout: fixed; background-color: #fcf9fc;">
    <div class="footer-webkit " style="max-width: 600px; background-color: #fcf9fc;">
        <table class="outer " align="center " style="margin: 0 auto; border-spacing: 0; font-family: 'helvetica neue', 'helvetica', 'arial', sans-serif; color: #4a4a4a;" width="100%">
            <tr>
                <td style="padding: 0; background: #fcf9fc;">
                    <table width="100% " style="border-spacing: 0;">
                        <tr>
                            <td style="padding: 20px; text-align: center;" align="center">
                                @if(isset($email))
                                    <p style="font-size: 12px;color:#8c8c8c; ">This email was sent to <a href="mailto:{{$email??''}}" style="text-decoration: none; color: #388CDA;">{{$email??''}}</a> to update you about important information regarding Quickly FoodCourt.</p>
                                @endif
                                <p style="font-size: 12px; color:#8c8c8c;line-height:22px; ">Copyright &copy; {{date('Y')}} Quickly Services, All rights reserved.</p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</center>
</body>
</html>

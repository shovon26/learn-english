
function validatePassword() {
    let flag = false;

    var newPassword=document.getElementById('new_password').value.trim();
    var confirm_new_password=document.getElementById('confirm_new_password').value.trim();

    // document.getElementById('change_curr_password_error').style.visibility = "hidden";
    document.getElementById('change_new_pass_error').style.visibility = "hidden";
    document.getElementById('change_confirm_pass_error').style.visibility = "hidden";

    let status = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[a-zA-Z0-9!@#$%^&*]{8,}$/.test(newPassword);
    if(!status || newPassword.length<8)
    {
        document.getElementById('change_new_pass_error').style.visibility = "visible";
        document.getElementById('change_new_pass_error').innerHTML = "Use minimum 8 characters that contain at least 1 lowercase, 1 uppercase, least 1 numeric character";
        flag = true;
    }

    if(newPassword !== confirm_new_password)
    {
        document.getElementById('change_confirm_pass_error').style.visibility = "visible";
        document.getElementById('change_confirm_pass_error').innerHTML = "Password mismatch";
        flag = true;
    }

    if(flag){
        return false;
    }
}

dirtyForm('#change-password');

// Code By Jamil
$(document).ready(function () {
    $('.toggle-password').mouseup(function () {
        $(this).toggleClass("eye-regular");
        let input = $(this).prevAll('input');
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });

    $('body').on('click', function (e) {
        $('[data-toggle="popover"]').each(function () {
            if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                $(this).popover('hide');
            }
        });
    });

    $('[data-toggle="popover"]').popover({
        html: true,
        trigger : 'hover',
        content: function () {
            return $('#popover-password').html();
        }
    });
    $('#new_password').keyup(function () {
        let password = $('#new_password').val();
        if (checkStrength(password) == false) {
            $('#sign-up').attr('disabled', true);
        }
    });
    $('#confirm_new_password').blur(function () {
        if ($('#new_password').val() !== $('#confirm_new_password').val()) {
            $('#popover-cpassword').removeClass('hide');
            $('#sign-up').attr('disabled', true);
        } else {
            $('#popover-cpassword').addClass('hide');
        }
    });

    function checkStrength(password) {
        let strength = 0;
        //If password contains both lower and uppercase characters, increase strength value.
        if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) {
            strength += 2;
            $('.low-upper-case').addClass('text-success');
            $('.low-upper-case i').removeClass('fa-times').addClass('fa-check');
            $('#popover-password-top').addClass('hide');
        } else {
            $('.low-upper-case').removeClass('text-success');
            $('.low-upper-case i').addClass('fa-times').removeClass('fa-check');
            $('#popover-password-top').removeClass('hide');
        }
        //If it has numbers and characters, increase strength value.
        if (password.match(/([0-9])/)) {
            strength += 1;
            $('.one-number').addClass('text-success');
            $('.one-number i').removeClass('fa-times').addClass('fa-check');
            $('#popover-password-top').addClass('hide');

        } else {
            $('.one-number').removeClass('text-success');
            $('.one-number i').addClass('fa-times').removeClass('fa-check');
            $('#popover-password-top').removeClass('hide');
        }
        if (password.length > 7) {
            strength += 1;
            $('.eight-character').addClass('text-success');
            $('.eight-character i').removeClass('fa-times').addClass('fa-check');
            $('#popover-password-top').addClass('hide');

        } else {
            $('.eight-character').removeClass('text-success');
            $('.eight-character i').addClass('fa-times').removeClass('fa-check');
            $('#popover-password-top').removeClass('hide');
        }
    }

    $('#change-password-form').submit(function(event) {
        event.preventDefault();
        let flag = validatePassword();

        if(flag != false){
            let formData = new FormData($(this)[0]);

            $.ajax({
                url: '/account/change-password',
                type: 'post',
                dataType: "json",
                contentType: false,
                processData: false,
                data: formData,
                cache: false,
                success: function(data) {
                    if(data['message']){
                        showSuccessMassage(data['message']);
                    }
                    setTimeout(function() {
                        window.location.reload();
                    }, 500);
                },
                error: function(request, status, error) {
                    document.getElementById('change_curr_password_error').innerHTML = "Wrong Current Password";
                    // console.log(request,status,error);
                }
            });
        }
    });
});

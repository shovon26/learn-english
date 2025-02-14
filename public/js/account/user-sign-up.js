$('.toggle-password').mouseup(function () {
    $(this).toggleClass("eye-regular");
    let input = $(this).prev('input');
    if (input.attr("type") === "password") {
        input.attr("type", "text");
    } else {
        input.attr("type", "password");
    }
});

$('#user-sign-up-form').submit(function (event) {
    event.preventDefault();
    console.log("Entered: ", );
    let data = new FormData();

    const username = $(this).find("input[name='username']").val() ?? "";
    const password = $(this).find("input[name='password']").val() ?? "";

    const payload = {
        username: username,
        password: password,
        _token:  $('meta[name="csrf-token"]').attr('content')
    };
    if(password.length < 8){
        const errorMessage = "The password must be at least 8 characters.";
        showErrorMassage(errorMessage);
        $('#signup-credential-error').text(errorMessage);
        return;
    }
    else{
        $('#signup-credential-error').text("");
    }
    $.ajax({
        url:  window.location.url,
        data: payload,
        type: 'post',
        success: function(data) {
            console.log({data});
            window.location.href = '/account/manage';
        },
        error: function(request, status, error) {
            const statusCode = request.status;
            if(statusCode === 400){
                $('#signup-credential-error').text('');
                let json = $.parseJSON(request.responseText);
                $.each(json.errors, function(key, value) {
                    $('#signup-credential-error').text(value);
                });
            }
            else{
                showErrorMassage("Something went wrong");
            }
        }
    });
});

/* function login and register */
$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
        }
    });

    $('#register').on('click', function(e) {
        e.preventDefault();
        $('#showregister').click();
        setTimeout(function() {
            $('#loginModal').modal('show');    
        }, 230);
    });

    $('#login').on('click', function(e) {
        e.preventDefault();
        $('#showlogin').click();
        setTimeout(function() {
            $('#loginModal').modal('show');    
        }, 230);
    });

    $("form[name='frmLogin']").submit(function(e) {
        e.preventDefault();
        var form = $(this);
        var errorElement = $('.error');
        $.ajax({
            url: baseURL + "/login",
            type: "POST",
            dataType: 'JSON',
            data : form.serialize(),
            success: function(data) { 
                if (data.success) {
                    window.location.assign(data.url);
                } else {
                    showError(errorElement, data);
                }
            },
            error: function(errors) {
                showError(errorElement, errors);
            }

        });
    });

    $("form[name='frmRegister']").submit(function(e) {
        e.preventDefault();
        var form = $(this);
        var errorElement = $('.error-register');
        $.ajax({
            url: baseURL + "/register",
            type: "POST",
            dataType: 'JSON',
            data : form.serialize(),
            success: function(data) { 
                if (data.success) {
                    window.location.assign(data.url);
                } else {
                    showError(errorElement, data);
                }
            },
            error: function(errors) {
                showError(errorElement, errors);
            }

        });
    });

    showRegisterLogin('#showregister', '.loginBox', '.registerBox', '.login-footer', '.register-footer');
    showRegisterLogin('#showlogin', '.registerBox', '.loginBox', '.register-footer', '.login-footer');

});

function showRegisterLogin(selector, selectOut, selectIn, footerOut, footerIn) {
    $(selector).on('click', function(e) {
        e.preventDefault();
        $(selectOut).fadeOut('fast', function(e) {
            $(selectIn).fadeIn('fast');
            $(footerOut).fadeOut('fast', function() {
                $(footerIn).fadeIn('fast');
            });
            if ($('.modal-title').html() == register) {
                $('.modal-title').html(login);
                $('.with').html(loginWith);
            } else {
                $('.modal-title').html(register);
                $('.with').html(registerWith);
            }
        }); 
        $('.error').removeClass('alert alert-danger').html('');
    });
}

function showError(errorElement, data) {
    errorElement.empty();
    errorElement.addClass('alert alert-danger');
    try {
        var errorMsg = JSON.parse(data.responseText);
        for (var key in errorMsg) {
            errorElement.append('<li>' + errorMsg[key] + '</li>');
        }
    } catch (e) {
        errorElement.html('<li>' + data.messages + '</li>');
    }
    shakeModal();
}

function shakeModal() {
    $('#loginModal .modal-dialog').addClass('shake');
    setTimeout(function() { 
        $('#loginModal .modal-dialog').removeClass('shake'); 
    }, 1000); 
}
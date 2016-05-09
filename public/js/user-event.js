/* user function */
$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
        }
    });

    $(".btnTaskFinish").on('click', function(e) {
        var userTaskId = $(this).val();
        var errorElement = $('.error');
        var messageElement = $('.message');
        $(this).attr('disabled', 'disabled');
        $.ajax({
            url: baseURL + "/user-task/" + userTaskId,
            type: "PUT",
            success: function(data) { 
                if (data.success) {
                    messageElement.removeClass('hidden').text(finish_task);
                } else {
                    showError(errorElement, data);
                }
            },
            error: function(errors) {
                showError(errorElement, errors);
            }
        });
    });
});
/* subject task function */
$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
        }
    });

    var rowNum = 0;
    $('#addRow').on('click', function(e) {
        e.preventDefault();
        rowNum ++;
        var $panel = $(".template .panel.panel-default").clone();
        $panel.find("input[type=button]").attr("onclick", "removeRow(" + rowNum + ")");
        $panel.find("input[type=text]").attr("name", "taskName[]");
        $panel.find("textarea").attr("name", "taskDescription[]");
        $panel.attr("id", "rowNum" + rowNum);
        $panel.appendTo("#itemRows");
    });

    $(".btnAddTask").on('click', function(e) {
        e.preventDefault();
        $form = $("form[name=formAddTask]");
        var subject_id = $form.find('input[name=subject_id]').val();
        var urlGet = baseURL + "/admin/subject/" + subject_id + "/edit";
        var errorElement = $('.error');
        $.ajax({
            url: baseURL + "/admin/task",
            type: "POST",
            dataType: "JSON",
            data : $form.serialize(),
            success: function(data) { 
                if (data.success) {
                    $.get(urlGet, function(html) { 
                        $("html").empty();
                        $("html").html(html);  
                    });
                } else {
                    showError(errorElement, data);
                }
            },
            error: function(errors) {
                showError(errorElement, errors);
            }

        });
    });

    $(".btnUpdateTask").on('click', function(e) {
        e.preventDefault();
        var id = $(this).attr("task");
        var name = $('#name-' + id).val();
        var description = $('#description-' + id).val();
        var subject_id = $('#subject-id').val();
        var urlGet = baseURL + "/admin/subject/" + subject_id + "/edit";
        var errorElement = $('.error');
        $.ajax({
            url: baseURL + "/admin/task/" + id,
            type: "PUT",
            dataType: 'JSON',
            data : { name: name, description: description },
            success: function(data) { 
                if (data.success) {
                    $.get(urlGet, function(html) { 
                        $("html").empty();
                        $("html").html(html);  
                    });
                } else {
                    showError(errorElement, data);
                }
            },
            error: function(errors) {
                showError(errorElement, errors);
            }

        });
    });

    $(".btnDeleteTask").on('click', function(e) {
        e.preventDefault();
        var check = confirm(confirm_delete);
        var errorElement = $('.error');
        if (check) {
            var id = $(this).attr("task");
            $.ajax({
                url: baseURL + "/admin/task/" + id,
                type: "DELETE",
                success: function(data) { 
                    if (data.success) {
                        $('#task-' + id).remove();
                    } else {
                        showError(errorElement, data);
                    }
                },
                error: function(errors) {
                    showError(errorElement, errors);
                }

            });
        }
        
    });

    $(".btnDeleteCourseSubject").on('click', function(e) {
        e.preventDefault();
        var check = confirm(confirm_delete);
        var errorElement = $('.error');
        if (check) {
            var id = $(this).attr("course-subject");
            $.ajax({
                url: baseURL + "/admin/course-subject/" + id,
                type: "DELETE",
                success: function(data) { 
                    if (data.success) {
                        $('#course-subject-' + id).remove();
                    } else {
                        showError(errorElement, data);
                    }
                },
                error: function(errors) {
                    showError(errorElement, errors);
                }

            });
        }
        
    });

    $(".btnAddSubject").on('click', function(e) {
        e.preventDefault();
        $form = $("form[name=formAddSubject]");
        var course_id = $form.find('input[name=course_id]').val();
        var urlGet = baseURL + "/admin/course/" + course_id + "/edit";
        var errorElement = $('.error');
        $.ajax({
            url: baseURL + "/admin/course-subject",
            type: "POST",
            dataType: "JSON",
            data : $form.serialize(),
            success: function(data) { 
                if (data.success) {
                    $.get(urlGet, function(html) { 
                        $("html").empty();
                        $("html").html(html);  
                    });
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

function removeRow(rowNum) {
    $('#rowNum' + rowNum).remove();
}
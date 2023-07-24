async function getAllAuthors() {

    $.ajax({
        url: "/api/tasks",
        type: "GET",
        success: (data) => {
            const tasks = data.data;
            tasks.map(task =>{
                $('.body').append(createTaskCard(task));
            });
        },
        error: (error) => {
            alert(error);
        }
    });
}
getAllAuthors()

$('#add_task').on('submit', async function (e) {
    e.preventDefault()

    $.ajax({
        url: $(this).attr("action"),
        type: $(this).attr("method"),
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: (data) => {
            alertShow($('#successAlert'))
            $('.body').append(createTaskCard(data.data))
        },
        error: (xhr) => {
            alertShow($('#errorAlert'));
            alert(xhr.responseJSON);
        }
    });
});

$('#edit_task').on('submit',async function (e) {
    e.preventDefault()

    const url = $(this).attr("action") + $('#edit_task input[name="id"]').val()
    const formData = new FormData(this)
    const data = {
        'title': formData.get('title'),
        'status_id': formData.get('status_id')
    }
    $.ajax({
        url: url,
        type: $(this).attr("method"),
        data: JSON.stringify(data),
        processData: false,
        contentType: "application/json",
        success: (data) => {
            alertShow($('.alert-success'))
            editTaskCard(data.data)
        },
        error: (xhr) => {
            alertShow($('#errorAlert'));
            alert(xhr.responseJSON);
        }
    });
});

async function deleteTask(btn) {

    $.ajax({
        url: $(btn).data('link'),
        type: 'DELETE',
        processData: false,
        contentType: false,
        success: (data) => {
            $('.task-' + data).remove()
        },
        error: (xhr) => {
            alertShow($('#errorAlert'));
            alert(xhr.responseJSON);
        }
    });
}

function createTaskCard(task) {
    return $("<div class=\"card w-100 task-" + task.id + "\">\n" +
        "<div class=\"card-body\">\n" +
            "<form name=\"taskForm\">\n" +
                "<div class=\"taskCard taskTitle task-" + task.id + "\">\n" +
                    "<p class=\"title\" id=\"title\" onformdata=\"title\">" + task.title + "</p>\n" +
                    "<input class=\"name\" name=\"id\" readOnly type=\"hidden\" value=\"" + task.id + "\">\n" +
                    "<input class=\"name\" name=\"status_id\" readOnly type=\"hidden\" value=\"" + task.status.id + "\">\n" +
                    "<span class=\"badge badge-light\" id=\"status\">"+task.status.name+"</span>\n"+
                "</div>\n" +

                "<div class=\"btn-group btn-card taskCard\">\n" +
                    "<button type=\"button\" class=\"btn btn-info\"  onclick=\"openTaskForm(this)\" data-toggle=\"modal\" data-target=\"#editModalWindow\">\n" +
                        "Edit\n" +
                    "</button>\n" +
                    "<button type=\"button\" class=\"btn btn-danger\" onClick=\"deleteTask(this)\" data-link=\"/api/tasks/delete/"+ task.id +"\">\n" +
                        "Delete\n" +
                    "</button>\n" +
                "</div>\n" +
            "</form>\n" +
        "</div>\n" +
    "</div>")
}

function alertShow(alert) {
        alert.css('display', 'block')
        setTimeout(function(){
            alert.css('display', 'none')
        }, 3000)
}

function editTaskCard(task) {
    $(`.task-${task.id}`).children("p[id='title']").text(task.title);
    $(`.task-${task.id}`).children("span[id='status']").text(task.status.name)
}

function openTaskForm(btn) {

    const taskForm = $(btn).parent().parent()

    const taskBox = taskForm.children(".taskTitle")
    $("input[name='id']").val(taskBox.children("input[name='id']").val())
    $("textarea[name='title']").val(taskBox.children("p[id='title']").text())
    $("select[name='status_id']").val(taskBox.children("input[name='status_id']").val())
}

$("textarea[name='title']").on('input', function () {
    $(this).val() ? $('#subBtn').removeAttr('disabled') : $('#subBtn').attr('disabled', 'disabled');
})

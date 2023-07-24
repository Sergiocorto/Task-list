<!doctype html>
<html lang="en" xmlns:th="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/index.css">
    <title>Tasks</title>
</head>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/">Tasks list</a>
</nav>
<body>
<div class="row m-1">
    <div class="col-10">
        <div class = "container">
            <div class = "row" id="tasks">
                <div class = "container">
                    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#exampleModal">
                        Add Task
                    </button>
                </div><div class="container body">

                </div>

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div id="successAlert" class="alert alert-success alert-add-task" role="alert">Task added success </div>
            <div id="errorAlert" class="alert alert-danger alert-add-task" role="alert">Error</div>
            <form id="add_task" method = "POST" action="/api/tasks">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-9 pr-1">
                            <div class="form-group">
                                <label>Write task</label>
                                <textarea name="title" type="text" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="subBtn" class="btn btn-primary" disabled>Add task</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="editModalWindow" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="alert alert-success alert-edit-task" role="alert">Task updated success</div>
            <div class="alert alert-danger alert-edit-task" role="alert">Error </div>
            <form id="edit_task" method = "patch" action="/api/tasks/update/">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-9 pr-1">
                            <div class="form-group">
                                <label>Write task</label>
                                <textarea name="title" type="text" class="form-control"></textarea>
                                <input class="name" name="id" readOnly type="hidden">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status_id">
                                    <option value = 1>Completed</option>
                                    <option value = 2>Not completed</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button name ="submit" type="submit" class="btn btn-primary">Update task</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="/js/jquery-3.5.1.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/script.js"></script>
</body>
</html>

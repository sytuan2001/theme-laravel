<!DOCTYPE html>
<html>
<head>
    <title>Todo List</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<body>
<div class="container">
    <h1>Todo List</h1>
    <div class="row">
        <div class="col-md-6">
            <div class="input-group">
					<span class="input-group-addon">
						<input type="checkbox">
					</span>
                <input type="text" class="form-control" placeholder="Task 1">
            </div>
        </div>
        <div class="col-md-6">
            <button type="button" class="btn btn-default" aria-label="Left Align">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            </button>
            <button type="button" class="btn btn-default" aria-label="Left Align">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            </button>
            <button type="button" class="btn btn-danger">
                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
            </button>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addTaskModal">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </button>
        </div>
    </div>

    <!-- Modal-->
    <div class="modal fade" id="exampleModalCreate" tabindex="-1" aria-labelledby="exampleModalLabelCreate"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('tasks.store')}}" method="POST" id="form_create">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add new Task</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>
                            <input type="text" placeholder="Nhập ở đây" id="addItem" name="title" class="form-control">
                        </p>
                        <div>
                            <textarea name="description" class="form-group" cols="60" rows="10" placeholder="Mô tả"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                style="display: none">Close</button>
                        <button id="addTaskButton" class="btn btn-primary" data-toggle="modal" data-target="#addTaskModal">Add Task</button>
                        <button type="button" class="btn btn-primary" id="saveTaskButton">Save Changes</button>
                        {{ csrf_field() }}
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<script>

</script>
<!--

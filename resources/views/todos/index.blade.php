<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todo List</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<body>
<div class="container">
    <h1>Todo List</h1>
    <div class="container">
           <span class="btn btn-default">
						<input type="checkbox">
					</span>
           <button type="button" class="btn btn-default" aria-label="Left Align">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            </button>
            <button type="button" class="btn btn-default" aria-label="Left Align">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            </button>
            <button type="button" class="btn btn-danger">
                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
            </button>
            <button type="button" class="add-task-btn"  id="add-task-btn">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </button>
        </div>
    </div>
    <div id="tasks-list">
    <ul>
        @foreach($tasks as $task)
            <li>
                <input type="checkbox" name="task_status" value="{{$task->id}}" {{$task->status == 1 ? 'checked' : ''}}>
                <span>{{$task->title}}</span>
                <a href="#" class="delete-task" data-id="{{$task->id}}">Delete</a>
            </li>
        @endforeach
    </ul>
    </div>

    <!--Modal-->
{{--<button type="button" class="add-task-btn">+</button>--}}
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
//cut
<div class="modal">
    <div class="modal-content">
        <form id="add-task-form" method="POST">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add new Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            @csrf
            <input type="text" name="title" placeholder="Title" required>
            <textarea name="description" placeholder="Description"></textarea>
            <button type="submit">Add Task</button>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Mở modal khi nhấn nút "+"
        $('.add-task-btn').click(function() {
            $('.modal fade').show();
        });

        // Đóng modal khi nhấn nút "x"
        $('.modal .close').click(function() {
            $('.modal').hide();
        });

        // Thêm task bằng Ajax
        $('#add-task-form').submit(function(e) {
            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '{{route("tasks.store")}}',
                type: 'POST',
                data: $('#add-task-form').serialize(),
                success: function(response) {
                    $('#tasks-list ul').append('<li><input type="checkbox" name="task_status" value="' + response.task.id + '"><span>' + response.task.title + '</span><a href="#" class="delete-task" data-id="' + response.task.id + '">Delete</a></li>');
                    $('.modal').hide();
                },
                error: function(response) {
                    console.log(response);
                }
            });
        });

        // Xóa task bằng Ajax
        $(document).on('click', '.delete-task', function(e) {
            e.preventDefault();

            var taskId = $(this).data('id');
            var taskItem = $(this).parent('li');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/tasks/' + taskId,
                type: 'DELETE',
                success: function(response) {
                    taskItem.remove();
                },
                error: function(response) {
                    console.log(response);
                }
            });
        });
    });
</script>


<!--

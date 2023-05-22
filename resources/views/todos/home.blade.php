@extends('admin')

@section('home')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h3>Quản lý Task</h3>
                </div>
                <div class="col-md-6">
                    <button type="button" class="btn btn-primary float-end" data-toggle="modal" data-target="#createTaskModal" id="add-task-btn">
                        Tạo task mới
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Người tạo</th>
                        <th>Người xử lý</th>
                        <th>Start At</th>
                        <th>End At</th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo</th>
                    </tr>
                </thead>
                <tbody id="tasksTableBody">
                    @foreach($tasks as $task)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->description }}</td>
                        <td>{{ $task->user->name }}</td>
                        <td>{{ Auth::user()->name }}</td>
                        <td>{{ $task->start_at }}</td>
                        <td>{{ $task->end_at }}</td>
                        <td>
                            <select onchange="updateTaskStatus(this, {{ $task->id }})">
                                <option value="{{ \App\Models\Task::STATUS_TODO }}" {{ $task->status == \App\Models\Task::STATUS_TODO ? 'selected' : '' }}>
                                    Todo
                                </option>
                                <option value="{{ \App\Models\Task::STATUS_IN_PROGRESS }}" {{ $task->status == \App\Models\Task::STATUS_IN_PROGRESS ? 'selected' : '' }}>
                                    In Progress
                                </option>
                                <option value="{{ \App\Models\Task::STATUS_DONE }}" {{ $task->status == \App\Models\Task::STATUS_DONE ? 'selected' : '' }}>
                                    Done
                                </option>
                            </select>
                        </td>

                        <td>{{ $task->created_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal tạo task mới -->
<div class="modal fade" id="createTaskModal" tabindex="-1" role="dialog" aria-labelledby="createTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTaskModalLabel">Tạo task mới</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="createTaskForm" method="POST" action="{{route('tasks.store') }}">
                    @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <div class="form-group">
                        <label for="title">Tiêu đề:</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Mô tả:</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="start_at">Ngày bắt đầu:</label>
                        <input type="date" class="form-control" id="start_at" name="start_at" required>
                    </div>
                    <div class="form-group">
                        <label for="end_at">Ngày kết thúc:</label>
                        <input type="date" class="form-control" id="end_at" name="end_at" required>
                    </div>
                    <div class="form-group">
                        <label for="user_id">Người xử lý:</label>
                        <select class="form-control" id="user_id" name="user_id">
                                <option value="">Chọn người xử lý</option>
                                @foreach($users as $user)
                                    @if($user->role_id < $user->name)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endif
                                @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="submit" form="createTaskForm" class="btn btn-primary">Tạo</button>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
</script>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $('#createTaskForm').click(function (event) {
        event.preventDefault();
        var form = $('#createTaskForm');
        var url = form.attr('action');

        $.ajax({
            type: 'POST',
            url: url,
            data: form.serialize(),
            success: function (data) {
                if (data.success) {
                    $('#createTaskModal').modal('hide');
                    location.reload();
                }
            },
            error: function (xhr) {
                var errors = xhr.responseJSON.errors;
                $.each(errors, function (key, value) {
                    $('#' + key + '_error').text(value[0]);
                });
            }
        });
    });

</script>




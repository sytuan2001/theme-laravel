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
                        <td>{{ $task->created_by }}</td>
                        <td>{{ $task->user_id }}</td>
                        <td>{{ $task->start_at }}</td>
                        <td>{{ $task->end_at }}</td>
                        <td>
                            <select onchange="updateTaskStatus(this, {{ $task->id }})">
                                <option value="todo" {{ $task->status == 'todo' ? 'selected' : '' }}>Todo</option>
                                <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="done" {{ $task->status == 'done' ? 'selected' : '' }}>Done</option>
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
                <form id="createTaskForm">
                    @csrf
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
{{--                    <div class="form-group">--}}
{{--                        <label for="user_id">Người xử lý:</label>--}}
{{--                        <select class="form-control" id="user_id" name="user_id" required>--}}
{{--                            <option value="">Chọn người xử lý</option>--}}
{{--                            @foreach($tasks as $task)--}}
{{--                                <option value="{{ $tasks->id }}">{{ $tasks->name }}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}
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
    $('#createTaskForm').submit(function(event) {
        event.preventDefault(); // Ngăn chặn form được gửi đi

        // Lấy thông tin từ form
        var formData = $(this).serialize();

        // Gửi yêu cầu tạo task bằng AJAX
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            success: function(response) {
                // Thêm task mới vào danh sách hiển thị
                var task = response.task;
                var taskHtml = '<div class="card mb-3">' +
                    '<div class="card-body">' +
                    '<h5 class="card-title">' + task.title + '</h5>' +
                    '<p class="card-text">' + task.description + '</p>' +
                    '<p class="card-text"><small class="text-muted">' + task.created_by + '</small></p>' +
                    '</div>' +
                    '</div>';
                $('#taskList').prepend(taskHtml);

                // Đóng modal
                $('#createTaskModal').modal('hide');

                // Xóa dữ liệu trong form
                $('#createTaskForm')[0].reset();
                // Hiển thị thông báo thành công
                alert('Tạo task thành công!');
            },
            error: function(response) {
                alert('Có lỗi xảy ra khi tạo task.');
            }
        });
    });
</script>




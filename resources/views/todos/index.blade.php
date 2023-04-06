@extends('layouts.layout')

@section('content')
    <div class="container">
        <h1>Todo List</h1>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addTaskModal">Add Task</button>
        <form id="delete-form" action="{{ route('tasks.delete') }}" method="POST">
            @csrf
            <table class="table table-striped">
                <thead>
                <tr>
                    <th></th>
                    <th>Title</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td><input type="checkbox" name="task[]" value="{{ $task->id }}"></td>
                        <td>{{ $task->title }}</td>
                        <td><a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary">Edit</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <button type="submit" class="btn btn-danger">Delete Selected</button>
        </form>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addTaskModal" tabindex="-1" role="dialog" aria-labelledby="addTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTaskModalLabel">Add Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('tasks.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control" id="title" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" id="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="completed">Completed</label>
                            <input type="checkbox" name="completed" class="form-control" id="completed">
                        </div>
                        <button type="submit" class="btn btn-primary">Save Task</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#addTaskForm').submit(function(event) {
                event.preventDefault(); // Prevent default form submission
                var formData = $(this).serialize(); // Serialize form data
                $.ajax({
                    type: 'POST',
                    url: '{{ route("tasks.store") }}',
                    data: formData,
                    success: function(data) {
                        $('#addTaskModal').modal('hide'); // Hide the modal
                        $('#tasksTable').append(data); // Append the new task to the table
                        toastr.success('Task added successfully.'); // Show success message
                    },
                    error: function(data) {
                        toastr.error('Error adding task.'); // Show error message
                    }
                });
            });
        });
    </script>

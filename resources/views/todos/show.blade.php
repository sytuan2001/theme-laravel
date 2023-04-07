<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todo list</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Todo List</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="btn-group">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    </div>
                    <button type="button" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button>
                    <button type="button" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> < </button>
                    <button type="button" class="btn btn-secondary"><i class="fas fa-arrow-right"></i> > </button>
                </div>
            </div>
            <div class="">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-add"><i class="fas fa-plus"></i>+</button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Title</th>
                    <th style="width: 40px">Status</th>
                    <th style="width: 80px">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td>{{ $task->id }}</td>
                        <td><strong>{{ $task->title }}</strong><br>{{ Str::limit($task->description, 100) }}</td>
                        <td><input type="checkbox" {{ $task->status == 1 ? 'checked' : '' }}></td>
                        <td><button type="button" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button></td>
                    </tr>
                @endforeach
                <!-- more rows... -->
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal for adding new task -->
<div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTaskModalLabel">Add New Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for adding new task -->
                <form id="addTaskForm">
                    <div class="mb-3">
                        <label for="taskTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" id="taskTitle" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="taskDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="taskDescription" name="description" rows="3" required></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="addTaskButton">Save Task</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        // Open modal for adding new task
        $('#addTaskButton').click(function() {
            $('#addTaskModal').modal('show');
        });

        // Add new task
        $('#addTaskForm').submit(function(event) {
            event.preventDefault();
            var title = $('#taskTitle').val();
            var description = $('#taskDescription').val();
            $.ajax({
                url: "{{ route('tasks.store') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "title": title,
                    "description": description
                },
                success: function(response) {
                    // Reload page to display new task
                    location.reload();
                },
                error: function(response) {
                    console.log(response);
                }
            });
        });
    });
</script>
</body>

</html>

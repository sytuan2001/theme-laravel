@extends('admin')

@section('home')
<div class="container">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <ul class="list-group">
                <li class="list-group-item" id="addNew">Todo list</li>
                <li class="list-group-item">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#">
                                    <div class="checkbox">
                                        <input type="checkbox" value="" id="chkCheckAll">
                                    </div>
                                </a></li>
                            <li class="page-item"><a class="page-link" href="#" id="deleteAllSelectedRecord"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                    </svg></a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            <li class="page-item"><a class="page-link" href="#" data-bs-toggle="modal" data-bs-target="#exampleModalCreate">+</a></li>
                        </ul>
                    </nav>
                </li>
                @foreach ($tasks as $task)
                <li class="list-group-item ourItem" id="sid{{ $task->id }}">
                    <div class="form-check">
                        <input class="form-check-input task-check" type="checkbox" value="{{ $task->id }}" name="ids" @if($task->status) checked @endif>
                        <label class="form-check-label @if($task->status) task-done @endif" for="flexCheckIndeterminate">
                            <h5><span class="label-text @if($task->status) task-done-text @endif" data-id="{{ $task->id }}"><strong>{{ $task->title }}</strong></span>
                                - <span class="task-description @if($task->status) task-done-text @endif">{{ Str::limit($task->description, 50) }}</span></h5>
                        </label>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    <!-- Modal nội dung -->
    <div class="modal fade" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="taskModalLabel">Nội Dung Chi Tiết</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 id="taskModalTitle"></h5>
                    <p id="taskModalDescription"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal +++ -->
    <div class="modal fade" id="exampleModalCreate" tabindex="-1" aria-labelledby="exampleModalLabelCreate" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add new Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('tasks.store') }}" method="POST" id="form_create">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="addItem" class="form-label">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title_add" name="title" placeholder="Nhập tiêu đề">
                            <div class="invalid-feedback hidden"></div>

                        </div>
                        <div class="mb-3">
                            <label for="addDescription" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description_add" name="description" rows="3" placeholder="Nhập nội dung"></textarea>

                            <div class="invalid-feedback hidden"></div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="addTaskButton" class="btn btn-primary" data-toggle="modal" data-target="#addTaskModal">Save changes</button>
                        {{ csrf_field() }}
                    </div>
                </form>

            </div>
        </div>
    </div>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
</script>
<script>
    $(document).ready(function() {
        $('#form_create').submit(function(e) {
            e.preventDefault();
            var that = $(this);
            var title = $('#title_add').val();
            var description = $('#description_add').val();
            $('.invalid-feedback').hide();
            $('.invalid-feedback').html('');
            $.ajax({
                url: that.attr('action'),
                type: that.attr('method'),
                dataType: "json",
                data: that.serialize(),
                success: function(response) {
                    $('#exampleModalCreate').modal('hide');
                    $('#form_create').trigger("reset");
                    $.get('/tasks', function(data) {
                        $('#tasksTable').html(data);
                    });
                },

                error: function(xhr, status, error) {
                    $.each(xhr.responseJSON.errors, function(index, value) {
                        $('#' + index + '_add').next().html(value);
                        $('#' + index + '_add').next().show();
                    });
                }
            }).done(function() {
                $.get('/tasks', function(data) {
                    $('#tasksTable').html(data);
                });
            });

        });
    });
</script>


<script>
    $(function(e) {
        $("#chkCheckAll").click(function() {
            $(".form-check-input").prop('checked', $(this).prop('checked'));
        });
        $("#deleteAllSelectedRecord").click(function(e) {
            e.preventDefault();
            var allIds = [];

            $("input:checkbox[name=ids]:checked").each(function() {
                allIds.push($(this).val());
            });

            $.ajax({
                url: "{{ route('tasks.deleteSelected') }}",
                type: "DELETE",
                data: {
                    _token: $("input[name=_token]").val(),
                    ids: allIds
                },
                success: function(response) {
                    $.each(allIds, function(key, val) {
                        $("#sid" + val).remove();
                    })
                }
            });
        })
    });
</script>
<script>
    $(document).on('change', '.task-check', function() {
        var id = $(this).val();
        var status = $(this).is(":checked") ? 1 : 0;
        $.ajax({
            url: '/tasks/' + id + '/toggle',
            type: 'PUT',
            data: {
                status: status
            },
            success: function(response) {
                $('#exampleModal').modal('hide');
                $('#tasksTable').load('/tasks');

                var task = response.task;
                var taskElem = $('#sid' + task.id);
                var labelElem = taskElem.find('.label-text');
                var descElem = taskElem.find('.task-description');

                labelElem.text(task.title);
                descElem.text(task.description);
                if (task.status == 1) {
                    labelElem.css('text-decoration', 'line-through');
                } else {
                    labelElem.css('text-decoration', 'none');
                }
            },

            error: function(xhr, status, error) {}
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.label-text').on('click', function() {
            var title = $(this).text();
            var description = $(this).siblings('.task-description').text();

            $('#taskModalTitle').text(title);
            $('#taskModalDescription').text(description);

            $('#taskModal').modal('show');

        });

        $('.modal-footer button[data-dismiss="modal"]').on('click', function() {
            $('#taskModal').modal('hide');
        });
    });
</script>
<script>
    $(document).ready(function() {
    $('#addTaskButton').click(function() {
        location.reload();
    });
});

</script>
</div>
@endsection
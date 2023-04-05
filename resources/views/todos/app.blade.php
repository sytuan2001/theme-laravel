<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>Todo Lists</title>
</head>
<body>
<h1>Todos List</h1>
<hr>

<h2>Add new task</h2>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ url('/todos') }}" method="POST">
    @csrf
    <input type="text" class="form-control" name="task" placeholder="Add new task" >
    <button class="btn btn-primary" type="submit">Add</button>
</form>
<hr>

<h2>Pending tasks</h2>
<ul class="list-group">
    @foreach($tasks as $task)
        <li class="list-group-item">
            {{ $task->id }}
            <button class="btn btn-primary" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapse-{{ $loop->index }}" aria-expanded="false">
                Edit
            </button>
            <form action="{{ url('todos/'.$task->id) }}" method="POST" style="display: inline-block;">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                         height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                        <path
                            d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0
                            9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0
                            1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.
                            538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0
                            1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.
                            47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .4
                            7.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1
                             .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                    </svg></button>
            </form>

            <div class="collapse mt-2" id="collapse-{{ $loop->index }}">
                <div class="card card-body">
                    <form action="{{ url('todos/'.$task->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="text" name="task" value="{{ $task->id }}">
                        <button class="btn btn-secondary" type="submit">Update</button>
                    </form>
                </div>
            </div>
        </li>
    @endforeach
</ul>
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>

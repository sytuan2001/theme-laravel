<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Page Todo App</title>
    <link rel="stylesheet" href="{{ asset('cssfile/style.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
<div class="container mt-5">
    <div class="d-flex justify-content-center row">
        <div class="col-md-6">
            <div class="p-4 bg-white notes">
                <div class="">
                    <h4>Todo list</h4>
                </div>
            </div>
            <div class="p-3 bg-white">
                <div class="d-flex align-items-center"><label><input type="checkbox"
                                                                     class="option-input radio"><span class="label-text">AdminLTE 3.0 Issue
                                -Trying to find a solution to this problem...</span></label></div>
                <div class="d-flex align-items-center"><label><input type="checkbox"
                                                                     class="option-input radio"><span class="label-text">AdminLTE 3.0 Issue
                                -Trying to find a solution to this problem...</span></label></div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    $(document).ready(function() {
        $('input[type=checkbox]').change(function() {

            if (this.checked) {
                $(this).next(".label-text").css("text-decoration-line", "line-through");
            } else {
                $(this).next(".label-text").css("text-decoration-line", "none");
            }

        });
    });
</script>
</body>


</html>

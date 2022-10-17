<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <title>Изменить статус посещения</title>
</head>
<body>
<div class="col-md-12">
        <h1>Изменить статус посещения</h1>

    <form method="POST" enctype="multipart/form-data" action="{{ route('appointments_admin.update', $appointments_admin) }}">
        <div>
            @isset($appointments_admin)
                @method('PUT')
            @endisset
            @csrf
            <div class="input-group row">
                <label for="isNow_show" class="col-sm-2 col-form-label">Статус посещения: </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="isNow_show" id="isNow_show"
                           value="@isset($appointments_admin){{ $appointments_admin->isNow_show }}@endisset">
                </div>
            </div>
            <br>
            <button class="btn btn-success">Сохранить</button>
        </div>
    </form>
</div>
</body>
</html>

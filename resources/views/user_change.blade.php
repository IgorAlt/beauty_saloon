<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <title>Изменить информацию</title>
</head>
<body>
<div class="col-md-12">

    <form method="POST" enctype="multipart/form-data"
          action="{{ route('update-user-information', $user) }}">
        <div>
                @method('PUT')
            @csrf
            <div class="input-group row">
                <label for="name" class="col-sm-2 col-form-label">Имя: </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" id="name"
                           value="{{ Auth::user()->name }}">
                </div>
            </div>
            <br>
            <div class="input-group row">
                <label for="phone" class="col-sm-2 col-form-label">Номер телефона: </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="phone" id="phone"
                           value="{{ Auth::user()->phone  }}">
                </div>
            </div>
            <br>
            <div class="input-group row">
                <label for="email" class="col-sm-2 col-form-label">Электронная почта: </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" id="email"
                           value="{{ Auth::user()->email  }}">
                </div>
            </div>
            <br>
            <button class="btn btn-success">Сохранить</button>
        </div>
    </form>
</div>
</body>
</html>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <title>Редактирование пользователя</title>
</head>
<body>
<div class="col-md-12">
        <h1>Редактировать пользователя <b>{{ $user_admin->name }}</b></h1>

    <form method="POST" enctype="multipart/form-data" action="{{ route('user-admin.update', $user_admin) }}">
        <div>
            @isset($user_admin)
                @method('PUT')
            @endisset
            @csrf
            <div class="input-group row">
                <label for="name" class="col-sm-2 col-form-label">Имя: </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" id="name"
                           value="@isset($user_admin){{ $user_admin->name }}@endisset">
                </div>
            </div>
            <br>
            <div class="input-group row">
                <label for="email" class="col-sm-2 col-form-label">Электронная почта: </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" id="email"
                           value="@isset($user_admin){{ $user_admin->email }}@endisset">
                </div>
            </div>
            <br>
                <div class="input-group row">
                    <label for="phone" class="col-sm-2 col-form-label">Номер телефона: </label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="phone" id="phone"
                               value="@isset($user_admin){{ $user_admin->phone }}@endisset">
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="loyalty_level" class="col-sm-2 col-form-label">Уровень лояльности: </label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="loyalty_level" id="loyalty_level"
                               value="@isset($user_admin){{ $user_admin->loyalty_level }}@endisset">
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="full_sum" class="col-sm-2 col-form-label">Общая потраченная сумма: </label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="full_sum" id="full_sum"
                               value="@isset($user_admin){{ $user_admin->full_sum }}@endisset">
                    </div>
                </div>
            <br>
            <button class="btn btn-success">Сохранить</button>
        </div>
    </form>
</div>
</body>
</html>

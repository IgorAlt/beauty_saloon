<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <title>Добавить мастера</title>
</head>
<body>
<div class="col-md-12">
    @isset($masters_admin)
        <h1>Редактировать мастера <b>{{ $masters_admin->name }}</b></h1>
    @else
        <h1>Добавить мастера</h1>
    @endisset

    <form method="POST" enctype="multipart/form-data"
          @isset($masters_admin)
          action="{{ route('masters_admin.update', $masters_admin) }}"
          @else
          action="{{ route('masters_admin.store') }}"
        @endisset
    >
        <div>
            @isset($masters_admin)
                @method('PUT')
            @endisset
            @csrf
            <div class="input-group row">
                <label for="name" class="col-sm-2 col-form-label">Имя: </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" id="name"
                           value="@isset($masters_admin){{ $masters_admin->name }}@endisset">
                </div>
            </div>
            <br>
            <div class="input-group row">
                <label for="surname" class="col-sm-2 col-form-label">Фамилия: </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="surname" id="surname"
                           value="@isset($masters_admin){{ $masters_admin->surname }}@endisset">
                </div>
            </div>
            <br>
                <div class="input-group row">
                    <label for="phone_number" class="col-sm-2 col-form-label">Номер телефона: </label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="phone_number" id="phone_number"
                               value="@isset($masters_admin){{ $masters_admin->phone_number }}@endisset">
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="social_media" class="col-sm-2 col-form-label">Социальная сеть: </label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="social_media" id="social_media"
                               value="@isset($masters_admin){{ $masters_admin->social_media }}@endisset">
                    </div>
                </div>
                <br>
            <div class="input-group row">
                <label for="information" class="col-sm-2 col-form-label">Информация: </label>
                <div class="col-sm-6">
							<textarea name="information" id="information" cols="72"
                                      rows="7">@isset($masters_admin){{ $masters_admin->information }}@endisset</textarea>
                </div>
            </div>
            <br>
            <div class="input-group row">
                <label for="images" class="col-sm-2 col-form-label">Картинка: </label>
                <div class="col-sm-10">
                    <label class="btn btn-default btn-file">
                        Загрузить <input type="file" style="display: none;" name="images" id="images">
                    </label>
                </div>
            </div>
            <button class="btn btn-success">Сохранить</button>
        </div>
    </form>
</div>
</body>
</html>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <title>Добавить услугу</title>
</head>
<body>
<div class="col-md-12">
    @isset($services_admin)
        <h1>Редактировать услугу <b>{{ $services_admin->service }}</b></h1>
    @else
        <h1>Добавить услугу</h1>
    @endisset

    <form method="POST" enctype="multipart/form-data"
          @isset($services_admin)
          action="{{ route('services_admin.update', $services_admin) }}"
          @else
          action="{{ route('services_admin.store') }}"
        @endisset
    >
        <div>
            @isset($services_admin)
                @method('PUT')
            @endisset
            @csrf
            <div class="input-group row">
                <label for="service" class="col-sm-2 col-form-label">Услуга: </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="service" id="service"
                           value="@isset($services_admin){{ $services_admin->service }}@endisset">
                </div>
            </div>
            <br>
            <div class="input-group row">
                <label for="price" class="col-sm-2 col-form-label">Цена: </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="price" id="price"
                           value="@isset($services_admin){{ $services_admin->price }}@endisset">
                </div>
            </div>
            <br>
            <button class="btn btn-success">Сохранить</button>
        </div>
    </form>
</div>
</body>
</html>

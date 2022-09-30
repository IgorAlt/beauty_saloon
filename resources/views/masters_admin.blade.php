<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <title>Мастера</title>
</head>
<body>
    <h1>Мастера</h1>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Имя</th>
            <th scope="col">Фамилия</th>
            <th scope="col">Номер телефона</th>
            <th scope="col">Социальная сеть</th>
            <th scope="col">Фото</th>
            <th width="400px" scope="col">Описание</th>
            <th scope="col">Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach($maestros as $maestro)
            <tr>
                <th scope="row">{{ $maestro->id }}</th>
                <td>{{ $maestro->name }}</td>
                <td>{{ $maestro->surname }}</td>
                <td>{{ $maestro->phone_number }}</td>
                <td>{{ $maestro->social_media }}</td>
                <td><img width="100px" src="{{ \Illuminate\Support\Facades\Storage::url($maestro->images)  }}" alt="{{ $maestro->images }}"></td>
                <td>{{ $maestro->information }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <form action="{{ route('masters_admin.destroy', $maestro) }}" method="POST">
                            <a class="btn btn-warning" type="button" href="{{ route('masters_admin.edit', $maestro) }}">Редактировать</a>
                            @csrf
                            @method('DELETE')
                            <input class="btn btn-danger" type="submit" value="Удалить"></form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a class="btn btn-success" type="button" href="{{ route('masters_admin.create') }}">Добавить мастера</a>
</body>
</html>

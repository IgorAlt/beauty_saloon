<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <title>Записи</title>
</head>
<body>
<h1>Записи</h1>
<table class="table">
    <thead>
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Имя</th>
        <th scope="col">Фамилия</th>
        <th scope="col">Номер телефона</th>
        <th scope="col">Электронная почта</th>
        <th scope="col">Дата и время записи</th>
        <th scope="col">Общая сумма заказа</th>
        <th scope="col">Услуги</th>
        <th scope="col">Посещение</th>
    </tr>
    </thead>
    <tbody>
    @foreach($appointments as $appointment)
        <tr>
            <th scope="row">{{ $appointment->id }}</th>
            <td>{{ $appointment->name }}</td>
            <td>{{ $appointment->surname }}</td>
            <td>{{ $appointment->phone_number }}</td>
            <td>{{ $appointment->email }}</td>
            <td>{{ $appointment->appointment_time }}</td>
            <td>{{ $appointment->price }}</td>
            <td>{{ $appointment->name_appointment }}</td>
            <td>{{ $appointment->isNow_show }}</td>
            <td>
                <div class="btn-group" role="group">
                    <form action="{{ route('appointments_admin.destroy', $appointment) }}" method="POST">
                        <a class="btn btn-warning" type="button" href="{{ route('appointments_admin.edit', $appointment) }}">Редактировать</a>
                        @csrf
                        @method('DELETE')
                        <input class="btn btn-danger" type="submit" value="Удалить"></form>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>

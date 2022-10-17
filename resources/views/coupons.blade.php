<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <title>Купоны</title>
</head>
<body>
    <h1>Купоны</h1>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Название купона</th>
            <th scope="col">Услуги</th>
            <th scope="col">Количество использований</th>
            <th scope="col">Пользователи, для которых созданы купоны</th>
            <th scope="col">Скидка в процентах</th>
            <th scope="col">Скидка на сумму</th>
        </tr>
        </thead>
        <tbody>
        @foreach($coupons as $coupon)
            <tr>
                <th scope="row">{{ $coupon->id }}</th>
                <th scope="row">{{ $coupon->name }}</th>
                <td>{{ $coupon->services }}</td>
                <td>{{ $coupon->count }}</td>
                <td>{{ $coupon->user }}</td>
                <td>{{ $coupon->percent }}</td>
                <td>{{ $coupon->discount }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <form action="{{ route('coupons.destroy', $coupon) }}" method="POST">
                            <a class="btn btn-warning" type="button" href="{{ route('coupons.edit', $coupon) }}">Редактировать</a>
                            @csrf
                            @method('DELETE')
                            <input class="btn btn-danger" type="submit" value="Удалить"></form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a class="btn btn-success" type="button" href="{{ route('coupons.create') }}">Добавить купон</a>
</body>
</html>

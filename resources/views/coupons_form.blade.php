<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <title>Редактирование купонов</title>
</head>
<body>
<div class="col-md-12">
    @isset($coupon)
        <h1>Редактировать купон <b>{{ $coupon->name }}</b></h1>
    @else
        <h1>Добавить купон</h1>
    @endisset

    <form method="POST" enctype="multipart/form-data"
          @isset($coupon)
          action="{{ route('coupons.update', $coupon) }}"
          @else
          action="{{ route('coupons.store') }}"
        @endisset
    >
        <div>
            @isset($coupon)
                @method('PUT')
            @endisset
            @csrf
            <div class="input-group row">
                <label for="name" class="col-sm-2 col-form-label">Название купона: </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" id="name"
                           value="@isset($coupon){{ $coupon->name }}@endisset">
                </div>
            </div>
            <br>
                <div class="input-group row">
                    <label for="services" class="col-sm-2 col-form-label">Услуги: </label>
                    <div class="col-sm-6">
                        <select name="services[]" class="form-control" multiple>
                            @foreach($services as $service)
                                <option value="{{ $service->service }}"
                                >{{ $service->service }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            <br>
            <div class="input-group row">
                <label for="count" class="col-sm-2 col-form-label">Количество использований: </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="count" id="count"
                           value="@isset($coupon){{ $coupon->count }}@endisset">
                </div>
            </div>
            <br>
                <div class="input-group row">
                    <label for="user" class="col-sm-2 col-form-label">Пользователи: </label>
                    <div class="col-sm-6">
                        <select name="user[]" class="form-control" multiple>
                            @foreach($users as $user)
                                <option value="{{ $user->name }}"
                                >{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            <br>
                <div class="input-group row">
                    <label for="percent" class="col-sm-2 col-form-label">Скидка в процентах: </label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="percent" id="percent"
                               value="@isset($coupon){{ $coupon->percent }}@endisset">
                    </div>
                </div>
            <br>
                <div class="input-group row">
                    <label for="discount" class="col-sm-2 col-form-label">Скидка на сумму: </label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="discount" id="discount"
                               value="@isset($coupon){{ $coupon->discount }}@endisset">
                    </div>
                </div>
            <button class="btn btn-success">Сохранить</button>
        </div>
    </form>
</div>
</body>
</html>

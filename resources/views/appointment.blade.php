<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Запись на приём</title>
</head>
<body>
    <h1>Запись на приём</h1>
    <form method="post" action="{{ route('create-appointment') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name"  class="form-label">Имя: </label>
            <input type="text" class="form-control" id="name" name="name"
                   @if(Auth::user()) value="{{ Auth::user()->name }}"@endif>
        </div>
        <div class="mb-3">
            <label for="surname" class="form-label">Фамилия: </label>
            <input type="text" class="form-control" id="surname" name="surname" placeholder="Натальева">
        </div>
        <div class="mb-3">
            <label for="phone_number" class="form-label">Номер телефона: </label>
            <input type="text" class="form-control" id="phone_number" name="phone_number"
                   @if(Auth::user()) value="{{ Auth::user()->phone }}"@endif>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Адрес электронной почты: </label>
            <input type="email" class="form-control" id="email" name="email"
                   @if(Auth::user()) value="{{ Auth::user()->email }}"@endif>
        </div>
        <div class="mb-3">
            <label for="appointment_time" class="form-label">Время записи: </label>
            <input type="datetime-local" class="form-control" id="appointment_time" name="appointment_time">
        </div>

            <div class="input-group row">
                <label for="price" class="col-sm-2 col-form-label">Услуга </label>
                <div class="col-sm-6">
                    <select name="price[]" class="form-control" multiple>
                        @foreach($services as $service)
                            <option value="{{ $service->price }}"
                            >{{ $service->service }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

        <div class="mb-3">
            <label for="coupon" class="form-label">Купон: </label>
            <input type="text" class="form-control" id="coupon" name="coupon">
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <button type="submit">Отправить</button>
    </form>
</body>
</html>

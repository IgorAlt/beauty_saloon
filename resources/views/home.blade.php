@extends('layouts.app')

@section('content')

    @if(Session::has('warning'))

        <p class="alert
    {{ Session::get('alert-class', 'alert-info') }}">{{Session::get('warning') }}</p>

    @endif
    @if(Session::has('coupons_over'))

        <p class="alert
    {{ Session::get('alert-class', 'alert-info') }}">{{Session::get('coupons_over') }}</p>

    @endif
    @if(Session::has('coupons_is_not_for_you'))

        <p class="alert
    {{ Session::get('alert-class', 'alert-info') }}">{{Session::get('coupons_is_not_for_you') }}</p>

    @endif
    @if(Session::has('coupons_is_not_for_service'))

        <p class="alert
    {{ Session::get('alert-class', 'alert-info') }}">{{Session::get('coupons_is_not_for_service') }}</p>

    @endif
    @if(Session::has('coupons_is_used'))

        <p class="alert
    {{ Session::get('alert-class', 'alert-info') }}">{{Session::get('coupons_is_used') }}</p>

    @endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('Вы вошли в свой профиль!') }}
                    </div>

                    <div class="card-body" aria-labelledby="navbarDropdown">
                        <a class="" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Выйти') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>

                    <div class="card-body">
                        <a href="{{ route('appointment') }}">Записаться на приём</a>
                    </div>

                    @if(Session::has('success'))

                        <p class="alert
                    {{ Session::get('alert-class', 'alert-info') }}">{{Session::get('success') }}</p>

                    @endif
                </div>
                <h1>Информация пользователя</h1>
                <b>Имя и фамилия:</b> {{ Auth::user()->name }}
                <br>
                <b>Номер телефона:</b> @if(isset(Auth::user()->phone)) {{ Auth::user()->phone }} @endif
                <br>
                <b>Электронная почта:</b> @if(isset(Auth::user()->email)) {{ Auth::user()->email }} @endif
                <br>
                <a class="btn btn-success" type="button" href="{{ route('change-user-information', $user) }}">Изменить</a>
                <br><br>

                <b>Ваш уровень в программе лояльности: {{ $user->loyalty_level }}</b>

                <br><br>
                <h2>Ваши прошедшие записи</h2>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Дата и время</th>
                        <th scope="col">Общая стоимость услуг</th>
                        <th scope="col">Услуга и её цена</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($userAppointmentsPast as $userAppointmentPast)
                    <tr>
                        <th scope="row">{{ $scorePast++ }}</th>
                        <td>{{ $userAppointmentPast->appointment_time }}</td>
                        <td>{{ $userAppointmentPast->price }}</td>
                        <td>{{ $userAppointmentPast->name_appointment }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>

                <h2>Ваши предстоящие записи</h2>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Дата и время</th>
                        <th scope="col">Общая стоимость услуг</th>
                        <th scope="col">Услуга и её цена</th>
                        <th scope="col">Удаление записи</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($userAppointmentsFuture as $userAppointmentFuture)
                        <tr>
                            <th scope="row">{{ $scoreFuture++ }}</th>
                            <td>{{ $userAppointmentFuture->appointment_time }}</td>
                            <td>{{ $userAppointmentFuture->price }}</td>
                            <td>{{ $userAppointmentFuture->name_appointment }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <form action="{{ route('appointment_delete', $userAppointmentFuture) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input class="btn btn-danger" type="submit" value="Удалить"></form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
@endsection

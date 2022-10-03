@extends('layouts.app')

@section('content')
    @if(Session::has('warning'))

        <p class="alert
    {{ Session::get('alert-class', 'alert-info') }}">{{Session::get('warning') }}</p>

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

                        {{ __('You are logged in!') }}
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

@endsection

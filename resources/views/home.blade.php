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
                        <a href="{{ route('bonuses') }}">Бонусы</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

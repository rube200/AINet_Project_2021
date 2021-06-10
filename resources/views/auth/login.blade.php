@extends('layouts.shop_layout')
@section('title', __('Login-Title'))
@section('content')
    <div class="login-container container">
        <form method="POST" action="{{route('login')}}">
            @csrf
            <label for="email">
                {{__('Email-Input')}}
            </label>
            <input autocomplete="email" autofocus class="email-login form-control @error('email') is-invalid @enderror" id="email" name="email" required type="email" value="{{old('email')}}" style="width: 400px">
            @error('email')
            <strong>{{ $message }}</strong>
            @enderror

            <label for="password">
                {{__('Password-Input')}}
            </label>
            <input autocomplete="current-password" class="password-login form-control @error('password') is-invalid @enderror" id="password" name="password" required type="password" style="width: 400px">
            @error('password')
            <strong>{{ $message }}</strong>
            @enderror

            <label for="remember">
                {{__('Remember-Input')}}
            </label>
            <input {{old('remember') ? 'checked' : ''}} class="remember-checkbox form-check-input" id="remember" name="remember" type="checkbox" style="margin-top: 10px">

            @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{route('password.request')}}">
                    {{__('Forget-Password-Button')}}
                </a>
            @endif

            <br>

            <button type="submit" class="btn btn-primary" style="width: 400px">
                {{__('Login-Submit')}}
            </button>

        </form>
    </div>
@endsection

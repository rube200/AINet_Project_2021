@extends('layouts.shop_layout')
@section('title', __('Login-Title'))
@section('content')
    <div class="container">
        <form method="POST" action="{{route('login')}}">
            @csrf
            <label for="email">
                {{__('Email-Input')}}
            </label>
            <input autocomplete="email" autofocus class="form-control @error('email') is-invalid @enderror" id="email" name="email" required type="email" value="{{old('email')}}">
            @error('email')
            <strong>{{ $message }}</strong>
            @enderror

            <label for="password">
                {{__('Password-Input')}}
            </label>
            <input autocomplete="current-password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required type="password">
            @error('password')
            <strong>{{ $message }}</strong>
            @enderror

            <label for="remember">
                {{__('Remember-Input')}}
            </label>
            <input {{old('remember') ? 'checked' : ''}} class="form-check-input" id="remember" name="remember" type="checkbox">

            <button type="submit" class="btn btn-primary">
                {{__('Login-Submit')}}
            </button>

            @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{route('password.request')}}">
                    {{__('Forget-Password-Button')}}
                </a>
            @endif
        </form>
    </div>
@endsection

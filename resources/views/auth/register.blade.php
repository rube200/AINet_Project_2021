@extends('layouts.shop_layout')
@section('title', __('Register-Title'))
@section('content')
    <div class="register-container container">
        <form method="POST" action="{{route('register')}}">
            @csrf
            <label for="name">
                {{__('Name-Input')}}
            </label>
            <input autocomplete="name" autofocus class="name-register form-control @error('name') is-invalid @enderror" id="name" name="name" required type="text" value="{{old('name')}}" style="width: 400px">
            @error('name')
            <strong>{{ $message }}</strong>
            @enderror

            <label for="email">
                {{__('Email-Input')}}
            </label>
            <input autocomplete="email" class="email-register form-control @error('email') is-invalid @enderror" id="email" name="email" required type="email" value="{{old('email')}}" style="width: 400px">
            @error('email')
            <strong>{{ $message }}</strong>
            @enderror

            <label for="password">
                {{__('Password-Input')}}
            </label>
            <input autocomplete="new-password" class="password-register form-control @error('password') is-invalid @enderror" id="password" name="password" required type="password" style="width: 400px">
            @error('password')
            <strong>{{ $message }}</strong>
            @enderror

            <label for="password-confirm">
                {{__('Confirm-Password-Input')}}
            </label>
            <input autocomplete="new-password" class="password-confirm-register form-control" id="password-confirm" name="password_confirmation" required type="password" style="width: 400px">

            <br>

            <button type="submit" class="btn btn-primary" style="width: 400px">
                {{__('Register-Submit')}}
            </button>
        </form>
    </div>
@endsection

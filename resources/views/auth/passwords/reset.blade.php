@extends('layouts.shop_layout')
@section('title', __('Reset-Password-Email-Title'))
@section('content')
    <div class="container">
        <form method="POST" action="{{route('password.update')}}">
            @csrf
            <input type="hidden" name="token" value="{{$token}}">
            <label for="email">
                {{__('Email-Input')}}
            </label>
            <input autocomplete="email" autofocus class="form-control @error('email') is-invalid @enderror" id="email" name="email" required type="email" value="{{$email ?? old('email')}}">
            @error('email')
            <strong>{{$message}}</strong>
            @enderror

            <label for="password">
                {{__('Password-Input')}}
            </label>
            <input autocomplete="new-password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required type="password">
            @error('password')
            <strong>{{$message}}</strong>
            @enderror

            <label for="password-confirm">
                {{__('Confirm-Password-Input')}}
            </label>
            <input autocomplete="new-password" class="form-control" id="password-confirm" name="password_confirmation" required type="password">

            <button type="submit" class="btn btn-primary">
                {{__('Reset-Password-Submit')}}
            </button>
        </form>
    </div>
@endsection

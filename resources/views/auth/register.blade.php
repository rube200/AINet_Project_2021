@extends('layouts.shop_layout')
@section('title', __('Register-Title'))
@section('content')
    <div class="container">
        <form method="POST" action="{{route('register')}}">
            @csrf
            <label for="name">
                {{__('Name-Input')}}
            </label>
            <input autocomplete="name" autofocus class="form-control @error('name') is-invalid @enderror" id="name" name="name" required type="text" value="{{old('name')}}">
            @error('name')
            <strong>{{ $message }}</strong>
            @enderror

            <label for="email">
                {{__('Email-Input')}}
            </label>
            <input autocomplete="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required type="email" value="{{old('email')}}">
            @error('email')
            <strong>{{ $message }}</strong>
            @enderror

            <label for="password">
                {{__('Password-Input')}}
            </label>
            <input autocomplete="new-password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required type="password">
            @error('password')
            <strong>{{ $message }}</strong>
            @enderror

            <label for="password-confirm">
                {{__('Confirm-Password-Input')}}
            </label>
            <input autocomplete="new-password" class="form-control" id="password-confirm" name="password_confirmation" required type="password">

            <button type="submit" class="btn btn-primary">
                {{__('Register-Submit')}}
            </button>
        </form>
    </div>
@endsection

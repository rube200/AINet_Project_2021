@extends('layouts.shop_layout')
@section('title', __('Register-Title'))
@section('content')
    <div class="container">
        <div class="align-items-center card col-sm-4 mx-auto">
            <form action="{{route('profile.store')}}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-check-label" for="name">
                            {{__('Name-Input')}}
                        </label>
                        <input autocomplete="name" autofocus
                               class="name-register form-control @error('name') is-invalid @enderror" id="name"
                               name="name" required type="text" value="{{old('name')}}">
                        @error('name')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-check-label" for="email">
                            {{__('Email-Input')}}
                        </label>
                        <input autocomplete="email"
                               class="email-register form-control @error('email') is-invalid @enderror" id="email"
                               name="email" type="email" value="{{old('email')}}">
                        @error('email')
                        <strong>{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-check-label" for="password">
                            {{__('Password-Input')}}
                        </label>
                        <input autocomplete="new-password"
                               class="password-register form-control @error('password') is-invalid @enderror"
                               id="password" name="password" type="password">
                        @error('password')
                        <strong>{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-check-label" for="password-confirm">
                            {{__('Confirm-Password-Input')}}
                        </label>
                        <input autocomplete="new-password" class="password-confirm-register form-control"
                               id="password-confirm" name="password_confirmation" required type="password">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">
                            {{__('Register-Submit')}}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@extends('layouts.shop_layout')
@section('title', __('Reset-Password-Email-Title'))
@section('content')
    <div class="container">
        <div class="align-items-center card col-sm-4 mx-auto">
            <form action="{{route('password.update')}}" class="row" method="POST">
                @csrf
                <input name="token" value="{{$token}}" type="hidden">
                <div class="card-body">
                    <div class="col-auto">
                        <label class="form-check-label" for="email">
                            {{__('Email-Input')}}
                        </label>
                        <input autocomplete="email" autofocus class="form-control @error('email') is-invalid @enderror"
                               id="email" name="email" required type="email" value="{{$email ?? old('email')}}">
                        @error('email')
                        <strong>{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="col-auto">
                        <label class="form-check-label" for="password">
                            {{__('Password-Input')}}
                        </label>
                        <input autocomplete="new-password" class="form-control @error('password') is-invalid @enderror"
                               id="password" name="password" required type="password">
                        @error('password')
                        <strong>{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="col-auto">
                        <label class="form-check-label" for="password-confirm">
                            {{__('Confirm-Password-Input')}}
                        </label>
                        <input autocomplete="new-password" class="form-control" id="password-confirm"
                               name="password_confirmation" required type="password">
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-primary" type="submit">
                            {{__('Reset-Password-Submit')}}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

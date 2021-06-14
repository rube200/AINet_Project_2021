@extends('layouts.layout')
@section('title', __('Login-Title'))
@section('content')
    <div class="container">
        <div class="align-items-center card col-sm-4 mx-auto">
            <form action="{{route('login')}}" class="row" method="POST">
                @csrf
                <div class="card-body">
                    <div class="col-auto">
                        <label class="form-check-label" for="email">
                            {{__('Email-Input')}}
                        </label>
                        <input autocomplete="email" autofocus
                               class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                               placeholder="{{__('Email-Placeholder')}}" required type="email" value="{{old('email')}}">
                        @error('email')
                        <strong>{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="col-auto">
                        <label class="form-check-label" for="password">{{__('Password-Input')}}</label>
                        @if (Route::has('password.request'))
                            <a class="float-right" href="{{route('password.request')}}">
                                {{__('Forget-Password-Button')}}
                            </a>
                        @endif
                        <input autocomplete="current-password"
                               class="form-control @error('password') is-invalid @enderror" id="password"
                               name="password" placeholder="{{__('Password-Placeholder')}}" required type="password">
                        @error('password')
                        <strong>{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="col-auto">
                        <input {{old('remember') ? 'checked' : ''}} class="form-check-input remember-checkbox"
                               id="remember"
                               name="remember" type="checkbox">
                        <label class="form-check-label" for="remember">
                            {{__('Remember-Input')}}
                        </label>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-primary" type="submit">
                            {{__('Login-Submit')}}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

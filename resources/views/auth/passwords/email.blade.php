@extends('layouts.shop_layout')
@section('title', __('Reset-Password-Title'))
@section('content')
    <div class="container">
        <div class="align-items-center card col-sm-4 mx-auto">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{session('status')}}
                </div>
            @endif
            <form action="{{route('password.email')}}" class="row" method="POST">
                @csrf
                <div class="card-body">
                    <div class="col-auto">
                        <label class="form-check-label" for="email">
                            {{__('Email-Input')}}
                        </label>
                        <input autocomplete="email" autofocus class="form-control @error('email') is-invalid @enderror"
                               id="email" name="email" required type="email" value="{{old('email')}}">
                        @error('email')
                        <strong>{{$message}}</strong>
                        @enderror
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

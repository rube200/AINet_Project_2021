@extends('layouts.shop_layout')
@section('title', __('Reset-Password-Title'))
@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{session('status')}}
            </div>
        @endif
        <form method="POST" action="{{route('password.email')}}">
            @csrf
            <label for="email">
                {{__('Email-Input')}}
            </label>
            <input autocomplete="email" autofocus class="form-control @error('email') is-invalid @enderror" id="email" name="email" required type="email" value="{{old('email')}}">
            @error('email')
            <strong>{{$message}}</strong>
            @enderror

            <button type="submit" class="btn btn-primary">
                {{__('Reset-Password-Submit')}}
            </button>
        </form>
    </div>
@endsection

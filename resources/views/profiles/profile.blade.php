@extends('layouts.profiles_layout')
@section('title', __('Profile-Title'))
@section('content')
    <div class="container">
        <div class="card profile-card">
            <img class="card-img-top profile-img-view" src="{{$user->img}}">
            <div class="card-body">
                <h5 class="card-title">{{$user->name}}</h5>
                <p class="card-text">Joined at {{$user->created_at}}</p>
            </div>
        </div>
    </div>
@endsection

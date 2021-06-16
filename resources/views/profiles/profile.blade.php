@extends('layouts.layout')
@section('title', __('Profile-Title', ['name' => $user->name]))
@section('content')
    <div class="container">
        <div class="row">
            <div class="card col-auto profile-card">
                <img class="card-img-top profile-img-view profile-img" src="{{$user->img}}">
                <div class="card-body">
                    <h5 class="card-title">{{$user->name}}</h5>
                    <p class="card-text">Joined at {{$user->created_at}}</p>
                </div>
            </div>
        </div>
        <div class="row">
            @can('edit', $user)
                <form action="{{route('profile.edit', $user)}}" class="row" method="GET">
                    <div class="col-auto">
                        <button class="btn btn-success btn-group-sm" type="submit">{{__('Profile-Edit-Text')}}</button>
                    </div>
                </form>
            @endcan

            @can('updateBlock', $user)
                <form action="{{route('profile.update', $user)}}" class="row" method="POST">
                    @csrf
                    @method('PATCH')
                    <input name="toggleBlock" value="1" type="hidden">
                    <div class="col-auto">
                        <button class="btn btn-danger btn-group-sm"
                                type="submit">{{__(!$user->bloqueado ? 'Profile-Block' : 'Profile-Unblock')}}</button>
                    </div>
                </form>
            @endcan

            @can('delete', $user)
                <form action="{{route('profile.destroy', $user)}}" class="row" method="POST">
                    @csrf
                    @method("DELETE")
                    <div class="col-auto">
                        <input class="btn btn-danger btn-sm" type="submit" value="{{__('Profile-Delete-Text')}}"/>
                    </div>
                </form>
            @endcan
            <div class="col-auto">
                <a class="btn btn-secondary btn-sm" href="{{route('profile.index')}}">{{__('Back-Submit')}}</a>
            </div>
        </div>
    </div>
@endsection

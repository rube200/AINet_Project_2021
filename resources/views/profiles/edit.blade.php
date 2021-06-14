@extends('layouts.profiles_layout')
@section('title', __('Edit-Profile-Title'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-auto">
                <img class="edit-profile-img-view" src="{{$user->img}}">
                <form action="{{route('profile.update', $user)}}" class="row" enctype="multipart/form-data" method="POST" >
                    @csrf
                    @method('PUT')
                    <input name="editProfile" value="1" type="hidden">
                    <div class="col-auto">
                        <div class="input-group">
                            <label class="input-group-text" for="newPhoto">
                                {{__('Profile-Edit-New-Photo')}}
                            </label>
                            <input accept="image/*" class="form-control" id="newPhoto" name="photo" type="file">
                            @isset($user->foto_url)
                                <button class="btn btn-danger" form="destroy_photo" type="submit">
                                    {{__('Profile-Edit-Delete-Photo')}}
                                </button>
                            @endisset
                            @error('photo')
                            <strong>{{$message}}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col-auto input-group">
                        <label class="input-group-text" for="inputName">{{__('Name-Input-Text')}}</label>
                        <input class="form-control" id="inputName" name="name" value="{{old('name', $user->name)}}" type="text">
                        @error('name')
                        <div class="small text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-success" type="submit">
                            {{__('Save-Submit')}}
                        </button>
                        <a class="btn btn-secondary" href="{{url()->previous()}}">{{__('Cancel-Submit')}}</a>
                    </div>
                </form>
            </div>
        </div>

        @isset($user->foto_url)
            <form action="{{route('profile.photo.destroy', $user)}}" id="destroy_photo" method="POST">
                @csrf
                @method('DELETE')
            </form>
        @endisset
    </div>
@endsection

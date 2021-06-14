@extends('layouts.profiles_layout')
@section('title', __('Profiles-Title'))
@section('content')
    <div class="container">
        <div class="row">
            <form action="{{route('profile.index')}}" class="row" method="GET">
                <div class="align-items-center row">
                    <div class="col-8">
                        <div class="input-group">
                            <input class="form-control" id="search" name="search"
                                   placeholder="{{__('Search-Name-Placeholder')}}" value="{{old('search', $search)}}"
                                   type="text">
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="input-group">
                            <label class="input-group-text" for="tipo">{{__('Categories-Label')}}</label>
                            <select class="form-select" id="tipo" name="tipo">
                                <option
                                    {{'' == old('tipo', $selectedTipo) ? 'selected' : ''}} value="">{{__('All-Types-Text')}}</option>
                                <option
                                    {{'A' == old('tipo', $selectedTipo) ? 'selected' : ''}} value="A">{{__('Admins-Text')}}</option>
                                <option
                                    {{'F' == old('tipo', $selectedTipo) ? 'selected' : ''}} value="F">{{__('Employee-Text')}}</option>
                                <option
                                    {{'C' == old('tipo', $selectedTipo) ? 'selected' : ''}} value="C">{{__('Customer-Text')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="input-group">
                            <button class="btn btn-outline-secondary" type="submit">{{__('Filter-Button')}}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            <table class="table">
                <thead>
                <tr>
                    <th></th>
                    <th>Nome</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>
                            <img class="profile-icon" src="{{$user->img}}"/>
                        </td>
                        <td>
                            {{$user->name}}
                        </td>
                        <td>
                            @can('view', $user)
                                <a class="btn btn-success btn-sm"
                                   href="{{route('profile.show', $user)}}">{{__('Profile-More-Details-Text')}}</a>
                            @endcan
                        </td>
                        <td>
                            @can('updateBlock', $user)
                                <form action="{{route('profile.update', $user)}}" class="row" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input name="toggleBlock" value="1" type="hidden">
                                    <div class="col-auto">
                                        <button class="btn btn-danger btn-sm"
                                                type="submit">{{__(!$user->bloqueado ? 'Profile-Block' : 'Profile-Unblock')}}</button>
                                    </div>
                                </form>
                            @endcan
                        </td>
                        <td>
                            @can('delete', $user)
                                <form action="{{route('profile.destroy', $user)}}" class="row" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <div class="col-auto">
                                        <input class="btn btn-danger btn-sm" type="submit"
                                               value="{{__('Profile-Delete-Text')}}"/>
                                    </div>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="row">
            {{$users->withQueryString()->links()}}
        </div>
    </div>
@endsection

@extends('layouts.profiles_layout')
@section('title', __('Profiles-Title'))
@section('content')
    <div class="container">
        <div class="row">
            <form action="{{route('profile.index')}}" class="form-group" method="GET">
                <div class="align-items-center row">
                    <div class="col-8">
                        <input class="form-control" id="search" name="search" placeholder="Name" type="text">
                    </div>
                    <div class="col-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="tipo">{{__('Types-Label')}}</label>
                            </div>
                            <select class="custom-select" id="tipo" name="tipo">
                                <option {{'' == old('tipo', $selectedTipo) ? 'selected' : ''}} value="">Todos</option>
                                <option {{'A' == old('tipo', $selectedTipo) ? 'selected' : ''}} value="A">{{__('Admins-Text')}}</option>
                                <option {{'F' == old('tipo', $selectedTipo) ? 'selected' : ''}} value="F">{{__('Employee-Text')}}</option>
                                <option {{'C' == old('tipo', $selectedTipo) ? 'selected' : ''}} value="C">{{__('Customer-Text')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-2">
                        <button class="btn btn-outline-secondary" type="submit">{{__('Filter-Button')}}</button>
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
                            <img alt="" class="profile-icon" src="{{$user->img}}"/>
                        </td>
                        <td>
                            {{$user->name}}
                        </td>
                        <td>
                            @can('updateBlock', $user)
                                <form action="{{route('profile.update', $user)}}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input name="toggleBlock" value="1" type="hidden">
                                    <div class="form-group">
                                        <button class="btn btn-success" type="submit">{{!$user->bloqueado ? 'Bloquear' : 'Desbloquear'}}</button>
                                    </div>
                                </form>
                            @endcan
                        </td>
                        <td>
                            @can('edit', $user)
                                <form action="#" method="GET">
                                    @csrf
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-danger btn-sm" value="Editar"/>
                                    </div>
                                </form>
                            @endcan
                        </td>
                        <td>
                            @can('delete', $user)
                                <form action="{{route('profile.destroy', $user)}}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <div class="form-group">
                                        <input class="btn btn-danger btn-sm" type="submit" value="Apagar"/>
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

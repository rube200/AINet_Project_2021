@extends('layouts.profiles_layout')
@section('title', __('Profiles-Title'))
@section('content')
    <div class="container">
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
                        @can('updateBlock', $user)
                            <form action="{{route('profile.update', $user)}}" class="form-group" method="POST">
                                @csrf
                                @method('PATCH')
                                <input name="toggleBlock" value="1" type="hidden">
                                <button class="btn btn-success" type="submit">{{!$user->bloqueado ? 'Bloquear' : 'Desbloquear'}}</button>
                            </form>
                        @endcan
                    </td>
                    <td>
                        @can('edit', $user)
                            <form action="#" method="GET">
                                @csrf
                                <input type="submit" class="btn btn-danger btn-sm" value="Editar"/>
                            </form>
                        @endcan
                    </td>
                    <td>
                        @can('delete', $user)
                            <form action="{{route('profile.destroy', $user)}}" class="form-group" method="POST">
                                @csrf
                                @method("DELETE")
                                <input class="btn btn-danger btn-sm" type="submit" value="Apagar"/>
                            </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$users->withQueryString()->links()}}
    </div>
@endsection

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
                        <img class="profile-icon" src="{{asset('storage/fotos/' . $user->foto_url)}}">
                    </td>
                    <td>
                        {{$user->name}}
                    </td>
                    <td>
                        @if(!$user->bloqueado)
                            <a href="#" class="btn btn-primary btn-sm" role="button" aria-pressed="true">Bloquear</a>
                        @else
                            <a href="#" class="btn btn-primary btn-sm" role="button" aria-pressed="true">Desbloquear</a>
                        @endcan
                    </td>
                    <td>
                        @can('edit', $user)
                            <form action="#" method="GET">
                                @csrf
                                <input type="submit" class="btn btn-danger btn-sm" value="Apagar">
                            </form>
                        @endcan
                    </td>
                    <td>
                        <form action="#" method="POST">
                            @csrf
                            @method("DELETE")
                            <input class="btn btn-danger btn-sm" type="submit" value="Apagar">
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$users->withQueryString()->links()}}
    </div>
@endsection

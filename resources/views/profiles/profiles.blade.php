@extends('layouts.profiles_layout')
@section('title', __('Profiles-Title'))
@section('content')
    <div class="container">
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
        {{-- todo filter
        <form method="GET" action="{{route('profile.index')}}" class="form-group">
            <div class="input-group">
                <select class="custom-select" name="curso" id="inputCurso" aria-label="Curso">
                    <option value="" {{'' == old('curso', $selectedCurso) ? 'selected' : ''}}>Todos Cursos</option>
                    @foreach ($cursos as $abr => $nome)
                        <option value={{$abr}} {{$abr == old('curso', $selectedCurso) ? 'selected' : ''}}>{{$nome}}</option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Filtrar</button>
                </div>
            </div>
        </form>--}}
    </div>
@endsection

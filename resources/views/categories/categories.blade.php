@extends('layouts.layout')
@section('title', __('Categories-Title'))
@section('content')
    <div class="container">
        <div class="row">
            <form action="{{route('categoria.create')}}" class="row" method="GET">
                <div class="col-auto">
                    <div class="input-group">
                        <button class="btn btn-success" type="submit">{{__('New-Category-Button')}}</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            <table class="table">
                <thead>
                <tr>
                    <th>{{__('Name-Table-Text')}}</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($categorias as $categoria)
                    <tr>
                        <td>
                            {{$categoria->nome}}
                        </td>
                        <td>
                            @can('update', $categoria)
                                <a class="btn btn-success btn-sm"
                                   href="{{route('categoria.edit', $categoria)}}">{{__('Category-Edit-Text')}}</a>
                            @endcan
                        </td>
                        <td>
                            @can('delete', $categoria)
                                <form action="{{route('categoria.destroy', $categoria)}}" class="row" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <div class="col-auto">
                                        <input class="btn btn-danger btn-sm" type="submit"
                                               value="{{__('Category-Delete-Text')}}"/>
                                    </div>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

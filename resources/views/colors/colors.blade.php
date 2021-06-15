@extends('layouts.layout')
@section('title', __('Colors-Title'))
@section('content')
    <div class="container">
        <div class="row">
            <form action="{{route('cor.create')}}" class="row" method="GET">
                <div class="col-auto">
                    <div class="input-group">
                        <button class="btn btn-success" type="submit">{{__('New-Color-Button')}}</button>
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
                </tr>
                </thead>
                <tbody>
                @foreach ($colors as $color)
                    <tr>
                        <td>
                            <div class="color-display" style="background: {{'#' . $color->codigo}}"></div>
                        </td>
                        <td>
                            {{$color->nome}}
                        </td>
                        <td>
                            @can('update', $color)
                                <a class="btn btn-success btn-sm"
                                   href="{{route('cor.edit', $color)}}">{{__('Color-Edit-Text')}}</a>
                            @endcan
                        </td>
                        <td>
                            @can('delete', $color)
                                <form action="{{route('cor.destroy', $color)}}" class="row" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <div class="col-auto">
                                        <input class="btn btn-danger btn-sm" type="submit"
                                               value="{{__('Color-Delete-Text')}}"/>
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

@extends('layouts.layout')
@section('title', __('Manage-Menu-Title'))
@section('content')
    <div class="container">
        @can('viewAny', \App\Models\Estampa::class)
            <div class="row">
                <a class="btn btn-success" href="{{route('estampa.index')}}">{{__('Manage-Prints-Text')}}</a>
            </div>
        @endcan
            @can('viewAny', \App\Models\Categoria::class)
                <div class="row">
                    <a class="btn btn-success" href="{{route('categoria.index')}}">{{__('Manage-Categories-Text')}}</a>
                </div>
            @endcan
            @can('viewAny', \App\Models\Cor::class)
                <div class="row">
                    <a class="btn btn-success" href="{{route('cor.index')}}">{{__('Manage-Colers-Text')}}</a>
                </div>
            @endcan
    </div>
@endsection

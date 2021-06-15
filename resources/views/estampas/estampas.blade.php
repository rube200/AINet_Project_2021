@extends('layouts.layout')
@section('title', __('Shop-Title'))
@section('content')
    <div class="container shop-container">
        <div class="row">
            <form action="{{route('estampa.index')}}" class="row" method="GET">
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
                            <label class="input-group-text" for="categoria">{{__('Categories-Label')}}</label>
                            <select class="form-select" id="categoria" name="categoria">
                                <option
                                    {{'' == old('categoria', $categoriaEscolhida) ? 'selected' : ''}} value="">{{__('All-Types-Text')}}</option>
                                @foreach($categorias as $id => $name)
                                    <option
                                        {{$id == old('categoria', $categoriaEscolhida) ? 'selected' : ''}} value="{{$id}}">{{$name}}</option>
                                @endforeach
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
            @include('partials.display_estampas', $estampas)
        </div>
        <div class="row">
            {{$estampas->withQueryString()->links()}}
        </div>
    </div>
@endsection
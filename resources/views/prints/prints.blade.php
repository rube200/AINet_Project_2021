@extends('layouts.layout')
@section('title', __('Shop-Title'))
@section('content')
    <div class="container shop-container">
        <div class="row">
            <form action="{{route('estampa.create')}}" class="row" method="GET">
                <div class="col-auto">
                    <div class="input-group">
                        <button class="btn btn-success" type="submit">{{__('New-Print-Button')}}</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            <form action="{{route('estampa.index')}}" class="row" method="GET">
                <div class="align-items-center row">
                    <div class="col-8">
                        <div class="input-group">
                            <input class="form-control" id="search" name="search"
                                   placeholder="{{__('Search-Name-Placeholder')}}" value="{{old('search', $search)}}"
                                   type="search">
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
            @foreach($estampas as $estampa)
                <div class="col-lg-3 col-sm-6">
                    <div class="card shop-estampa-card">
                        <a class="shop-estampa-link" href="{{route('estampa.show', $estampa)}}">
                            <img class="card-img-top shop-estampa-img" src="{{$estampa->img}}" alt="Imagem da estampa">
                            <div class="card-body shop-estampa-body text-center">
                                <h5 class="card-title shop-estampa-name">{{$estampa->nome}}</h5>
                                <p class="card-text shop-estampa-description">{{$estampa->descricao}}</p>
                            </div>
                            <div class="card-footer">
                                @can('update', $estampa)
                                    <form action="{{route('estampa.edit', $estampa)}}" class="row" method="GET">
                                        <div class="col-auto">
                                            <button class="btn btn-success btn-group-sm" type="submit">{{__('Print-Edit-Text')}}</button>
                                        </div>
                                    </form>
                                @endcan
                                @can('delete', $estampa)
                                    <form action="{{route('estampa.destroy', $estampa)}}" class="row" method="POST">
                                        @csrf
                                        @method("DELETE")
                                        <div class="col-auto">
                                            <input class="btn btn-danger btn-sm" type="submit"
                                                   value="{{__('Estampa-Delete-Text')}}"/>
                                        </div>
                                    </form>
                                    @endcan
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            {{$estampas->withQueryString()->links()}}
        </div>
    </div>
@endsection

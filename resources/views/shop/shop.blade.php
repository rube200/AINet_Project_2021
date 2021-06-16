@extends('layouts.layout')
@section('title', __('Shop-Title'))
@section('content')
    <div class="container shop-container">
        <div class="alert alert-success text-center" id="added-to-cart-alert" role="alert" style="display: none">
            {{__('Add-Cart-Alert')}}
        </div>
        <div class="row">
            <form action="{{route('index')}}" class="row" method="GET">
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
            <input id="discount-amount" value="{{$discountAmount}}" type="hidden">
            @include('partials.display_estampas', $estampas)
        </div>
        <div class="row search-shop">
            {{$estampas->withQueryString()->links()}}
        </div>
    </div>
@endsection

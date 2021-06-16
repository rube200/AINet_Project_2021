@extends('layouts.layout')
@section('title', __('Edit-Price-Title'))
@section('content')
    <div class="container">
        <form action="{{route('preco.update')}}" class="row" method="POST">
            @csrf
            @method('PUT')
            <div class="col-auto">
                <label class="col-form-label" for="preco_un_catalogo">
                    {{__('Shop-Print-Single-Text')}}
                </label>
                <input autocomplete="nome" class="form-control @error('preco_un_catalogo') is-invalid @enderror" id="preco_un_catalogo" min="0.01" name="preco_un_catalogo" step="0.01" value="{{$preco->preco_un_catalogo}}" type="number">
                @error('preco_un_catalogo')
                <strong>{{$message}}</strong>
                @enderror
            </div>
            <div class="col-auto">
                <label class="col-form-label" for="preco_un_catalogo_desconto">
                    {{__('Shop-Print-Discount-Text')}}
                </label>
                <input autocomplete="nome" class="form-control @error('preco_un_catalogo_desconto') is-invalid @enderror" id="preco_un_catalogo_desconto" min="0.01" name="preco_un_catalogo_desconto" step="0.01" value="{{$preco->preco_un_catalogo_desconto}}" type="number">
                @error('preco_un_catalogo_desconto')
                <strong>{{$message}}</strong>
                @enderror
            </div>
            <div class="col-auto">
                <label class="col-form-label" for="preco_un_proprio">
                    {{__('Costumer-Print-Single-Text')}}
                </label>
                <input autocomplete="nome" class="form-control @error('preco_un_proprio') is-invalid @enderror" id="preco_un_proprio" min="0.01" name="preco_un_proprio" step="0.01" value="{{$preco->preco_un_proprio}}" type="number">
                @error('preco_un_proprio')
                <strong>{{$message}}</strong>
                @enderror
            </div>
            <div class="col-auto">
                <label class="col-form-label" for="preco_un_proprio_desconto">
                    {{__('Costumer-Print-Discount-Text')}}
                </label>
                <input autocomplete="nome" class="form-control @error('preco_un_proprio_desconto') is-invalid @enderror" id="preco_un_proprio_desconto" min="0.01" name="preco_un_proprio_desconto" step="0.01" value="{{$preco->preco_un_proprio_desconto}}" type="number">
                @error('preco_un_proprio_desconto')
                <strong>{{$message}}</strong>
                @enderror
            </div>
            <div class="col-auto">
                <label class="col-form-label" for="quantidade_desconto">
                    {{__('Discount-Amount-Text')}}
                </label>
                <input autocomplete="nome" class="form-control @error('quantidade_desconto') is-invalid @enderror" id="quantidade_desconto" min="2" name="quantidade_desconto" value="{{$preco->quantidade_desconto}}" type="number">
                @error('quantidade_desconto')
                <strong>{{$message}}</strong>
                @enderror
            </div>
            <div class="col-auto"style="margin-top:15px">
                <br>
                <button class="btn btn-success" type="submit">
                    {{__('Save-Submit')}}
                </button>
                <a class="btn btn-secondary" href="{{route('shopManage')}}">{{__('Cancel-Submit')}}</a>
            </div>
        </form>
    </div>
@endsection

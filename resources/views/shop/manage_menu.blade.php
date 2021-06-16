@extends('layouts.layout')
@section('title', __('Manage-Menu-Title'))
@section('content')
    <div class="container">
        <div class="row">
            <label>
                {{__('Shop-Print-Single-Price', ['price' => $preco->preco_un_catalogo])}}
            </label>
            <label>
                {{__('Shop-Print-Discount-Price', ['price' => $preco->preco_un_catalogo_desconto])}}
            </label>
            <label>
                {{__('Costumer-Print-Single-Price', ['price' => $preco->preco_un_proprio])}}
            </label>
            <label>
                {{__('Costumer-Print-Discount-Price', ['price' => $preco->preco_un_proprio_desconto])}}
            </label>
            <label>
                {{__('Discount-Minimum-Amount', ['amount' => $preco->quantidade_desconto])}}
            </label>
            <a class="btn btn-success" href="{{route('preco.edit')}}">{{__('Edit-Price-Button')}}</a>
        </div>
        <br/>
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

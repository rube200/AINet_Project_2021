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
            <a class="btn btn-success" href="{{route('preco.edit')}}"style="margin-top:10px">{{__('Edit-Price-Button')}}</a>
        </div>

        @can('viewAny', \App\Models\Estampa::class)
            <div class="row-btn row">
                <a class="btn btn-success print-btn" href="{{route('estampa.index')}}"style="margin-top:10px">{{__('Manage-Prints-Text')}} </a>
            </div>
        @endcan
            @can('viewAny', \App\Models\Categoria::class)
                <div class="row-btn row">
                    <a class="btn btn-success categories-btn" href="{{route('categoria.index')}}"style="margin-top:10px">{{__('Manage-Categories-Text')}}</a>
                </div>
            @endcan
            @can('viewAny', \App\Models\Cor::class)
                <div class="row-btn row">
                    <a class="btn btn-success colors-btn" href="{{route('cor.index')}}"style="margin-top:10px">{{__('Manage-Colers-Text')}}</a>
                </div>
            @endcan
    </div>
@endsection

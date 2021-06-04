@extends('layouts.layout')
@section('title', 'Shop')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md">
                <img class="estampa-img" src="{{$estampa->img}}" alt="Imagem da estampa">
            </div>
            <div class="col-md">
                <div class="card-body estampa-body">
                    <h5 class="card-title estampa-name">{{$estampa->nome}}</h5>
                    <p class="card-text estampa-descricao">{{$estampa->descricao}}</p>
                    <form action="{{route('cart.add')}}" method="POST">
                        @csrf
                        <input type="hidden" value="{{$estampa->id}}" id="estampa-id" name="estampa-id">
                        <div class="row">
                            {{--
                            <span class="quantity_less" disabled="disabled">
                                －
                            </span>

                            <label>
                                <input class="quantity_input" data-max="100" name="quantity" type="number" value="1">
                            </label>
                            <span class="quantity_more">
                                +
                            </span>
                        --}}
                            <button class="btn btn-secondary btn-sm">
                                Add to cart
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
{{--
<div class="goodsIntro_attrBox">
<span class="compInputNumber goodsIntro_countCtrl" id="js-goodsIntroQTY">
<span class="compInputNumber_reduce" disabled="disabled">
－
</span>
<span class="compInputNumber_inputWrap">
<input type="text" value="1" name="qty" class="compInputNumber_input" data-max="100">
</span>
<span class="compInputNumber_plus">
+
</span>
</span>
</div>
--}}

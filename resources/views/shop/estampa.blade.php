@extends('layouts.shop_layout')
@section('title', __('Estampa-Title', ['name' => $estampa->nome]))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md">
                <img class="estampa-img" src="{{$estampa->img}}">
            </div>
            <div class="align-self-center col-md tex-col">
                <div class="body-estampa card-body estampa-body">
                    <h5 class="name-estampa card-title estampa-name">{{$estampa->nome}}</h5>
                    <p class="description-estampa card-text estampa-descricao">{{$estampa->descricao}}</p>
                    @include('partials.add_to_cart', ['add_button_classes' => 'btn btn-secondary btn-lg', $estampa])
                </div>
            </div>
        </div>
    </div>
@endsection

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

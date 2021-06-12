@extends('layouts.shop_layout')
@section('title', __('Shop-Title'))
@section('content')
    <div class="container shop-container">
        <div class="row">
            @include('partials.display_estampas', $estampas)
        </div>
        <div class="row">
            {{$estampas->withQueryString()->links()}}
        </div>
    </div>
@endsection

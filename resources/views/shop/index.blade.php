@extends('layouts.shop_layout')
@section('title', __('Shop-Title'))
@section('content')
    <div class="container">
        @include('partials.display_estampas', $estampas)
    </div>
@endsection

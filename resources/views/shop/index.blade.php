@extends('layouts.layout')
@section('title', 'Shop')
@section('content')
    <div class="container">
        @include('partials.display_estampas', $estampas)
    </div>
@endsection

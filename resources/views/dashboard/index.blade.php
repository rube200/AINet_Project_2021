@extends('layouts.layout')
@section('title', 'Dashboard')
@section('content')
    <h1>Some Content . . .</h1>
    <div>
        @include('partials.display_estampas', $estampas)
    </div>
@endsection

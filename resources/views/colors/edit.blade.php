@extends('layouts.layout')
@section('title', __('New-Color-Title'))
@section('content')
    <div class="container">
        <form action="{{route('cor.update', $color)}}" class="row" method="POST">
            @csrf
            @method('PUT')
            <input name="editColor" value="1" type="hidden">
            <div class="col-auto">
                <div class="color-display" style="background: {{'#' . $color->codigo}}"></div>
            </div>
            <div class="col-auto">
                <label class="col-form-label" for="nome">
                    {{__('Color-Name-Input')}}
                </label>
                <input autocomplete="nome" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" value="{{$color->nome}}" type="text">
                @error('nome')
                <strong>{{$message}}</strong>
                @enderror
            </div>
            <div class="col-auto">
                <button class="btn btn-success" type="submit">
                    {{__('Save-Submit')}}
                </button>
                <a class="btn btn-secondary" href="{{url()->previous()}}">{{__('Cancel-Submit')}}</a>
            </div>
        </form>
    </div>
@endsection

@extends('layouts.layout')
@section('title', __('New-Color-Title'))
@section('content')
    <div class="container">
        <form action="{{route('cor.store')}}" class="row" method="POST">
            @csrf
            <div class="col-auto">
                <label class="form-label" for="colorInput">{{__('Color-Input')}}</label>
                <input class="form-control form-control-color" id="colorInput" name="codigo" value="{{old('codigo')}}" type="color">
                @error('codigo')
                <strong>{{ $message }}</strong>
                @enderror
            </div>
            <div class="col-auto">
                <label class="col-form-label" for="nome">
                    {{__('Color-Name-Input')}}
                </label>
                <input autocomplete="nome" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" value="{{old('nome')}}" type="text">
                @error('nome')
                <strong>{{$message}}</strong>
                @enderror
            </div>
            <div class="col-auto">
                <button class="btn btn-primary" type="submit">
                    {{__('New-Color-Submit')}}
                </button>
            </div>
        </form>
    </div>
@endsection

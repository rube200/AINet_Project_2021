@extends('layouts.layout')
@section('title', __('New-Color-Title'))
@section('content')
    <div class="container">
        <form action="{{route('categoria.update', $categoria)}}" class="row" method="POST">
            @csrf
            @method('PUT')
            <div class="col-auto">
                <label class="col-form-label" for="nome">
                    {{__('Category-Name-Input')}}
                </label>
                <input autocomplete="nome" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" value="{{$categoria->nome}}" type="text">
                @error('nome')
                <strong>{{$message}}</strong>
                @enderror
            </div>
            <div class="col-auto">
                <button class="btn btn-success" type="submit">
                    {{__('Save-Submit')}}
                </button>
                <a class="btn btn-secondary" href="{{route('categoria.index')}}">{{__('Cancel-Submit')}}</a>
            </div>
        </form>
    </div>
@endsection

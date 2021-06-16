@extends('layouts.layout')
@section('title', __('New-Category-Title'))
@section('content')
    <div class="container">
        <form action="{{route('categoria.store')}}" class="row" method="POST">
            @csrf
            <div class="col-auto">
                <label class="col-form-label" for="nome">
                    {{__('Category-Name-Input')}}
                </label>
                <input autocomplete="nome" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" placeholder="{{__('Category-Name-Placeholder')}}" value="{{old('nome')}}" type="text">
                @error('nome')
                <strong>{{$message}}</strong>
                @enderror
            </div>
            <div class="col-auto">
                <button class="btn btn-primary" type="submit">
                    {{__('New-Category-Submit')}}
                </button>
                <a class="btn btn-secondary" href="{{route('categoria.index')}}">{{__('Cancel-Submit')}}</a>
            </div>
        </form>
    </div>
@endsection

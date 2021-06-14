@extends('layouts.layout')
@section('title', __('New-Estampa-Title'))
@section('content')
    <div class="container">
        <form action="{{route('estampa.store')}}" class="row" method="POST">
            @csrf
            <div class="col-auto">
                <label class="col-form-label" for="name">
                    {{__('Estampa-Name-Input')}}
                </label>
                <input autocomplete="name" autofocus
                       class="form-control @error('name') is-invalid @enderror" id="name"
                       name="name" required type="text" value="{{old('name')}}">
                @error('name')
                <strong>{{ $message }}</strong>
                @enderror
            </div>
            <div class="col-auto">
                <label class="col-form-label" for="description">
                    {{__('Estampa-Descricao-Input')}}
                </label>
                <textarea autocomplete="description" class="form-control @error('descricao') is-invalid @enderror" id="description" name="description" type="text">
                    {{old('descricao')}}
                </textarea>
                @error('descricao')
                <strong>{{$message}}</strong>
                @enderror
            </div>
            <div class="col-auto">
                <div class="input-group">
                    <label class="input-group-text" for="categoria">{{__('Categories-Label')}}</label>
                    <select class="form-select" id="categoria" name="categoria">
                        <option {{'' == old('categoria') ? 'selected' : ''}} value="">{{__('None-Text')}}</option>
                        @foreach($categorias as $id => $name)
                            <option
                                {{$id == old('categoria') ? 'selected' : ''}} value="{{$id}}">{{$name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{--todo upload img--}}
            <div class="col-auto">
                <button class="btn btn-primary" type="submit">
                    {{__('New-Estampa-Submit')}}
                </button>
            </div>
        </form>
    </div>
@endsection

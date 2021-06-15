@extends('layouts.layout')
@section('title', __('New-Print-Title'))
@section('content')
    <div class="container">
        <form action="{{route('estampa.store')}}" class="row" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="col-auto">
                <label class="col-form-label" for="nome">
                    {{__('Print-Name-Input')}}
                </label>
                <input autocomplete="name" autofocus
                       class="form-control @error('nome') is-invalid @enderror" id="nome"
                       name="nome" required type="text" value="{{old('nome')}}">
                @error('nome')
                <strong>{{ $message }}</strong>
                @enderror
            </div>
            <div class="col-auto">
                <label class="col-form-label" for="descricao">
                    {{__('Print-Descricao-Input')}}
                </label>
                <textarea autocomplete="descricao" class="form-control @error('descricao') is-invalid @enderror" id="descricao" name="descricao" type="text">{{old('descricao')}}</textarea>
                @error('descricao')
                <strong>{{$message}}</strong>
                @enderror
            </div>
            <div class="col-auto">
                <div class="input-group">
                    <label class="input-group-text" for="categoria_id">{{__('Categories-Label')}}</label>
                    <select class="form-select" id="categoria_id" name="categoria_id">
                        <option {{'' == old('categoria_id') ? 'selected' : ''}} value="">{{__('None-Text')}}</option>
                        @foreach($categorias as $id => $name)
                            <option
                                {{$id == old('categoria_id') ? 'selected' : ''}} value="{{$id}}">{{$name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-auto">
                <div class="input-group">
                    <label class="input-group-text" for="newPhoto">
                        {{__('Print-New-Photo')}}
                    </label>
                    <input accept="image/*" class="form-control" id="newPhoto" name="photo" type="file">
                    @error('photo')
                    <strong>{{$message}}</strong>
                    @enderror
                </div>
            </div>
            <div class="col-auto">
                <button class="btn btn-primary" type="submit">
                    {{__('New-Print-Submit')}}
                </button>
                <a class="btn btn-secondary" href="{{route('estampa.index')}}">{{__('Cancel-Submit')}}</a>
            </div>
        </form>
    </div>
@endsection

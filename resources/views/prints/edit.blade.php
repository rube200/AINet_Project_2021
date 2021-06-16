@extends('layouts.layout')
@section('title', __('Edit-Print-Title', ['name' => $estampa->nome]))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-auto">
                <img class="edit-print-img-view" src="{{$estampa->img}}">
                <form action="{{route('estampa.update', $estampa)}}" class="row" enctype="multipart/form-data"
                      method="POST">
                    @csrf
                    @method('PUT')
                    <input name="editPrint" value="1" type="hidden">
                    <div class="col-auto">
                        <label class="col-form-label" for="nome">
                            {{__('Print-Name-Input')}}
                        </label>
                        <input autocomplete="name" autofocus
                               class="form-control @error('nome') is-invalid @enderror" id="nome"
                               name="nome" required type="text" value="{{old('nome', $estampa->nome)}}">
                        @error('nome')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="col-auto">
                        <label class="col-form-label" for="descricao">
                            {{__('Print-Descricao-Input')}}
                        </label>
                        <textarea autocomplete="descricao" class="form-control @error('descricao') is-invalid @enderror"
                                  id="descricao" name="descricao"
                                  type="text">{{old('descricao', $estampa->descricao)}}</textarea>
                        @error('descricao')
                        <strong>{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="col-auto">
                        <div class="input-group">
                            <label class="input-group-text" for="categoria_id">{{__('Categories-Label')}}</label>
                            <select class="form-select" id="categoria_id" name="categoria_id">
                                <option
                                    {{'' == old('categoria_id', $estampa->categoria_idcategoria_id) ? 'selected' : ''}} value="">{{__('None-Text')}}</option>
                                @foreach($categorias as $id => $name)
                                    <option
                                        {{$id == old('categoria_id', $estampa->categoria_id) ? 'selected' : ''}} value="{{$id}}">{{$name}}</option>
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
                        <button class="btn btn-success" type="submit">
                            {{__('Save-Submit')}}
                        </button>
                        <a class="btn btn-secondary" href="{{route('estampa.index')}}">{{__('Cancel-Submit')}}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

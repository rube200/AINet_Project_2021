@extends('layouts.layout')
@section('title', __('Cart-Title'))
@section('content')
    <div class="container">
        @foreach($cart as $id => $data)
            <div class="row">
                <div class="col-auto">
                    <img src="{{$data['url']}}" style="max-width: 100px"> {{--todo take this to css --}}
                </div>
                <div class="align-self-center col-md tex-col">
                    <p>{{__('Cart-Display-Name', ['name' => $data['nome']])}}</p>
                    <p>{{__('Cart-Display-Amount', ['amount' => $data['amount']])}}</p>
                    <p>{{__('Cart-Display-Size', ['size' => $data['size']])}}</p>
                    <p>{{__('Cart-Display-Price', ['price' => $data['preco']])}}</p>
                    <p>{{__('Cart-Display-Subtotal', ['price' => number_format(($data['amount'] > $preco->quantidade_desconto ? $data['preco_desconto'] : $data['preco']) * $data['amount'], 2)])}}</p>
                </div>
            </div>
        @endforeach
            @empty($cart)
                <div class="row">
                    <p>{{__('Cart-Empty')}}</p>
                </div>
            @else
                <div class="row">
                    <p>{{__('Cart-Display-Total', ['price' => $data['preco']])}}</p>
                </div>
            @endempty
    </div>
@endsection

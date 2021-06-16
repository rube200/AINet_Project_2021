@extends('layouts.layout')
@section('title', __('Cart-Title'))
@section('content')
    <div class="container">
        @foreach($cart as $id => $data)
            <form action="{{route('cart.remove', $id)}}" class="row" id="remove-from-cart-form-{{$id}}" method="POST">
                @csrf
                <input name="estampaId" value="{{$data['estampaId']}}" type="hidden">
                <input id="preco-{{$id}}" value="{{$data['preco']}}" type="hidden">
                <input id="preco-desconto-{{$id}}" value="{{$data['preco_desconto']}}" type="hidden">

                <div class="col-auto">
                    <img src="{{$data['tshirt-url']}}" style="max-width: 100px">
                    <img src="{{$data['print-url']}}" style="max-width: 100px">
                </div>

                <div class="align-self-center col-md tex-col">
                    <p>{{__('Cart-Display-Name', ['name' => $data['nome']])}}</p>
                    <p>{{__('Cart-Display-Amount', ['amount' => $data['amount']])}}</p>
                    <p>{{__('Cart-Display-Size', ['size' => $data['size']])}}</p>
                    <p>{{__('Cart-Display-Price', ['price' => $data['preco']])}}</p>
                    <p>{{__('Cart-Display-Subtotal', ['price' => $data['subtotal']])}}</p>
                </div>

                <div class="col-auto">
                    <button class="btn btn-secondary">
                        {{__('Delete-From-Cart')}}
                    </button>
                </div>
            </form>
        @endforeach
        @empty($cart)
            <div class="row">
                <p>{{__('Cart-Empty')}}</p>
            </div>
        @else
            <div class="row">
                <p>{{__('Cart-Display-Total', ['price' => $total])}}</p>
            </div>
        @endempty
    </div>
@endsection

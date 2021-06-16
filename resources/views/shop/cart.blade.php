@extends('layouts.layout')
@section('title', __('Cart-Title'))
@section('content')
    <div class="container">
        @foreach($cart as $id => $data)
            <form action="{{route('cart.remove', $id)}}" class="row shirt-row" id="remove-from-cart-form-{{$id}}"
                  method="POST">
                @csrf
                <input name="estampaId" value="{{$data['estampaId']}}" type="hidden">
                <input id="preco-{{$id}}" value="{{$data['preco']}}" type="hidden">
                <input id="preco-desconto-{{$id}}" value="{{$data['preco_desconto']}}" type="hidden">

                <div class="col-auto">
                    <br/>
                    <img class="shirt-img" src="{{$data['tshirt-url']}}">
                    <img class="print-img" src="{{$data['print-url']}}">
                </div>

                <div class="align-self-center col-md tex-col">
                    <p class="name-shirt">{{__('Cart-Display-Name', ['name' => $data['nome']])}}</p>
                    <p class="amout-shirt">{{__('Cart-Display-Amount', ['amount' => $data['amount']])}}</p>
                    <p class="size-shirt">{{__('Cart-Display-Size', ['size' => $data['size']])}}</p>
                    <p class="price-shirt">{{__('Cart-Display-Price', ['price' => $data['preco']])}}</p>
                    <p class="subtotal-shirt">{{__('Cart-Display-Subtotal', ['price' => $data['subtotal']])}}</p>
                </div>

                <div class="col-auto">
                    <br>
                    <br>
                    <br>
                    <button class="btn btn-danger delete-btn">
                        {{__('Delete-From-Cart')}}
                    </button>
                </div>
            </form>
        @endforeach
        @empty($cart)
            <div class="row">
                <p class="empty-cart">{{__('Cart-Empty')}}</p>
                <a class="btn btn-secundary back-btn" href="{{route('index')}}">{{__('Back-Shop')}}</a>
            </div>
        @else
            <div class="row">
                <p class="total-cart">{{__('Cart-Display-Total', ['price' => $total])}}</p>
            </div>
        @endempty
    </div>
@endsection

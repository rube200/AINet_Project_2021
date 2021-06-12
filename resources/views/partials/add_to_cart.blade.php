<a class="{{$add_button_classes}}" href="#" onclick="event.preventDefault();document.getElementById('cart-add-{{$estampa->id}}').submit();">{{--todo js--}}
    {{__('AddToCard')}}
</a>
<form action="{{route('cart.add')}}" class="form-group" id="cart-add-{{$estampa->id}}" method="POST">
    @csrf
    <input id="estampa-id" name="estampa-id" value="{{$estampa->id}}" type="hidden">
</form>

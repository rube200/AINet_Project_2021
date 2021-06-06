<a class="{{$add_button_classes}}" href="#" onclick="event.preventDefault();document.getElementById('cart-add-{{$estampa->id}}').submit();">{{--todo js--}}
    {{__('AddToCard')}}
</a>
<form action="{{route('cart.add')}}" id="cart-add-{{$estampa->id}}" method="POST">
    @csrf
    <input type="hidden" value="{{$estampa->id}}" id="estampa-id" name="estampa-id">
</form>

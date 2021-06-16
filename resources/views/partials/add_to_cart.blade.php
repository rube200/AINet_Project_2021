<form action="{{route('cart.add')}}" class="add-cart-form row" id="add-to-cart-form-{{$estampa->id}}" method="POST" {!!$show ? '' : 'style="display: none"'!!}>
    @csrf
    <input name="estampaId" value="{{$estampa->id}}" type="hidden">
    <div class="col-auto">
        <label for="amount-{{$estampa->id}}">
            {{__('Add-To-Car-Amount')}}
        </label>
        <input class="form-control" id="amount-{{$estampa->id}}" name="amount" min="1" value="{{old('amount', 1)}}" type="number">
    </div>
    <div class="col-auto">
        <label for="add-cart-select-color-{{$estampa->id}}">
            {{__('Add-To-Car-Color')}}
        </label>
        <select class="form-control" id="add-cart-select-color-{{$estampa->id}}" name="color" onchange="AddCartColorSelect({{$estampa->id}})">
            @foreach($cores as $id => $nome)
                <option value="{{$id}}" {{$id == old('color', $id) ? 'selected' : ''}} style="background: {{'#' . $id}};">{{$nome}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-auto">
        <label for="size-{{$estampa->id}}">
            {{__('Add-To-Car-Size')}}
        </label>
        <select class="form-control" id="size-{{$estampa->id}}" name="size">
            <option value="XS" {{'XS' == old('size', 'M') ? 'selected' : ''}}>XS</option>
            <option value="S" {{'S' == old('size', 'M') ? 'selected' : ''}}>S</option>
            <option value="M" {{'M' == old('size', 'M') ? 'selected' : ''}}>M</option>
            <option value="L" {{'L' == old('size', 'M') ? 'selected' : ''}}>L</option>
            <option value="XL" {{'XL' == old('size', 'M') ? 'selected' : ''}}>XL</option>
        </select>
    </div>
</form>
<br/>
<button class="btn btn-secondary" id="add-to-cart-button" onclick="AddCart({{$estampa->id . ',' . $show}})">
    {{__('Add-To-Cart')}}
</button>

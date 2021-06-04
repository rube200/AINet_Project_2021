<div class="row estampas-area">
    @foreach($estampas as $estampa)
        <div class="col-lg-3">
            <div class="card estampa-card">
                <a class="estampa-item-link" href="{{route('estampa.view', $estampa->id)}}">
                    <img class="card-img-top estampa-img-browse" src="{{$estampa->img}}" alt="Imagem da estampa">
                    <div class="card-body estampa-body">
                        <h5 class="card-title estampa-name">{{$estampa->nome}}</h5>
                        <p class="card-text estampa-descricao">{{$estampa->descricao}}</p>
                        <form action="{{route('cart.add')}}" method="POST">
                            @csrf
                            <input type="hidden" value="{{$estampa->id}}" id="estampa-id" name="estampa-id">
                            <div class="row">
                                <button class="btn btn-secondary btn-sm">
                                    Add to cart
                                </button>
                            </div>
                        </form>
                    </div>
                </a>
            </div>
        </div>
    @endforeach
</div>

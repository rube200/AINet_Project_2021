<div class="row estampas-area">
    @foreach($estampas as $estampa)
        <div class="col-lg-3 col-sm-6 ">
            <div class="card estampa-card">
                <a class="estampa-item-link" href="{{route('estampa.view', $estampa->id)}}">
                    <img class="card-img-top estampa-img-browse" src="{{$estampa->img}}" alt="Imagem da estampa">
                    <div class="card-body estampa-body text-center">
                        <h5 class="card-title estampa-name">{{$estampa->nome}}</h5>
                        <p class="text-estampa card-text estampa-descricao">{{$estampa->descricao}}</p>
                        @include('partials.add_to_cart', ['add_button_classes' => 'btn btn-secondary', $estampa])
                    </div>
                </a>
            </div>
        </div>
    @endforeach
</div>

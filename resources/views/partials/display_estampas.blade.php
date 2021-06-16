@foreach($estampas as $estampa)
    <div class="col-lg-3 col-sm-6">
        <div class="card shop-estampa-card">
            <a class="shop-estampa-link" href="{{route('estampa.show', $estampa)}}">
                <img class="card-img-top shop-estampa-img" src="{{$estampa->img}}" alt="Imagem da estampa">
            </a>
            <div class="card-body shop-estampa-body text-center">
                <a class="shop-estampa-link" href="{{route('estampa.show', $estampa)}}">
                    <h5 class="card-title shop-estampa-name">{{$estampa->nome}}</h5>
                    <p class="card-text shop-estampa-description">{{$estampa->descricao}}</p>
                </a>
                @include('partials.add_to_cart', $estampa)
            </div>
        </div>
    </div>
@endforeach


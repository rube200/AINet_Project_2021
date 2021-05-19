<div class="estampa-area">
    @foreach($estampas as $estampa)
        <div class="estampa">
            <div class="estampa-imagem">
                <img src="{{$estampa->img}}" alt="Imagem da estampa">
            </div>
            <div class="estampa-info-area">
                <div class="estampa-name">{{$estampa->nome}}</div>
                <div class="estampa-descricao">{{$estampa->descricao}}</div>
            </div>
        </div>
    @endforeach
</div>

<?php

namespace App\Http\Controllers;

use App\Models\Estampa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    /**
     * Show the application shop.
     *
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $estampasQuery = Estampa::select('nome', 'descricao', 'imagem_url')
            ->whereNull('cliente_id');
        if (($categoria = $request->query('categoria', '0')) != 0)//todo verificar query
            $estampasQuery->where('categoria_id', $categoria);
        $estampas = $estampasQuery->get();

        foreach ($estampas as $estampa)
            $estampa->img = asset('storage/estampas/' . $estampa->imagem_url);

        if (Auth::check()) {
            $estampasPrivadas = Estampa::select('nome', 'descricao', 'imagem_url')
                ->where('cliente_id', Auth::id())
                ->get();

            foreach ($estampasPrivadas as $estampa)
                $estampa->img = 'data:image/png;base64,' . base64_encode(Storage::get('estampas_privadas/' . $estampa->imagem_url));

            $estampas = $estampas->toBase()->merge($estampasPrivadas);
        }

        return view('shop.index')->withEstampas($estampas);
    }
}

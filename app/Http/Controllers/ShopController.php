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
        $estampasQuery = Estampa::select('id', 'nome', 'descricao', 'imagem_url', 'cliente_id');
        if (Auth::check()) {
            $estampasQuery->whereRaw('(`cliente_id` is null or `cliente_id` = ?)', Auth::id());
        } else {
            $estampasQuery->whereNull('cliente_id');
        }

        if (($categoria = $request->query('categoria', '0')) != 0) {
            $estampasQuery->where('categoria_id', $categoria);
        }

        $estampas = $estampasQuery->orderBy('id')->paginate(20);
        foreach ($estampas as $estampa) {
            if (is_null($estampa->cliente_id))
                $estampa->img = asset('storage/estampas/' . $estampa->imagem_url);
            else
                $estampa->img = 'data:image/png;base64,' . base64_encode(Storage::get('estampas_privadas/' . $estampa->imagem_url));
        }

        return view('shop.index')->withEstampas($estampas);
    }

    public function show(Estampa $estampa)
    {
        if (is_null($estampa->cliente_id)) {
            $estampa->img = asset('storage/estampas/' . $estampa->imagem_url);
        } else {
            $estampa->img = 'data:image/png;base64,' . base64_encode(Storage::get('estampas_privadas/' . $estampa->imagem_url));
        }
        return view('shop.estampa')->withEstampa($estampa);
    }
}

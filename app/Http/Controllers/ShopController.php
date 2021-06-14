<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Estampa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Estampa::select('id', 'nome', 'descricao', 'imagem_url', 'cliente_id');
        $user = Auth::user();
        if (!is_null($user)) {
            switch (strtoupper($user->tipo)) {
                case 'A':
                case 'F':
                    break;

                default:/* isto garante acesso apenas a funcionarios e admins mesmo que seja criado outro tipo */
                    $query->whereRaw('(`cliente_id` is null or `cliente_id` = ?)', Auth::id());
            }
        } else {
            $query->whereNull('cliente_id');
        }

        $categoria = $request->categoria ?? '';
        if ($categoria) {
            $query->where('categoria_id', $categoria);
        }

        $searchName = $request->search ?? '';
        if ($searchName) {
            $query->orWhere('nome', 'LIKE', '%' . $searchName . '%');
            $query->orWhere('descricao', 'LIKE', '%' . $searchName . '%');
        }

        $estampas = $query->orderBy('id')->paginate(20);
        foreach ($estampas as $estampa)
            $this->prepareEstampaImage($estampa);

        $categorias = Categoria::pluck('nome', 'id');
        return view('shop.index')->withEstampas($estampas)->withCategorias($categorias)->withCategoriaEscolhida($categoria)->withSearch($searchName);
    }

    public function prepareEstampaImage(Estampa $estampa)
    {
        if (is_null($estampa->cliente_id)) {
            $path = 'public/estampas/' . $estampa->imagem_url;
        } else {
            $path = 'estampas_privadas/' . $estampa->imagem_url;
        }

        if (Storage::exists($path)) {
            $estampa->img = 'data:image/png;base64,' . base64_encode(Storage::get($path));
        } else {
            $estampa->img = asset('not_found');/*todo*/
        }
    }

    public function show(Estampa $estampa)
    {
        $this->prepareEstampaImage($estampa);
        return view('shop.estampa')->withEstampa($estampa);
    }
}

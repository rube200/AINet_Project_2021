<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Estampa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EstampaController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Estampa::class);
    }

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
        return view('estampas.estampas')->withEstampas($estampas)->withCategorias($categorias)->withCategoriaEscolhida($categoria)->withSearch($searchName);
    }

    public function show(Estampa $estampa)
    {
        $this->prepareEstampaImage($estampa);
        return view('estampas.estampa')->withEstampa($estampa);
    }

    public function create()
    {
        $categorias = Categoria::pluck('nome', 'id');
        return view('estampas.create')->withCategorias($categorias);
    }

    public function store(Request $request)
    {

    }

    public function edit(Estampa $estampa)
    {

    }

    public function update(Request $request, Estampa $estampa)
    {

    }

    public function destroy(Estampa $estampa)
    {

    }

    protected static function prepareEstampaImage(Estampa $estampa)
    {
        if (is_null($estampa->cliente_id)) {
            $path = 'public/estampas/' . $estampa->imagem_url;
        } else {
            $path = 'estampas_privadas/' . $estampa->imagem_url;
        }

        $estampa->img = 'data:image/png;base64,' . base64_encode(Storage::get($path));
    }
}

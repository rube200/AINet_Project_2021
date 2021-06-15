<?php

namespace App\Http\Controllers;

use App\Http\Requests\EstampaPost;
use App\Models\Categoria;
use App\Models\Estampa;
use Illuminate\Http\RedirectResponse;
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
        return EstampaController::displayEstampas($request, 'prints.prints');
    }

    public function show(Estampa $estampa)
    {
        EstampaController::prepareEstampaImage($estampa);
        return view('prints.print')->withEstampa($estampa);
    }

    public function create()
    {
        $categorias = Categoria::pluck('nome', 'id');
        return view('prints.create')->withCategorias($categorias);
    }

    public function store(EstampaPost $request): RedirectResponse
    {
        $estampaData = $request->validated();
        unset($estampaData['photo']);

        $path = $request->photo->store('public/estampas/');
        $estampaData['imagem_url'] = basename($path);

        Estampa::create($estampaData);
        return redirect()->route('estampa.index');
    }

    public function edit(Estampa $estampa)
    {
        EstampaController::prepareEstampaImage($estampa);
        $categorias = Categoria::pluck('nome', 'id');
        return view('prints.edit')->withEstampa($estampa)->withCategorias($categorias);
    }

    public function update(EstampaPost $request, Estampa $estampa): RedirectResponse
    {
        $estampaData = $request->validated();
        unset($estampaData['photo']);

        if (is_null($estampa->cliente_id)) {
            $path = 'public/estampas';
        } else {
            $path = 'estampas_privadas';
        }

        if ($request->hasFile('photo')) {
            Storage::delete($path .'/' . $estampa->imagem_url);
            $path = $request->photo->store($path);
            $estampa->imagem_url = basename($path);
        }
        $estampa->fill($estampaData);
        $estampa->save();

        return redirect()->route('estampa.index');
    }

    public function destroy(Estampa $estampa): RedirectResponse
    {
        $estampa->delete();
        return redirect()->back();
    }

    public static function displayEstampas(Request $request, string $viewName)
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
            EstampaController::prepareEstampaImage($estampa);

        $categorias = Categoria::pluck('nome', 'id');
        return view($viewName)->withEstampas($estampas)->withCategorias($categorias)->withCategoriaEscolhida($categoria)->withSearch($searchName);
    }

    public static function prepareEstampaImage(Estampa $estampa)
    {
        if (is_null($estampa->cliente_id)) {
            $path = 'public/estampas/' . $estampa->imagem_url;
        } else {
            $path = 'estampas_privadas/' . $estampa->imagem_url;
        }

        $estampa->img = 'data:image/png;base64,' . base64_encode(Storage::get($path));
    }
}

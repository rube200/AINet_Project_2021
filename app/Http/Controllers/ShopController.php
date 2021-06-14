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
    public function index(/*Request $request*/)
    {
        /*&& $user->hasVerifiedEmail()*/
        $estampasQuery = Estampa::select('id', 'nome', 'descricao', 'imagem_url', 'cliente_id');
        $user = Auth::user();
        if (!is_null($user)) {
            switch (strtoupper($user->tipo)) {
                case 'A':
                case 'F':
                    break;

                default:/* isto garante acesso apenas a funcionarios e admins mesmo que seja criado outro tipo */
                    $estampasQuery->whereRaw('(`cliente_id` is null or `cliente_id` = ?)', Auth::id());
            }
        } else {
            $estampasQuery->whereNull('cliente_id');
        }

        /*if (($categoria = $request->query('categoria', '0')) != 0) {
            $estampasQuery->where('categoria_id', $categoria);
        }*/

        $estampas = $estampasQuery->orderBy('id')->paginate(20);
        foreach ($estampas as $estampa) {
            $this->prepareEstampaImage($estampa);
        }

        return view('shop.index')->withEstampas($estampas);
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

<?php

namespace App\Http\Controllers;

use App\Models\Estampa;
use http\Env\Request;
use Illuminate\Contracts\Support\Renderable;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return Renderable
     */
    public function index(Request $request): Renderable
    {
        if (!$request->has('categoria') || ($categoria = $request->query('categoria', '0')) == 0)
        {
            $listaEstampas = Estampa::pluck('id', 'nome', 'descricao', 'imagem_url');
        }
        else
        {
            $listaEstampas = Estampa::where('categoria_id', $categoria)
                ->pluck('id', 'nome', 'descricao', 'imagem_url');
        }
        return view('dashboard.index')
            ->withEstampas($listaEstampas);
    }
}

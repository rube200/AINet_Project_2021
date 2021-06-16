<?php

namespace App\Http\Controllers;

use App\Http\Requests\CorPost;
use App\Models\Cor;
use Illuminate\Http\RedirectResponse;

class CorController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Cor::class);
    }

    public function index()
    {
        $cores = Cor::get();
        return view('colors.colors')->withColors($cores);
    }

    public function create()
    {
        return view('colors.create');
    }

    public function store(CorPost $request): RedirectResponse
    {
        $colorData = $request->validated();

        //Se o request for valido é pq a cor nao existe ou foi apagada
        $cor = Cor::withTrashed()->find($colorData['codigo']);
        if ($cor)
        {
            $cor->fill($colorData);
            $cor->restore();
        }
        else
            Cor::create($colorData);

        return redirect()->route('cor.index');
    }

    public function edit(Cor $cor)
    {
        return view('colors.edit')->withColor($cor);
    }

    public function update(CorPost $request, Cor $cor): RedirectResponse
    {
        $colorData = $request->validated();

        $cor->nome = $colorData['nome'];
        $cor->save();

        return redirect()->route('cor.index');
    }

    public function destroy(Cor $cor): RedirectResponse
    {
        $cor->delete();
        return redirect()->route('cor.index');
    }
}

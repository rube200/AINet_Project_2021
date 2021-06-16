<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrecoPost;
use App\Models\Preco;
use Illuminate\Http\RedirectResponse;

class PrecoController extends Controller
{
    public function edit()
    {
        $preco = Preco::first();
        return view('shop.edit_price')->withPreco($preco);
    }

    public function update(PrecoPost $request): RedirectResponse
    {
        $priceData = $request->validated();

        $preco = Preco::first();
        $preco->fill($priceData);
        $preco->save();

        return redirect()->route('shopManage');
    }
}

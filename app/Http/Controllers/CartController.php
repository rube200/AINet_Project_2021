<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartPost;
use App\Models\Estampa;
use App\Models\Preco;
use Illuminate\Http\RedirectResponse;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart');
        if (!$cart) {
            $cart = [];
            session()->put('cart', $cart);
        }
        return view('shop.cart')->withCart($cart);
    }

    public function add(CartPost $request): RedirectResponse
    {
        $data = $request->validated();
        $estampa = Estampa::find($data['estampaId']);
        $preco = Preco::first();

        if (is_null($estampa->cliente_id))
        {
            $data['preco'] = $preco->preco_un_catalogo;
            $data['preco_desconto'] = $preco->preco_un_catalogo_desconto;
        }
        else
        {
            $data['preco'] = $preco->preco_un_proprio;
            $data['preco_desconto'] = $preco->preco_un_proprio_desconto;
        }

        $key = $data['estampaId'] . '_' . $data['color'] . '_' . $data['size'];
        $cart = session()->get('cart');

        if (!$cart) {
            $cart = [$key => $data];
        }
        else if (isset($cart[$key])) {
            $cart[$key]['amount'] += $data['amount'];
        }
        else {
            $cart[$key] = $data;
        }

        session()->put('cart', $cart);
        return redirect()->back();
    }
}

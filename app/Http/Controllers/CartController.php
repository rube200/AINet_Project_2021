<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartPost;
use App\Models\Estampa;
use App\Models\Preco;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart');
        if ($cart) {
            foreach ($cart as $id => $data) {
                $cart[$id]['nome'] = Estampa::find($data['estampaId'])->nome;
                $cart[$id]['url'] = CartController::getTShirtImage($data['color']);
            }
        }
        else {
            $cart = [];
            session()->put('cart', $cart);
        }

        $preco = Preco::first();
        return view('shop.cart')->withCart($cart)->withPreco($preco);
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

    private static function getTShirtImage($color): string
    {
        $path = 'tshirt_base/' . $color . '.jpg';
        if (!Storage::exists('public/' . $path)) {
            return asset('storage/tshirt_base/plain_white.png');
        }

        return asset('storage/' . $path);
    }
}

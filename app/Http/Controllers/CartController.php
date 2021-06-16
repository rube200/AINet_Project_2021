<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartPost;
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
        return view('cart.index');
    }

    public function add(CartPost $request): RedirectResponse
    {
        $data = $request->validated();

        dd('va');
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

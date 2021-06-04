<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function add(Request $request)
    {
        //$id = $request->id;
        if (false) {
            abort(404);
        }

        $cart = session()->get('cart');
        if (!$cart) {
            $cart = [
                /*$id => [
                    "quantity" => 1
                ]*/
            ];

            session()->put('cart', $cart);
            return redirect()->back();
        }

        return redirect()->back();

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;

            session()->put('cart', $cart);
            return redirect()->back();
        }

        $cart[$id] = [
            /*$id => [
                "quantity" => 1
            ]*/
        ];

        session()->put('cart', $cart);
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Preco;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        return EstampaController::displayEstampas($request, 'shop.shop');
    }

    public function shopManage()
    {
        $preco = Preco::first();
        return view('shop.manage_menu')->withPreco($preco);
    }
}

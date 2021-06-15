<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        return EstampaController::displayEstampas($request, 'shop.shop');
    }

    public function shopManage()
    {
        return view('shop.manage_menu');
    }
}

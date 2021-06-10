<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profiles.profile')->withUser(Auth::user());
    }

    public function profiles()
    {
        $users = User::select('id', 'name', 'tipo', 'bloqueado', 'foto_url')->orderBy('id')->paginate(20);
        return view('profiles.profiles')->withUsers($users);
    }
}

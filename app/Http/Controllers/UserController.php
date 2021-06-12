<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPost;
use App\Models\Cliente;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, null, [
            'except' => [ 'create', 'destroy', 'edit', 'show', 'store', 'update' ] /* some of these dont work*/
        ]);
    }

    public function index(): View
    {
        $users = User::select('id', 'name', 'tipo', 'bloqueado', 'foto_url')->orderBy('name')->paginate(20);
        foreach ($users as $user)
            UserController::prepareEstampaImage($user);

        return view('profiles.profiles')->withUsers($users);
    }

    public function create()
    {
        if (Auth::user())
            return redirect()->back();

        return view('profiles.create');
    }

    public function store(UserPost $request): RedirectResponse
    {
        if (Auth::user())
            return redirect()->back();

        $userData = $request->validated();
        $userData['password'] = Hash::make($userData['password']);
        $user = User::create($userData);

        $client = new Cliente;
        $client->id = $user->id;
        $client->save();

        /* todo need to warn about confirm email */
        Auth::guard()->login($user);
        return redirect()->route('index');
    }

    /**
     * @throws AuthorizationException
     */
    public function show(int $id): View
    {
        $target = User::findOrFail($id);
        $this->authorize('view', $target);

        UserController::prepareEstampaImage($target);
        return view('profiles.profile')->withUser($target);
    }

    /**
     * @throws AuthorizationException
     */
    public function edit(int $id)
    {
        $target = User::findOrFail($id);
        $this->authorize('update', $target);


    }

    /**
     * @throws AuthorizationException
     */
    public function update(UserPost $request, int $id): RedirectResponse
    {
        $target = User::findOrFail($id);
        $this->authorize('updateBlock', $target);

        $userData = $request->validated();
        /* todo use with to return msg */
        if ($userData['toggleBlock']) {
            $target->bloqueado = !$target->bloqueado;
            $target->save();
            return redirect()->back();
        }

        //update data

        return redirect()->back();
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(int $id): RedirectResponse
    {
        $target = User::findOrFail($id);
        $this->authorize('delete', $target);
        $target->delete();

        return redirect()->back();
    }

    protected static function prepareEstampaImage(User $user)
    {
        $path = 'public/fotos/' . $user->foto_url;
        if (!is_null($user->foto_url) && Storage::exists($path)) {
            $user->img = 'data:image/png;base64,' . base64_encode(Storage::get($path));
        } else {
            $user->img = asset('storage/fotos/default-profile-picture.png');
        }
    }
}

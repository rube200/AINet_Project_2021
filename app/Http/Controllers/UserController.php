<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPost;
use App\Models\Cliente;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, null, [
            'except' => ['create', 'destroy', 'edit', 'show', 'store', 'update'] /* some of these dont work*/
        ]);
    }

    public function index(Request $request): View
    {
        $query = User::select('id', 'name', 'tipo', 'bloqueado', 'foto_url');

        $tipo = $request->tipo ?? '';
        if ($tipo) {
            $query->where('tipo', $tipo);
        }

        $searchName = $request->search ?? '';
        if ($searchName) {
            $query->where('name', 'LIKE', '%' . $searchName . '%');
        }

        $users = $query->orderBy('name')->paginate(20);
        foreach ($users as $user)
            UserController::prepareUserImage($user);

        return view('profiles.profiles')->withUsers($users)->withSelectedTipo($tipo)->withSearch($searchName);
    }

    protected static function prepareUserImage(User $user)
    {
        $path = 'public/fotos/' . $user->foto_url;
        if (is_null($user->foto_url)) {
            $user->img = asset('storage/fotos/default-profile-picture.png');
            return;
        }

        if (!Storage::exists($path)) {
            $user->foto_url = null;
            $user->img = asset('storage/fotos/default-profile-picture.png');
            return;
        }

        $user->img = 'data:image/png;base64,' . base64_encode(Storage::get($path));
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

        unset($userData['photo']);
        $user = User::create($userData);
        if ($request->hasFile('photo')) {
            $path = $request->photo->store('public/fotos');
            $user->foto_url = basename($path);
        }

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

        UserController::prepareUserImage($target);
        return view('profiles.profile')->withUser($target);
    }

    /**
     * @throws AuthorizationException
     */
    public function edit(int $id)
    {
        $target = User::findOrFail($id);
        $this->authorize('edit', $target);

        UserController::prepareUserImage($target);
        return view('profiles.edit')->withUser($target);
    }

    /**
     * @throws AuthorizationException
     */
    public function update(UserPost $request, int $id): RedirectResponse
    {
        $target = User::findOrFail($id);
        $userData = $request->validated();

        if ($request->get('toggleBlock', false)) {
            $this->authorize('updateBlock', $target);
            $target->bloqueado = !$target->bloqueado;
            $target->save();
            return redirect()->back();
        }

        $this->authorize('edit', $target);
        $target->name = $userData['name'];
        if ($request->hasFile('photo')) {
            Storage::delete('public/fotos/' . $target->foto_url);
            $path = $request->photo->store('public/fotos');
            $target->foto_url = basename($path);
        }

        $target->save();
        return redirect()->back();
    }

    public function resetPhoto(User $user): RedirectResponse
    {
        if (is_null($user->foto_url))
            return redirect()->back();

        Storage::delete('public/fotos/' . $user->foto_url);
        $user->foto_url = null;
        $user->save();

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
}

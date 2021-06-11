<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPost;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, null, [
            'except' => [ 'destroy', 'show', 'update' ] /* for some reason theses don't work */
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $users = User::select('id', 'name', 'tipo', 'bloqueado', 'foto_url')->orderBy('id')->paginate(20);
        foreach ($users as $user)
            UserController::prepareEstampaImage($user);

        return view('profiles.profiles')->withUsers($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return View
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserPost $request
     * @param int $id
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function update(UserPost $request, int $id): RedirectResponse
    {
        $target = User::findOrFail($id);
        $this->authorize('updateBlock', $target);

        $userData = $request->validated();

        /* todo use with to return msg */
        if ($userData['toggleBlock'])
        {
            $target->bloqueado = !$target->bloqueado;
            $target->save();
            return redirect()->back();
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function destroy(int $id): RedirectResponse
    {
        $target = User::findOrFail($id);
        $this->authorize('delete', $target);
        $target->delete();
        return redirect()->back();
    }

    public static function prepareEstampaImage(User $user)
    {
        $path = 'public/fotos/' . $user->foto_url;
        if (!is_null($user->foto_url) && Storage::exists($path)) {
            $user->img = 'data:image/png;base64,' . base64_encode(Storage::get($path));
        } else {
            $user->img = asset('storage/fotos/default-profile-picture.png');
        }
    }
}

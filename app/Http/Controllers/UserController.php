<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, null, [
            'except' => [ 'show' ] /* for some reason this policy doesn't work */
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = User::select('id', 'name', 'tipo', 'bloqueado', 'foto_url')->orderBy('id')->paginate(20);
        foreach ($users as $user)
            $this->prepareEstampaImage($user);

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
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $target = User::findOrFail($id);
        $this->authorize('view', $target);

        $this->prepareEstampaImage($target);
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function prepareEstampaImage(User $user)
    {
        $path = 'public/fotos/' . $user->foto_url;
        if (!is_null($user->foto_url) && Storage::exists($path)) {
            $user->img = 'data:image/png;base64,' . base64_encode(Storage::get($path));
        } else {
            $user->img = asset('storage/fotos/default-profile-picture.png');/*todo*/
        }
    }
}

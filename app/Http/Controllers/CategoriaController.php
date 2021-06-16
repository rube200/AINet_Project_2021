<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriaPost;
use App\Models\Categoria;
use App\Models\Estampa;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;

class CategoriaController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Categoria::class, null, [
            'except' => ['destroy', 'edit', 'update']
        ]);
    }

    public function index()
    {
        $categorias = Categoria::get();
        return view('categories.categories')->withCategorias($categorias);
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(CategoriaPost $request): RedirectResponse
    {
        $categoryData = $request->validated();

        $category = Categoria::withTrashed()->where('nome', $categoryData['nome'])->first();
        if ($category)
        {
            $category->fill($categoryData);
            $category->restore();
        }
        else
            Categoria::create($categoryData);

        return redirect()->route('categoria.index');
    }

    /**
     * @throws AuthorizationException
     */
    public function edit(int $id)
    {
        $categoria = Categoria::findOrFail($id);
        $this->authorize('update', $categoria);

        return view('categories.edit')->withCategoria($categoria);
    }

    /**
     * @throws AuthorizationException
     */
    public function update(CategoriaPost $request, int $id): RedirectResponse
    {
        $categoria = Categoria::findOrFail($id);
        $this->authorize('update', $categoria);

        $colorData = $request->validated();
        $categoria->nome = $colorData['nome'];
        $categoria->save();

        return redirect()->route('categoria.index');
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(int $id): RedirectResponse
    {
        $categoria = Categoria::findOrFail($id);
        $this->authorize('delete', $categoria);

        $categoria->delete();
        return redirect()->route('categoria.index');
    }
}

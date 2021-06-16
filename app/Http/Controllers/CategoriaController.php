<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriaPost;
use App\Models\Categoria;
use Illuminate\Http\RedirectResponse;

class CategoriaController extends Controller
{
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

    public function edit(int $id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('categories.edit')->withCategoria($categoria);
    }

    public function update(CategoriaPost $request, int $id): RedirectResponse
    {
        $colorData = $request->validated();
        $categoria = Categoria::findOrFail($id);

        $categoria->nome = $colorData['nome'];
        $categoria->save();

        return redirect()->route('categoria.index');
    }

    public function destroy(int $id): RedirectResponse
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();
        return redirect()->route('categoria.index');
    }
}

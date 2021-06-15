<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriaPost extends FormRequest
{
    public function authorize()
    {
        $user = $this->user();
        return $user->can('isAdmin', $user);
    }

    public function rules(): array
    {
        return [
            'nome' => 'required|unique:categorias,nome,NULL,id,deleted_at,NULL|string|max:255',
        ];
    }
}

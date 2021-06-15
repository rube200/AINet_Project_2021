<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\File;

/**
 * @property File photo
 */
class EstampaPost extends FormRequest
{
    public function authorize(): bool
    {
        $user = $this->user();
        return $user->can('isAdmin', $user);
    }

    public function rules(): array
    {
        return [
            'editPrint' => 'bail|sometimes|boolean',
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string|max:255',
            'photo' => 'required_unless:editPrint,true|image|max:8192',
            'categoria_id' => 'nullable|exists:categorias,id|integer'
        ];
    }
}

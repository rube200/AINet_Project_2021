<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrecoPost extends FormRequest
{
    public function authorize()
    {
        $user = $this->user();
        return $user->can('isAdmin', $user);
    }

    public function rules(): array
    {
        return [
            'preco_un_catalogo' => 'bail|required|numeric|min:0.01|multiple_of:0.01',
            'preco_un_proprio' => 'required|numeric|min:0.01|multiple_of:0.01',
            'preco_un_catalogo_desconto' => 'required|numeric|lte:preco_un_catalogo|min:0.01|multiple_of:0.01',
            'preco_un_proprio_desconto' => 'required|numeric|lte:preco_un_proprio|min:0.01|multiple_of:0.01',
            'quantidade_desconto' => 'required|integer|min:2'
        ];
    }
}

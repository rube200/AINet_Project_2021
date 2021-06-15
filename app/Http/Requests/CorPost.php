<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CorPost extends FormRequest
{
    public function authorize()
    {
        $user = $this->user();
        return $user->can('isAdmin', $user);
    }

    public function rules(): array
    {
        return [
            'editColor' => 'bail|sometimes|boolean',
            'codigo' => 'exclude_if:editColor,true|required|unique:cores|string',
            'nome' => 'required|unique:cores|string|max:255',
        ];
    }
}

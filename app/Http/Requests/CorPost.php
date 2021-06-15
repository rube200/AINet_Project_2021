<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CorPost extends FormRequest
{
    protected $stopOnFirstFailure = true;

    public function authorize()
    {
        //remove # before validation
        if ($this->request->has('codigo'))
            $this->request->set('codigo',  str_replace('#', '', $this->request->get('codigo')));

        $user = $this->user();
        return $user->can('isAdmin', $user);
    }

    public function rules(): array
    {
        return [
            'editColor' => 'sometimes|boolean',
            'codigo' => 'exclude_if:editColor,true|required|unique:cores,codigo,NULL,codigo,deleted_at,NULL|string',
            'nome' => 'required|unique:cores,nome,NULL,codigo,deleted_at,NULL|string|max:255',
        ];
    }
}

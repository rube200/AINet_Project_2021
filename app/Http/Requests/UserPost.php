<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        if ($this->request->getBoolean('toggleBlock'))
            return $this->user()->can('isAdmin', $this->user());

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'toggleBlock' => 'bail|sometimes|boolean',
            'name' => 'exclude_if:toggleBlock,true|string|max:255',
            'email' => 'exclude_if:toggleBlock,true|string|email|unique:users|max:255',
            'password' => ['exclude_if:toggleBlock,true', Password::defaults(), 'confirmed']
        ];
    }
}

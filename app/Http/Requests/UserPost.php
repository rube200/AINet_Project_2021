<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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

        /* todo finish */
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
            'name' => 'exclude_if:toggleBlock,true|string|max:255'
        ];
    }
}

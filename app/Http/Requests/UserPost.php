<?php

namespace App\Http\Requests;

use Faker\Core\File;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

/**
 * @property File photo
 */
class UserPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        $user = $this->user();
        if ($this->request->getBoolean('toggleBlock'))
            return $user->can('isAdmin', $user);

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
            'toggleBlock' => 'bail|sometimes|boolean',//if True block user
            'editProfile' => 'sometimes|boolean',//if True edit user
            //Else create user
            'name' => 'exclude_if:toggleBlock,true|required|string|max:255',
            'email' => 'exclude_if:toggleBlock,true|exclude_if:editProfile,true|required|string|email|unique:users|max:255',
            'password' => ['exclude_if:toggleBlock,true', 'exclude_if:editProfile,true', 'required', Password::defaults(), 'confirmed'],
            'photo' => 'exclude_if:toggleBlock,true|nullable|image|max:8192'
        ];
    }
}

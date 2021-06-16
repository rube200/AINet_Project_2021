<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CartPost extends FormRequest
{
    public function rules(): array
    {
        return [
            'estampaId' => 'bail|required|exists:estampas,id',
            'amount' => 'required|integer|min:1',
            'color' => 'required|exists:cores,codigo',
            'size' => 'required|in:XS,S,M,L,XL'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 400));
    }
}

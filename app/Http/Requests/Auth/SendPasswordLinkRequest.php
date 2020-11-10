<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\ApiFormRequest;

class SendPasswordLinkRequest extends ApiFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|email|exists:users,email'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Pole email jest wymagane.',
            'email.email' => 'Niepoprawny format adresu email.',
            'email.exists' => 'Nie ma takiego emaila w bazie.',
        ];
    }
}

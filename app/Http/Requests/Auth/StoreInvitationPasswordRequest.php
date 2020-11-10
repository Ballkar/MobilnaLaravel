<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\ApiFormRequest;

class StoreInvitationPasswordRequest extends ApiFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'password' => 'required|min:6|confirmed',
            'token' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'Pole hasło jest wymagane.',
            'password.min' => 'Pole hasło musi mieć przynajmniej :min znaków.',
            'password.confirmed' => 'Wpisane hasła się różnią.',
        ];
    }
}

<?php

namespace App\Http\Requests\Auth;

use App\Http\Controllers\Constants\Roles;
use App\Http\Requests\ApiFormRequest;

class RegisterRequest extends ApiFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|max:255|unique:users,email',
//            'reg' => 'accepted',
            'name' => 'required|min:3|max:11',
            'password' => 'required|min:6',
            'acc_type' => 'required|in:'.implode(',', Roles::returnSafe()),
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Pole Email jest wymagane.',
            'email.email' => 'Niepoprawny format pola email.',
            'email.max' => 'Pole Email nie może mieć więcej niż 255 znaków.',
            'email.unique' => 'Ten adres email jest już zarejestrowany.',
            'reg.accepted' => 'Aby się zarejestrować musisz zaakceptować regulamin.',
            'password.required' => 'Pole hasło jest wymagane.',
            'password.min' => 'Pole Hasło musi mieć przynajmniej 6 znaków.',
            'password.confirmed' => 'Wpisane hasła nie są takie same.'
        ];
    }
}

<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\ApiFormRequest;

class StoreNewPasswordRequest extends ApiFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}

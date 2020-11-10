<?php

namespace App\Http\Requests\Auth;

use App\Http\Controllers\Constants\Roles;
use App\Http\Requests\Api\ApiFormRequest;

class LoginRequest extends ApiFormRequest
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
            'email' => 'required|email',
            'password' => 'required',
            'acc_type' => 'required|in:'.implode(',', Roles::returnAll()),
        ];
    }
}

<?php

namespace App\Http\Requests\Admin;

use App\Http\Controllers\Constants\UserRoles;
use App\Http\Requests\ApiFormRequest;
use Illuminate\Validation\Rule;

class AddUsersRequest extends ApiFormRequest
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
            'reg' => 'accepted',
            'name' => 'required|min:3|max:11',
            'password' => 'required|min:6',
            'acc_type' => 'required|in:'.implode(',', UserRoles::returnSafe()),
        ];
    }
}

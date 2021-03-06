<?php

namespace App\Http\Requests\Admin;

use App\Http\Controllers\Constants\UserRoles;
use App\Http\Requests\ApiFormRequest;
use Illuminate\Validation\Rule;

class UsersListRequest extends ApiFormRequest
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
            'page' => 'integer',
            'limit' => 'integer',
            'sort_by' => 'string',
            'order' => 'string',
        ];
    }
}

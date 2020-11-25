<?php

namespace App\Http\Requests\Admin;

use App\Http\Controllers\Constants\Roles;
use App\Http\Requests\ApiFormRequest;
use Illuminate\Validation\Rule;

class WalletTransactionRequest extends ApiFormRequest
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
            'money_flow_type' => ['required', Rule::in(['ADD', 'SUBTRACT'])],
            'money' => 'required|integer',
            'user_id' => 'exists:users,id',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'name' => 'required_without:user_id|string|min:4',
            'surname' => 'string|min:4',
            'phone' => 'required_without:user_id|string|min:4',
            'additional_info' => 'nullable|string|min:4',

            // 'city_id' => 'exists:cities,id',
            // 'road' => 'string|min:4',
            // 'house_number' => 'string|min:1',
            // 'flat_number' => 'string|min:1',
            // 'birth_date' => 'date|nullable',//
            // 'user_id' => 'required_without_all:name,phone|exists:users,id',
        ];
    }
}

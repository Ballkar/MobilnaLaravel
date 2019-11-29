<?php

namespace App\Http\Requests\Api\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserDetailsRequest extends FormRequest
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
            'name' => 'required|string|min:4',
            'surname' => 'string|min:4',
            'phone' => 'required|string|min:4',
            'voivodeship' => 'string|min:4',
            'city' => 'string|min:4',
            'road' => 'string|min:4',
            'house_number' => 'string|min:1',
            'flat_number' => 'string|min:1',
            'additional_info' => 'string|min:4',
            'birth_date' => 'date|nullable',
            'avatar' => 'image|nullable',
        ];
    }
}

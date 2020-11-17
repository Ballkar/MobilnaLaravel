<?php

namespace App\Http\Requests\Message;

use Illuminate\Foundation\Http\FormRequest;

class MessageSettingRequest extends FormRequest
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
            'active' => 'boolean',
            'hour' => 'required|int',
            'minute' => 'required|int',
            'time_type' => 'required|int',
            'schema_id' => 'exists:message_schemas,id',
        ];
    }
}

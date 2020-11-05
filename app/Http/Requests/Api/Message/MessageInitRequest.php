<?php

namespace App\Http\Requests\Api\Api\Message;

use Illuminate\Foundation\Http\FormRequest;

class MessageInitRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'customer_id' => 'exists:customers,id',
            'schema_id' => 'exists:message_schemas,id',
            'date' => 'date',
        ];
    }
}

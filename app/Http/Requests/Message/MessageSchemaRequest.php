<?php

namespace App\Http\Requests\Message;

use Illuminate\Foundation\Http\FormRequest;

class MessageSchemaRequest extends FormRequest
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
            'name' => 'string|min:4',
            'body' => 'array',
            'body.*.text' => 'required_without:body.*.variable|required_without:body.*.model',
            'body.*.variable' => 'required_with:body.*.model|required_without:body.*.text',
            'body.*.model' => 'required_with:body.*.variable',
            'clear_diacritics' => 'required',
        ];
    }
}

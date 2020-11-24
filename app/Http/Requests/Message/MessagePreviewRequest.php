<?php

namespace App\Http\Requests\Message;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MessagePreviewRequest extends FormRequest
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
            'clear_diacritics' => 'required',
            'body' => 'array',
            'body.*.text' => ['required_without:body.*.variable', 'required_without:body.*.model'],
            'body.*.variable' => ['required_with:body.*.model', 'required_without:body.*.text'],
            'body.*.model' => ['required_with:body.*.variable', 'required_without:body.*.text', Rule::in(['customer', 'work', 'user']),],
        ];
    }
}

<?php

namespace App\Http\Requests\Message\Plans;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RemindPlanPreviewRequest extends FormRequest
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
            'schema_id' => 'exists:message_plans_remind_schema,id',
        ];
    }
}

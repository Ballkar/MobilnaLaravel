<?php

namespace App\Http\Requests\Message\Plans;

use App\Models\Message\Plans\RemindPlan;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RemindPlanRequest extends FormRequest
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
            'schema_id' => 'exists:message_plans_remind_schema,id',
            'active' => 'boolean',
        ];
    }
}

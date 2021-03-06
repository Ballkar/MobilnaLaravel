<?php

namespace App\Http\Resources\Message\Plans;

use App\Models\Message\Plans\RemindPlan as RemindPlanModel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RemindPlan extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'schema_id' => $this->schema_id,
            'hour' => RemindPlanModel::$sendHour,
            'minute' => RemindPlanModel::$sendMinute,
            'active' => $this->active,
        ];
    }
}

<?php

namespace App\Http\Resources\Message\Plans;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RemindPlanSchema extends JsonResource
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
            'body' => $this->body,
        ];
    }
}

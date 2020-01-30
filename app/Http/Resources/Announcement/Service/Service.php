<?php

namespace App\Http\Resources\Announcement\Service;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Service extends JsonResource
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
            'group_id' => $this->group_id,
            'announcement_id' => $this->announcement_id,
            'name' => $this->name,
            'price' => $this->price,
            'time_hours' => $this->time_hours,
            'time_minutes' => $this->time_minutes,
        ];
    }
}

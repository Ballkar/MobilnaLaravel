<?php

namespace App\Http\Resources\Announcement\Calendar;

use Illuminate\Http\Resources\Json\JsonResource;

class ActionSingle extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}

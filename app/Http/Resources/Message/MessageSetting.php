<?php

namespace App\Http\Resources\Message;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageSetting extends JsonResource
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
            'hour' => $this->hour,
            'minute' => $this->minute,
            'dayBefore' => $this->day_before,
            'sameDay' => $this->same_day,
            'active' => $this->messages_active,
        ];
    }
}

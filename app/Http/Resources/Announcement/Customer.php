<?php

namespace App\Http\Resources\Announcement;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Customer extends JsonResource
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
            'user_id' => $this->user_id,
            'name' => $this->name,
            'surname' => $this->surname,
            'additional_info' => $this->additional_info,

            $this->mergeWhen($this->owner_id === $request->user('api')->id, [
                'phone' => $this->phone,
                'birth_date' => $this->birth_date,
                'city_id' => $this->city_id,
                'road' => $this->road,
                'house_number' => $this->house_number,
                'flat_number' => $this->flat_number,
            ]),

            'created_at' => $this->created_at->format('Y-m-d H:i:s'),

        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'role_id' => $this->role_id,

            'name' => $this->name,
            'phone' => $this->phone,
            'state' => $this->state,
            'city' => $this->city,
            'road' => $this->road,
            'house_number' => $this->house_number,
            'flat_number' => $this->flat_number,
            'additional' => $this->additional,
        ];
    }
}

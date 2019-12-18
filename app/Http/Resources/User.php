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
            'reg' => $this->reg,

            'name' => $this->name,
            'surname' => $this->surname,
            'phone' => $this->phone,
            'city' => $this->city,
            'road' => $this->road,
            'house_number' => $this->house_number,
            'flat_number' => $this->flat_number,
            'birth_date' => $this->birth_date,
            'additional_info' => $this->additional_info,
            'avatar' => env('APP_URL').'/storage/users/'.$this->id.'/avatar/'.$this->avatar,
            'avatar_thumbnail' => env('APP_URL').'/storage/users/'.$this->id.'/avatar/'.$this->avatar_thumbnail,
        ];
    }
}

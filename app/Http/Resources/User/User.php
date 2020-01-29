<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $authUser = $request->user('api');
        return [
            'id' => $this->id,
            'email' => $this->email,
            'name' => $this->name,
            'surname' => $this->surname,
            'city' => $this->city,
            'road' => $this->road,
            'house_number' => $this->house_number,
            'flat_number' => $this->flat_number,
            'additional_info' => $this->additional_info,
            'avatar' => env('APP_URL').'/storage/users/'.$this->id.'/avatar/'.$this->avatar,
            'avatar_thumbnail' => env('APP_URL').'/storage/users/'.$this->id.'/avatar/'.$this->avatar_thumbnail,

            $this->mergeWhen((!$authUser || !$authUser->isAdmin()) && $authUser->id !== $this->id, [
                'phone' => substr($this->phone, 0, 3).preg_replace("/[0-9]/", '*', substr($this->phone, 3)),
            ]),

            $this->mergeWhen($authUser && ($authUser->isAdmin() || $authUser->id === $this->id), [
                'phone' => $this->phone,
                'reg' => $this->reg,
                'role_id' => $this->role_id,
                'birth_date' => $this->birth_date,
            ]),

        ];
    }
}

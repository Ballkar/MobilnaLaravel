<?php

namespace App\Http\Resources\Announcement;

use App\Http\Resources\Announcement\Service\Service as ServiceResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class Announcement extends JsonResource
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
            'description' => $this->description,
            'city' => $this->city->name,
            'city_id' => $this->city_id,
            'owner_name' => $this->owner->name,
            'main_photo' => $this->main_image,
            'is_active' => $this->is_active,
            'is_local' => $this->is_local,
            'is_mobile' => $this->is_mobile,
            'services' => ServiceResource::collection($this->services),

            $this->mergeWhen($this->is_mobile, [
                'mobile_price' => $this->mobile_price,
                'mobile_distance' => $this->mobile_distance,
            ]),
            $this->mergeWhen($this->is_local, [
                'road' => $this->road,
                'house_number' => $this->house_number,
                'flat_number' => $this->flat_number,
            ]),
            $this->mergeWhen(Auth::guard('api')->user()->isAdmin() || Auth::guard('api')->check() && $this->owner->id == Auth::guard('api')->id(), [
                'phone' => $this->owner->phone,
            ]),
            $this->mergeWhen($this->owner->id !== Auth::guard('api')->id(), [
                'phone' => substr($this->owner->phone, 0, 3).preg_replace("/[0-9]/", '*', substr($this->owner->phone, 3)),
            ]),
        ];
    }
}

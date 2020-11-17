<?php

namespace App\Http\Resources\Message;

use App\Http\Resources\BaseResourceCollection;
use Illuminate\Http\Request;

class MessageSettingCollection extends BaseResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}

<?php

namespace App\Http\Resources\Customer;

use App\Http\Resources\BaseResourceCollection;
use Illuminate\Http\Request;

class CustomerCollection extends BaseResourceCollection
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

<?php

namespace App\Http\Resources\User;

use App\Http\Resources\BaseResourceCollection;
use Illuminate\Http\Request;

class WalletTransactionCollection extends BaseResourceCollection
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

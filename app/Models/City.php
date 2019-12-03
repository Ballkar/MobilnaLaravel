<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class City extends Model
{
    protected $guarded = [];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function districts()
    {
        return $this->hasMany(District::class);
    }

    public function scopeLocation(Builder $query, $lat, $lon, $radius = 10){
        $haversine = '( 6371 * acos( cos( radians('.$lat.') ) *
			         cos( radians( lat ) )
			         * cos( radians( lon ) - radians('.$lon.')
			         ) + sin( radians('.$lat.') ) *
			         sin( radians( lat ) ) )
			       ) AS distance';

        $where =   "ROUND(( 10  * 6371 * acos( cos( radians('$lat') ) * "
            . "cos( radians(lat) ) * "
            . "cos( radians(lon) - radians('$lon') ) + "
            . "sin( radians('$lat') ) * "
            . "sin( radians(lat) ) ) ) ,8) <=". $radius
            .' and lat IS NOT NULL';
        return $query->select('cities.*')
            ->selectRaw($haversine)
            ->orderBy('distance')
            ->whereRaw($where);
    }
}

<?php

namespace App\Http\Controllers\Api\City;

use App\Http\Controllers\ApiCommunication;
use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\City as CityResource;

class CityController extends Controller
{
    use ApiCommunication;

    public function index(Request $request)
    {
        $request->validate([
            'city' => 'required'
        ]);
        $cities = City::where('name', 'LIKE', "{$request->city}%")->limit(5)->get();

        return $this->sendResponse(new CityResource($cities), 'Cities returned!');
    }

    public function getByCoordinates(Request $request)
    {
        $cities = City::location($request->lat, $request->lon, $request->distance)->get();

        return $this->sendResponse(new CityResource($cities), 'Cities returned!');
    }
}

<?php

namespace App\Http\Controllers\Api\City;

use App\Http\Controllers\ApiCommunication;
use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\City as CityResource;
use App\Http\Resources\BaseResourceCollection;

class CityController extends Controller
{
    use ApiCommunication;

    public function index(Request $request)
    {
        $request->validate([
            'city' => 'required',
            'per_page' => 'integer',
        ]);
        $cities = City::where('name', 'LIKE', "{$request->city}%")->paginate($request->per_page ?? 5);

//        dd($cities);
        return $this->sendResponse(new BaseResourceCollection($cities), 'Cities returned!');
    }

    public function getByCoordinates(Request $request)
    {
        $cities = City::location($request->lat, $request->lon, $request->distance)->paginate($request->per_page ?? 5);

        return $this->sendResponse(new BaseResourceCollection($cities), 'Cities returned!');
    }
}

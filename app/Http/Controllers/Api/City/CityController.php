<?php

namespace App\Http\Controllers\Api\City;

use App\Http\Controllers\ApiCommunication;
use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CityController extends Controller
{
    use ApiCommunication;

    public function index(Request $request)
    {
        $cities = City::where('name', 'LIKE', "{$request->city}%")->limit(10)->get();

        return $this->sendResponse($cities, 'Cities returned!');
    }
}

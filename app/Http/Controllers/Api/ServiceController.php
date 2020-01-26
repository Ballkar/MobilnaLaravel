<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiCommunication;
use App\Models\Announcement\Service\Service;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    use ApiCommunication;

    /**
     * @return JsonResponse
     */
    public function index()
    {
        $services = Service::paginate(10);
        return $this->sendResponse($services, 'All service');
    }
}

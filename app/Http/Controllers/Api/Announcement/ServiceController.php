<?php

namespace App\Http\Controllers\Api\Announcement;

use App\Http\Controllers\ApiCommunication;
use App\Http\Requests\Api\Announcement\UpdateService;
use App\Http\Resources\Announcement\Service\ServiceCollection;
use App\Http\Resources\BaseResourceCollection;
use App\Http\Resources\Announcement\Service\Service as ServiceResources;
use App\Models\Announcement\Announcement;
use App\Models\Announcement\Service\Service;
use Exception;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Api\Announcement\StoreService;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    use ApiCommunication;

    /**
     * @param Announcement $announcement
     * @return JsonResponse
     */
    public function index(Announcement $announcement)
    {
        return $this->sendResponse(ServiceResources::collection($announcement->services), 'All services from announcement returned!');
    }

    /**
     * @param StoreService $request
     * @param Announcement $announcement
     * @return JsonResponse
     */
    public function store(StoreService $request, Announcement $announcement)
    {
        $service = Service::create(array_merge($request->validated(), ['announcement_id' => $announcement->id]));
        return $this->sendResponse(new ServiceResources($service), 'Services added!', 203);
    }

    /**
     * @param Announcement $announcement
     * @param Service $service
     * @return JsonResponse
     */
    public function show(Announcement $announcement, Service $service)
    {
        return $this->sendResponse(new ServiceResources($service), 'Service returned!');
    }

    /**
     * @param UpdateService $request
     * @param Announcement $announcement
     * @param Service $service
     * @return JsonResponse
     */
    public function update(UpdateService $request, Announcement $announcement, Service $service)
    {
        $service->update($request->validated());
        return $this->sendResponse(new ServiceResources($service), 'Service updated');
    }

    /**
     * @param Announcement $announcement
     * @param Service $service
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Announcement $announcement, Service $service)
    {
        $service->delete();
        return $this->sendResponse(null, 'Service deleted', 204);
    }
}

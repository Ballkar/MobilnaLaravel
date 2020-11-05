<?php

namespace App\Http\Controllers\Api\v1\Announcement\Action;

use App\Http\Controllers\ApiCommunication;
use App\Http\Requests\Api\Api\Announcement\UpdateService;
use App\Http\Resources\Announcement\Action;
use App\Http\Resources\Announcement\Service\ServiceCollection;
use App\Http\Resources\BaseResourceCollection;
use App\Http\Resources\Announcement\Service\Service as ServiceResources;
use App\Models\Announcement\Announcement;
use App\Models\Announcement\Service\Service;
use Exception;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Api\Api\Announcement\StoreService;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    use ApiCommunication;

    /**
     * @param Action $action
     * @return JsonResponse
     */
    public function index(Action $action)
    {
        return $this->sendResponse(ServiceResources::collection($action->services), 'All services from action returned!');
    }

    /**
     * @param StoreService $request
     * @param Action $action
     * @return JsonResponse
     */
    public function store(StoreService $request, Action $action)
    {
        $service = Service::create(array_merge($request->validated(), ['announcement_id' => $action->id]));
        return $this->sendResponse(new ServiceResources($service), 'Services added!', 203);
    }

    /**
     * @param Action $action
     * @param Service $service
     * @return JsonResponse
     */
    public function show(Action $action, Service $service)
    {
        return $this->sendResponse(new ServiceResources($service), 'Service returned!');
    }

    /**
     * @param UpdateService $request
     * @param Action $action
     * @param Service $service
     * @return JsonResponse
     */
    public function update(UpdateService $request, Action $action, Service $service)
    {
        $service->update($request->validated());
        return $this->sendResponse(new ServiceResources($service), 'Service updated');
    }

    /**
     * @param Action $action
     * @param Service $service
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Action $action, Service $service)
    {
        $service->delete();
        return $this->sendResponse(null, 'Service deleted', 204);
    }
}

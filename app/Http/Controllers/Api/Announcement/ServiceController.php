<?php

namespace App\Http\Controllers\Api\Announcement;

use App\Http\Controllers\ApiCommunication;
use App\Http\Requests\Api\Announcement\UpdateService;
use App\Http\Resources\AnnouncementService as ServiceResources;
use App\Models\Announcement;
use App\Models\AnnouncementService;
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
        $service = AnnouncementService::where('announcement_id', $announcement->id)->paginate(10);
        return $this->sendResponse(new ServiceResources($service), 'All services from announcement returned!');
    }

    /**
     * @param StoreService $request
     * @param Announcement $announcement
     * @return JsonResponse
     */
    public function store(StoreService $request, Announcement $announcement)
    {
        $service = AnnouncementService::create(array_merge($request->validated(), ['announcement_id' => $announcement->id]));
        return $this->sendResponse(new ServiceResources($service), 'Services added!');
    }

    /**
     * @param Announcement $announcement
     * @param AnnouncementService $service
     * @return JsonResponse
     */
    public function show(Announcement $announcement, AnnouncementService $service)
    {
        return $this->sendResponse(new ServiceResources($service), 'Service returned!', 200);
    }

    /**
     * @param UpdateService $request
     * @param Announcement $announcement
     * @param AnnouncementService $service
     * @return JsonResponse
     */
    public function update(UpdateService $request, Announcement $announcement, AnnouncementService $service)
    {
        $service->update($request->validated());
        return $this->sendResponse(new ServiceResources($service), 'Service updated', 200);
    }

    /**
     * @param Announcement $announcement
     * @param AnnouncementService $service
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Announcement $announcement, AnnouncementService $service)
    {
        $service->delete();
        return $this->sendResponse(null, 'Service deleted', 200);
    }
}

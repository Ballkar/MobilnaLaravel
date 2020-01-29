<?php

namespace App\Http\Controllers\Api\Announcement;

use App\Http\Controllers\ApiCommunication;
use App\Http\Requests\Api\Announcement\SearchAnnouncementRequest;
use App\Http\Requests\Api\Announcement\StoreAnnouncementRequest;
use App\Http\Requests\Api\Announcement\UpdateAnnouncementRequest;
use App\Http\Resources\Announcement\Announcement as AnnouncementResource;
use App\Http\Resources\Announcement\AnnouncementCollection;
use App\Models\Announcement\Announcement;
use Exception;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    use ApiCommunication;

    public function __construct()
    {
        $this->authorizeResource(Announcement::class, 'announcement');
    }

    /**
     * @param SearchAnnouncementRequest $request
     * @return JsonResponse
     */
    public function index(SearchAnnouncementRequest $request)
    {
        if($request->city_id) {
            $announcements = Announcement::where('city_id', $request->city_id)->active()->paginate(10);
        } else {
            $announcements = Announcement::active()->paginate(10);
        }
        return $this->sendResponse(new AnnouncementCollection($announcements), 'All announcement returned');
    }

    /**
     * @param StoreAnnouncementRequest $request
     * @return JsonResponse
     */
    public function store(StoreAnnouncementRequest $request)
    {
        $announcements = Announcement::create(array_merge($request->validated(), ['owner_id' => Auth::id()]));
        return $this->sendResponse(new AnnouncementResource($announcements), 'Announcement created', 201);
    }

    /**
     * @param Announcement $announcement
     * @return JsonResponse
     */
    public function show(Announcement $announcement)
    {
        return $this->sendResponse(new AnnouncementResource($announcement), 'Announcement returned');
    }

    /**
     * @param UpdateAnnouncementRequest $request
     * @param Announcement $announcement
     * @return JsonResponse
     */
    public function update(UpdateAnnouncementRequest $request, Announcement $announcement)
    {
        $announcement->update($request->validated());
        return $this->sendResponse(new AnnouncementResource($announcement), 'Announcement updated');
    }

    /**
     * @param Announcement $announcement
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Announcement $announcement)
    {
        $announcement->delete();
        return $this->sendResponse(null, 'Announcement deleted', 204);
    }
}

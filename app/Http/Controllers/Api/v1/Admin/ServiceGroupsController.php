<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\ApiCommunication;
use App\Models\Announcement\Service\ServiceGroup;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BaseResourceCollection;
use App\Http\Resources\Announcement\Service\ServiceGroup as ServiceGroupResource;

class ServiceGroupsController extends Controller
{
    use ApiCommunication;

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $groups = ServiceGroup::paginate(10);
        return $this->sendResponse(new BaseResourceCollection($groups), 'All announcement service groups returned');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([ 'name' => 'required|string|min:3' ]);

        $group = ServiceGroup::create([
            'name' => $request->name,
        ]);

        return $this->sendResponse(new ServiceGroupResource($group), 'Announcement service group added!');
    }

    /**
     * Display the specified resource.
     *
     * @param ServiceGroup $serviceGroup
     * @return JsonResponse
     */
    public function show(ServiceGroup $serviceGroup)
    {
        return $this->sendResponse(new ServiceGroupResource($serviceGroup), 'Announcement service group returned');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param ServiceGroup $serviceGroup
     * @return JsonResponse
     */
    public function update(Request $request, ServiceGroup $serviceGroup)
    {
        $request->validate([ 'name' => 'required|string|min:3' ]);

        $group = ServiceGroup::update([
            'name' => $request->name,
        ]);

        return $this->sendResponse(new ServiceGroupResource($group), 'Announcement service group updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ServiceGroup $serviceGroup
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(ServiceGroup $serviceGroup)
    {
        $serviceGroup->delete();
        return $this->sendResponse(null, 'Announcement service group deleted!', 204);
    }
}

<?php

namespace App\Http\Controllers\Api\v1\Calendar;

use App\Http\Controllers\ApiCommunication;
use App\Http\Requests\Calendar\WorkRequest;
use App\Http\Resources\Calendar\Work as WorkResource;
use App\Http\Resources\Calendar\WorkCollection;
use App\Models\Calendar\Work;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WorksController extends Controller
{
    use ApiCommunication;

    public function __construct()
    {
        $this->authorizeResource(Work::class, 'work');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $start = $request->get('start') ? $request->get('start') : 10;
        $stop = $request->get('stop') ? $request->get('stop') : 10;
        $start = Carbon::make($start);
        $stop = Carbon::make($stop);
        $works = Work::where('owner_id', '=', Auth::id())
            ->where('start', '>=', $start)
            ->where('stop', '<=', $stop)
            ->get();

        return $this->sendResponse(new WorkCollection($works), 'All works returned');
    }

     /**
      * @param WorkRequest $request
      * @param Work $work
      * @return JsonResponse
      */
     public function update(WorkRequest $request, Work $work)
     {
         $work->update($request->validated());
         return $this->sendResponse(new WorkResource($work), 'Work updated');
     }

     /**
      * @param WorkRequest $request
      * @return JsonResponse
      */
     public function store(WorkRequest $request)
     {
         $work = Work::create(array_merge($request->validated(), [
             'owner_id' => Auth::id(),
         ]));
         return $this->sendResponse(new WorkResource($work), 'Work Added', 201);
     }

    // /**
    //  * @param Customer $customer
    //  * @return JsonResponse
    //  */
    // public function show(Customer $customer)
    // {
    //     return $this->sendResponse(new CustomerResource($customer), 'Customer returned');
    // }

     /**
      * @param Work $work
      * @return JsonResponse
      * @throws Exception
      */
     public function destroy(Work $work)
     {
         $work->delete();
         return $this->sendResponse(null, 'Work deleted', 204);
     }
}

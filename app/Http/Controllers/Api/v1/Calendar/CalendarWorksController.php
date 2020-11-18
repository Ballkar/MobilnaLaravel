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

class CalendarWorksController extends Controller
{
    use ApiCommunication;
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $limit = $request->get('limit') ? $request->get('limit') : 10;
        $start = $request->get('start') ? $request->get('start') : 10;
        $stop = $request->get('stop') ? $request->get('stop') : 10;
        $start = Carbon::make($start);
        $stop = Carbon::make($stop);
        $works = Work::where('owner_id', '=', Auth::id())
            ->where('start', '>=', $start)
            ->where('stop', '<=', $stop)
            ->paginate($limit);

        return $this->sendResponse(new WorkCollection($works), 'All works returned');
    }

     /**
      * @param WorkRequest $request
      * @param Work $calendarWork
      * @return JsonResponse
      */
     public function update(WorkRequest $request, Work $calendarWork)
     {
         $calendarWork->update($request->validated());
         return $this->sendResponse(new WorkResource($calendarWork), 'Work updated');
     }

     /**
      * @param WorkRequest $request
      * @return JsonResponse
      */
     public function store(WorkRequest $request)
     {
         $calendarWork = Work::create(array_merge($request->validated(), [
             'owner_id' => Auth::id(),
         ]));
         return $this->sendResponse(new WorkResource($calendarWork), 'Work Added', 201);
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
      * @param Work $calendarWork
      * @return JsonResponse
      * @throws Exception
      */
     public function destroy(Work $calendarWork)
     {
         $calendarWork->delete();
         return $this->sendResponse(null, 'Work deleted', 204);
     }
}

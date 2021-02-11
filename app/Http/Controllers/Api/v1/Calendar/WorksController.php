<?php

namespace App\Http\Controllers\Api\v1\Calendar;

use App\Http\Controllers\ApiCommunication;
use App\Http\Requests\Calendar\GetCalendarWorksRequest;
use App\Http\Requests\Calendar\WorkMassUpdateRequest;
use App\Http\Requests\Calendar\WorkAddUpdateRequest;
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
     * @param GetCalendarWorksRequest $request
     * @return JsonResponse
     */
    public function index(GetCalendarWorksRequest $request)
    {
//        dd($request->get('label_ids'));
        $start = $request->get('start') ? $request->get('start') : null;
        $stop = $request->get('stop') ? $request->get('stop') : null;
        $start = $start ? Carbon::make($start) : Carbon::now();
        $stop = $stop ? Carbon::make($stop) : Carbon::now()->addDay();

        $labelsIds = $request->get('label_ids');

        $hasEmpty = in_array(null, $labelsIds);

        $works = Work::where('owner_id', '=', Auth::id())
            ->whereIn('label_id', $labelsIds)->when($hasEmpty, function ($query) {
                return $query->orWhereNull('label_id');
            })
            ->where('start', '>=', $start)
            ->where('start', '>=', $start)
            ->where('stop', '<=', $stop)
            ->paginate(999999999999);


//        return $this->sendResponse($request->get('label_ids'), 'All works returned');
        return $this->sendResponse(new WorkCollection($works), 'All works returned');
    }

     /**
      * @param WorkAddUpdateRequest $request
      * @param Work $work
      * @return JsonResponse
      */
     public function update(WorkAddUpdateRequest $request, Work $work)
     {
         $work->update($request->validated());
         return $this->sendResponse(new WorkResource($work), 'Work updated');
     }

    public function massUpdate(WorkMassUpdateRequest $request)
    {
        $works = collect($request->get('works'))
            ->each(function ($item) {
                $work = Work::find($item['id']);
                $this->authorize('update', $work);
                $work->update([
                    'start' => $item['start'],
                    'stop' => $item['stop'],
                    'customer_id' => $item['customer_id'],
                    'label_id' => $item['label_id'],
                ]);
            });
        return $this->sendResponse($works, 'Works updated');
    }

     /**
      * @param WorkAddUpdateRequest $request
      * @return JsonResponse
      */
     public function store(WorkAddUpdateRequest $request)
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

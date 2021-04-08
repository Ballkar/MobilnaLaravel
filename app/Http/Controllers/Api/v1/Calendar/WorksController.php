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
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        $start = $request->get('start') ? $request->get('start') : null;
        $stop = $request->get('stop') ? $request->get('stop') : null;
        $start = $start ? Carbon::make($start) : Carbon::now();
        $stop = $stop ? Carbon::make($stop) : Carbon::now()->addDay();

        $workersIds = $request->get('workers_ids');

        $hasEmpty = in_array(null, $workersIds);

        $works = Work::where('owner_id', '=', Auth::id())
            ->where(function($query) use ($workersIds,$hasEmpty){
                $query->whereIn('worker_id', $workersIds);
                $query->when($hasEmpty, function ($query) {
                    return $query->orWhereNull('worker_id');
                });
            })
            ->where('start', '>=', $start)
            ->where('start', '>=', $start)
            ->where('stop', '<=', $stop)
            ->paginate(999999999999);


//        return $this->sendResponse($request->get('worker_ids'), 'All works returned');
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
                    'worker_id' => $item['worker_id'],
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

     /**
      * @param Work $work
      * @return JsonResponse
      * @throws Exception
      */
     public function destroy(Work $work)
     {
         $request = new Request(['start' => Carbon::parse($work->start)->format('Y-m-d H:i:s')]);
         $request->validate(['start' => 'required|date|after:' . date('Y-m-d H:i:s')]);

         $work->delete();
         return $this->sendResponse(null, 'Work deleted', 204);
     }
}

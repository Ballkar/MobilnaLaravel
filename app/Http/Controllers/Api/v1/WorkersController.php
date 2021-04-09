<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\ApiCommunication;
use App\Http\Requests\Calendar\WorkerMassUpdateRequest;
use App\Http\Requests\Calendar\WorkerRequest;
use App\Http\Resources\Calendar\WorkerCollection;
use App\Http\Resources\Calendar\WorkerResource;
use App\Models\Worker;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WorkersController extends Controller
{
    use ApiCommunication;

    public function __construct()
    {
        $this->authorizeResource(Worker::class, 'worker');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $limit = $request->limit ? $request->limit : 10;
        $workers = Worker::where('owner_id', '=', Auth::id())->paginate($limit);
        return $this->sendResponse(new WorkerCollection($workers), 'All workers returned');
    }

     /**
      * @param WorkerRequest $request
      * @param Worker $worker
      * @return JsonResponse
      */
     public function update(WorkerRequest $request, Worker $worker)
     {
         $worker->update($request->validated());
         return $this->sendResponse(new WorkerResource($worker), 'Worker updated');
     }

    public function massUpdate(WorkerMassUpdateRequest $request)
    {
        $workers = collect($request->get('workers'))
            ->each(function ($item) {
                $worker = Worker::find($item['id']);
                $this->authorize('update', $worker);
                $worker->update([
                    'name' => $item['name'],
                    'color' => $item['color'],
                ]);
            });
        return $this->sendResponse($workers, 'Worker updated');
    }

     /**
      * @param WorkerRequest $request
      * @return JsonResponse
      */
     public function store(WorkerRequest $request)
     {
         $worker = Worker::create(array_merge($request->validated(), [
             'owner_id' => Auth::id(),
         ]));
         return $this->sendResponse(new WorkerResource($worker), 'Worker Added', 201);
     }

     /**
      * @param Worker $worker
      * @return JsonResponse
      */
     public function show(Worker $worker)
     {
         return $this->sendResponse(new WorkerResource($worker), 'Worker returned');
     }

     /**
      * @param Worker $worker
      * @return JsonResponse
      * @throws Exception
      */
     public function destroy(Worker $worker)
     {
         $worker->delete();
         return $this->sendResponse(null, 'Worker deleted', 204);
     }
}

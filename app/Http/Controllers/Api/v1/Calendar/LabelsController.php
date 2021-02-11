<?php

namespace App\Http\Controllers\Api\v1\Calendar;

use App\Http\Controllers\ApiCommunication;
use App\Http\Requests\Calendar\LabelMassUpdateRequest;
use App\Http\Requests\Calendar\LabelRequest;
use App\Http\Resources\Calendar\LabelCollection;
use App\Http\Resources\Calendar\LabelResource;
use App\Models\Calendar\Label;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LabelsController extends Controller
{
    use ApiCommunication;

    public function __construct()
    {
        $this->authorizeResource(Label::class, 'label');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $limit = $request->limit ? $request->limit : 10;
        $labels = Label::paginate($limit);
        return $this->sendResponse(new LabelCollection($labels), 'All labels returned');
    }

     /**
      * @param LabelRequest $request
      * @param Label $label
      * @return JsonResponse
      */
     public function update(LabelRequest $request, Label $label)
     {
         $label->update($request->validated());
         return $this->sendResponse(new LabelResource($label), 'Label updated');
     }

    public function massUpdate(LabelMassUpdateRequest $request)
    {
        $labels = collect($request->get('labels'))
            ->each(function ($item) {
                $label = Label::find($item['id']);
                $this->authorize('update', $label);
                $label->update([
                    'name' => $item['name'],
                    'color' => $item['color'],
                ]);
            });
        return $this->sendResponse($labels, 'Labels updated');
    }

     /**
      * @param LabelRequest $request
      * @return JsonResponse
      */
     public function store(LabelRequest $request)
     {
         $label = Label::create(array_merge($request->validated(), [
             'owner_id' => Auth::id(),
         ]));
         return $this->sendResponse(new LabelResource($label), 'Label Added', 201);
     }

     /**
      * @param Label $label
      * @return JsonResponse
      */
     public function show(Label $label)
     {
         return $this->sendResponse(new LabelResource($label), 'Label returned');
     }

     /**
      * @param Label $label
      * @return JsonResponse
      * @throws Exception
      */
     public function destroy(Label $label)
     {
         $label->delete();
         return $this->sendResponse(null, 'Label deleted', 204);
     }
}

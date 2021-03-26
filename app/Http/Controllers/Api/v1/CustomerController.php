<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\ApiCommunication;
use App\Http\Requests\CustomerRequest;
use App\Http\Resources\Customer\Customer as CustomerResource;
use App\Http\Resources\Customer\CustomerCollection;
use App\Models\Announcement\Customer;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    use ApiCommunication;

    public function __construct()
    {
        $this->authorizeResource(Customer::class, 'customer');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $limit = $request->get('limit') ? $request->get('limit') : 10;
        $query = $request->get('query');
        if(isset($query)) {
            $customers = Customer::where('owner_id', Auth::id())
                ->where(function($q) use ($query) {
                    $q->whereRaw("CONCAT(name, ' ', surname, ' ', phone) like '%".$query."%'");
                    $q->whereRaw("CONCAT(name, ' ', phone, ' ', surname) like '%".$query."%'");
                    $q->orWhereRaw("CONCAT(surname, ' ', name, ' ', phone) like '%".$query."%'");
                    $q->orWhereRaw("CONCAT(surname, ' ', phone, ' ', name) like '%".$query."%'");
                    $q->orWhereRaw("CONCAT(phone, ' ', name, ' ', surname) like '%".$query."%'");
                    $q->orWhereRaw("CONCAT(phone, ' ', surname, ' ', name) like '%".$query."%'");
                })
            ->paginate($limit);
        } else {
            $customers = Customer::where('owner_id', Auth::id())->paginate($limit);
        }

        return $this->sendResponse(new CustomerCollection($customers), 'All customers returned');
    }

    /**
     * @param CustomerRequest $request
     * @return JsonResponse
     */
    public function store(CustomerRequest $request)
    {
        $name = trim($request->get('name'));
        $surname = trim($request->get('surname'));
        $customer = Customer::create(array_merge($request->validated(), [
            'owner_id' => Auth::id(),
            'name' => $name,
            'surname' => $surname,
        ]));
        return $this->sendResponse(new CustomerResource($customer), 'Customer Added', 201);
    }

    /**
     * @param Customer $customer
     * @return JsonResponse
     */
    public function show(Customer $customer)
    {
        return $this->sendResponse(new CustomerResource($customer), 'Customer returned');
    }

    /**
     * @param CustomerRequest $request
     * @param Customer $customer
     * @return JsonResponse
     */
    public function update(CustomerRequest $request, Customer $customer)
    {
        $name = trim($request->get('name'));
        $surname = trim($request->get('surname'));
        $customer->update(array_merge($request->validated(), [
            'name' => $name,
            'surname' => $surname,
        ]));
        return $this->sendResponse(new CustomerResource($customer), 'Customer updated');
    }

    /**
     * @param Customer $customer
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Customer $customer)
    {
        $works = collect($customer->works);
        $works->each(function ($work) {
            $startDate = Carbon::parse($work->start);
            $actualDate = Carbon::now();
            if($actualDate->lt($startDate)) {
                $work->delete();
            }
        });
        $customer->delete();
        return $this->sendResponse(null, 'Category deleted', 204);
    }
}

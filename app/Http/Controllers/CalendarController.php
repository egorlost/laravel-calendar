<?php

namespace App\Http\Controllers;

use App\Http\Resources\EventActivity\EventActivityCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Services\EventService;
use \App\Http\Requests\EventActivity;

class CalendarController extends Controller
{
    /**
     * @var EventService
     */
    protected $service;

    public function __construct(EventService $service)
    {
        $this->service = $service;
    }

    /**
     * @param EventActivity $request
     * @return JsonResponse
     */
    public function store(EventActivity $request): JsonResponse
    {
        $store = $this->service->store($request);

        return response()->json($store, 201);
    }

    /**
     * @param $id
     * @param EventActivity $request
     * @return JsonResponse
     */
    public function update($id, EventActivity $request): JsonResponse
    {
        $store = $this->service->update($id, $request);

        return response()->json($store);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $destroy = $this->service->destroy($id);

        return response()->json($destroy);
    }

    /**
     * @param Request $request
     * @return EventActivityCollection
     */
    public function data(Request $request): EventActivityCollection
    {
        $search = $request->input('search');

        return new EventActivityCollection($this->service->data($search));
    }
}

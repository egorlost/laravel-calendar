<?php

namespace App\Http\Controllers;

use App\Http\Resources\EventActivity\EventActivityCollection;
use Illuminate\Http\Request;
use App\Services\EventService;
use \App\Http\Requests\EventActivity;

class CalendarController extends Controller
{
    protected $service;

    public function __construct(EventService $service)
    {
        $this->service = $service;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('event.index');
    }

    public function store(EventActivity $request)
    {
        $store = $this->service->store($request);

        return response()->json($store, 201);
    }

    public function update($id, EventActivity $request)
    {
        $store = $this->service->update($id, $request);

        return response()->json($store);
    }

    public function destroy($id)
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

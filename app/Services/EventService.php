<?php

namespace App\Services;

use App\Models\EventActivity;
use App\Repositories\EventRepository;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EventService
{
    protected $repository;

    public function __construct(EventRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(Request $request)
    {
        $inputs = $request->only((new EventActivity())->getFillable());

        $reminderTime = $request->get('reminder_time');
        $reminderDate = $request->get('reminder_date');

        $reminderDelay = Carbon::parse($reminderDate .' '. $reminderTime)->diffInSeconds(Carbon::now());

        $model = $this->repository->store($inputs);

        $startDelay = Carbon::parse($model->start_date)->modify($model->start_time)->diffInSeconds(Carbon::now());

        auth()->user()->notify(new \App\Notifications\EventActivity($model, $reminderDelay));
        auth()->user()->notify(new \App\Notifications\EventActivity($model, $startDelay));

        return $model;
    }

    public function update($id, Request $request)
    {
        $inputs = $request->only((new EventActivity())->getFillable());

        return $this->repository->update($id, $inputs);
    }

    public function destroy($id)
    {
        return $this->repository->destroy($id);
    }

    public function data($search)
    {
        [$filterFrom, $filterTo] = $this->getFilterDates();

        return $this->repository->calendarPeriodActivities($filterFrom, $filterTo, $search);
    }

    private function getFilterDates(): array
    {
        $filterDate = Carbon::now();

        $filterFrom = $filterDate->startOfMonth()->format('Y-m-d');
        $filterTo = $filterDate->endOfMonth()->format('Y-m-d');

        return [$filterFrom, $filterTo];
    }
}

<?php

namespace App\Services;

use App\Models\EventActivity;
use App\Repositories\EventRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EventService
{
    protected $repository;

    public function __construct(EventRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed|string
     */
    public function store(Request $request)
    {
        $model = $this->repository->getModel();

        $inputs = $request->only((new $model)->getFillable());

        $reminderTime = $request->get('reminder_time');
        $reminderDate = $request->get('reminder_date');

        $reminderDelay = Carbon::parse($reminderDate . ' ' . $reminderTime)->diffInSeconds(Carbon::now());

        $model = $this->repository->store($inputs);

        $startDelay = Carbon::parse($model->start_date)->modify($model->start_time)->diffInSeconds(Carbon::now());

        $this->notify($model, $reminderDelay);
        $this->notify($model, $startDelay);

        return $model;
    }

    /**
     * @param $id
     * @param Request $request
     * @return mixed
     */
    public function update($id, Request $request)
    {
        $inputs = $request->only((new EventActivity())->getFillable());

        return $this->repository->update($id, $inputs);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        return $this->repository->destroy($id);
    }

    /**
     * @param string $search
     * @return Collection
     */
    public function data($search): Collection
    {
        [$filterFrom, $filterTo] = $this->getFilterDates();

        return $this->repository->calendarPeriodActivities($filterFrom, $filterTo, $search);
    }

    /**
     * @return array
     */
    private function getFilterDates(): array
    {
        $filterDate = Carbon::now();

        $filterFrom = $filterDate->startOfMonth()->format('Y-m-d');
        $filterTo = $filterDate->endOfMonth()->format('Y-m-d');

        return [$filterFrom, $filterTo];
    }

    /**
     * @param $model
     * @param int $delay
     */
    private function notify($model, int $delay): void
    {
        auth()->user()->notify(new \App\Notifications\EventActivity($model, $delay));
    }
}

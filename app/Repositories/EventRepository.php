<?php

namespace App\Repositories;

use App\Contracts\Repository;
use App\Models\EventActivity;

class EventRepository implements Repository
{
    protected $model = EventActivity::class;

    public function calendarPeriodActivities($from, $to, $search)
    {
        $query = EventActivity::whereBetween('start_date', [$from, $to]);

        if ($search) {
            $query->where('title', 'like', '%' . $search . '%');
        }

        return $query->get();
    }

    public function store(array $inputs)
    {
        $model = (new $this->model)->fill($inputs);

        $model->save();

        return $model;
    }

    public function update($id, array $inputs)
    {
        return $this->find($id)->fill($inputs)->save();
    }

    public function destroy($id)
    {
        return $this->find($id)->delete();
    }

    public function find($id)
    {
        return $this->model::findOrFail($id);
    }
}

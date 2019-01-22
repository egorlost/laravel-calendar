<?php

namespace App\Repositories;

use App\Contracts\Repository;
use App\Models\EventActivity;
use Illuminate\Database\Eloquent\Collection;

class EventRepository implements Repository
{
    /**
     * @var string
     */
    protected $model = EventActivity::class;

    /**
     * @param string $from
     * @param string $to
     * @param string|null $search
     * @return Collection
     */
    public function calendarPeriodActivities(string $from, string $to, $search): Collection
    {
        $query = $this->model::whereBetween('start_date', [$from, $to]);

        if ($search) {
            $query->where('title', 'like', '%' . $search . '%');
        }

        return $query->get();
    }

    /**
     * @param array $inputs
     * @return mixed
     */
    public function store(array $inputs)
    {
        return (new $this->model)->fill($inputs)->save();
    }

    /**
     * @param $id
     * @param array $inputs
     * @return mixed
     */
    public function update($id, array $inputs)
    {
        return $this->find($id)->fill($inputs)->save();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        return $this->find($id)->delete();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->model::findOrFail($id);
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return $this->model;
    }
}

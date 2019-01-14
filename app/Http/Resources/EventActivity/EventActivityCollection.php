<?php

namespace App\Http\Resources\EventActivity;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class EventActivityCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return Collection
     */
    public function toArray($request): Collection
    {
        return $this->collection;
    }
}

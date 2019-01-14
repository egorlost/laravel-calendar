<?php

namespace App\Http\Resources\EventActivity;

use Illuminate\Http\Resources\Json\JsonResource;

class EventActivity extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'start' => $this->start_date->format('Y-m-d') . ' ' . $this->start_time,
            'end' => $this->end_date->format('Y-m-d') . ' ' . $this->end_time,
            'start_time' => $this->start_time,
            'start_date' => $this->start_date,
            'end_time' => $this->end_time,
            'end_date' => $this->end_date,
            'title' => $this->title,
            'message' => $this->message,
            'created_at' => $this->created_at->diffForHumans()
        ];
    }
}

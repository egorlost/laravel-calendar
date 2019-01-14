<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventActivity extends Model
{
    protected $table = 'event_activities';

    protected $fillable = [
        'start_date', 'start_time', 'end_date', 'end_time', 'message', 'title'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'create_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}

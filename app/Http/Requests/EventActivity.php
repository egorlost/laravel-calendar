<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventActivity extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'start_date' => 'required|date|date_format:Y-m-d',
            'end_date' => 'required|date|date_format:Y-m-d|after:start_date',
            'reminder_date' => 'required|date|date_format:Y-m-d|before:start_date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'reminder_time' => 'required|date_format:H:i',
            'message' => 'required|string',
        ];
    }
}

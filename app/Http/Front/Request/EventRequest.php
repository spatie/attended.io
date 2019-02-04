<?php

namespace App\Http\Front\Request;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'location' => 'required',
            'website' => 'required',
            'starts_at' => 'required|date',
            'ends_at' => 'required|after:starts_at',
        ];
    }
}

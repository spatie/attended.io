<?php

namespace App\Http\Front\Requests;

use App\Domain\User\Rules\CountryCode;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'location' => 'required',
            'city' => '',
            'country_code' => [new CountryCode()],
            'website' => 'required',
            'starts_at' => 'required|date',
            'ends_at' => 'required|after:starts_at',
            'cfp' => 'boolean',
            'cfp_link' => 'nullable|url',
            'cfp_deadline' => 'nullable|date',
        ];
    }
}

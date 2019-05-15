<?php

namespace App\Http\Front\Requests;

use App\Domain\Shared\Rules\CountryCodeRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'location' => 'required',
            'city' => 'required',
            'country_code' => [new CountryCodeRule()],
            'website' => 'required',
            'starts_at' => 'required|date',
            'ends_at' => 'required|after:starts_at',
            'cfp' => 'boolean',
            'cfp_link' => 'nullable|url',
            'cfp_deadline' => 'nullable|date',
        ];
    }
}

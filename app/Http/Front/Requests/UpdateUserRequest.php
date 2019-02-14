<?php

namespace App\Http\Front\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => Rule::unique('users')->ignore(current_user()->id),
        ];
    }
}

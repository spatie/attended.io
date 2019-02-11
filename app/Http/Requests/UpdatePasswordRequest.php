<?php

namespace App\Http\Requests;

use App\Rules\CurrentPasswordRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
{
    public function rules()
    {
        return [
            'current_password' => ['required',new CurrentPasswordRule()],
            'new_password' => 'required|confirmed',
            'new_password_confirmation' => 'required',
        ];
    }
}

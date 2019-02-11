<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class CurrentPasswordRule implements Rule
{
    public function passes($attribute, $value)
    {
        if (! current_user()) {
            return false;
        }

        return Hash::check($value, current_user()->password);
    }

    public function message()
    {
        return 'This is not your current password.';
    }
}

<?php

namespace App\Domain\User\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Arr;
use League\ISO3166\ISO3166;

class CountryCode implements Rule
{
    public function passes($attribute, $value)
    {
        $this->attribute = $attribute;

        if (is_null($value)) {
            return true;
        }

        $countries = Arr::pluck((new ISO3166())->all(), ISO3166::KEY_ALPHA2);

        return in_array($value, $countries, true);
    }

    public function message()
    {
        return 'This is not a valid country code.';
    }
}

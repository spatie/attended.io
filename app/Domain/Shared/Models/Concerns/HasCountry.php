<?php

namespace App\Domain\Shared\Models\Concerns;

use Illuminate\Database\Eloquent\Model;
use League\ISO3166\ISO3166;
use Spatie\Emoji\Emoji;

trait HasCountry
{
    public static function bootHasCountry()
    {
        static::saving(function (Model $model) {
            $model->country_name = $model->countryName($model->country_code);
            $model->country_emoji = $model->country_code ? Emoji::countryFlag($model->country_code) : null;
        });
    }

    protected function countryName(?string $countryCode): ?string
    {
        if (is_null($countryCode)) {
            return null;
        }

        return (new ISO3166())->alpha2($countryCode)['name'] ?? null;
    }
}

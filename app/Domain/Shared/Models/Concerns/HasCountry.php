<?php

namespace App\Domain\Shared\Models\Concerns;

use Illuminate\Database\Eloquent\Model;
use League\ISO3166\ISO3166;

trait HasCountry
{
    public static function bootHasCountry()
    {
        static::saving(function (Model $model) {
            $model->country_name = $model->countryName($model->country_code);
            $model->country_emoji = $model->countryEmoji($model->country_code);
        });
    }

    protected function countryName(?string $countryCode): ?string
    {
        if (is_null($countryCode)) {
            return null;
        }

        return (new ISO3166())->alpha2($countryCode)['name'] ?? null;
    }

    protected function countryEmoji(?string $countryCode): ?string
    {
        if (is_null($countryCode)) {
            return null;
        }

        $countryCode = strtoupper($countryCode);

        return mb_convert_encoding('&#' . (127397 + ord($countryCode)) . ';', 'UTF-8', 'HTML-ENTITIES') . mb_convert_encoding('&#' . (127397 + ord($countryCode[1])) . ';', 'UTF-8', 'HTML-ENTITIES');
    }
}

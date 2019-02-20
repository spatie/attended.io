<?php

namespace App\Domain\User\Actions;

use App\Domain\User\Models\User;
use League\ISO3166\ISO3166;

class UpdateCountryAttributesAction
{
    public function execute(User $user): User
    {
        $user->country_name = $this->countryName($user->country_code);
        $user->country_emoji = $this->countryEmoji($user->country_code);

        $user->save();

        return $user;
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

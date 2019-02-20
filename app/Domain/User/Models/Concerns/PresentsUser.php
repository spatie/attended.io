<?php

namespace App\Domain\User\Models\Concerns;

trait PresentsUser
{
    public function joindInProfileUrl() :string
    {
        if (empty($this->joindin_username)) {
            return '';
        }

        return "https://joind.in/user/{$this->joindin_username}";
    }

    public function gravatarUrl()
    {
        $fallbackUrl = urlencode("https://ui-avatars.com/api/{$this->name}/512/f2f3f8/2c2e3e");

        $emailHash = md5(strtolower(trim($this->email)));

        return "https://gravatar.com/avatar/{$emailHash}?d={$fallbackUrl}";
    }
}

<?php

namespace App\Domain\User\Actions;

use App\Domain\User\Models\User;

class UpdateUserAction
{
    public function execute(User $user, array $attributes): User
    {
        $oldEmail = $user->email;

        $user->name = $attributes['name'];
        $user->email = $attributes['email'];
        $user->bio = $attributes['bio'] ?? null;
        $user->city = $attributes['city'] ?? null;
        $user->country = $attributes['country'] ?? null;
        $user->joindin_username = $attributes['joindin_username'] ?? null;

        activity()->log('User updated');

        $user->save();

        if ($user->email !== $oldEmail) {
            $user
                ->markEmailAsUnverified()
                ->sendEmailVerificationNotification();
        }

        return $user;
    }
}

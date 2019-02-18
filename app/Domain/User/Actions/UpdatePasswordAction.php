<?php

namespace App\Domain\User\Actions;

use App\Models\User;

class UpdatePasswordAction
{
    public function execute(User $user, string $password): User
    {
        $user->password = bcrypt($password);

        $user->save();

        activity()->log('Password updated');

        return $user;
    }
}

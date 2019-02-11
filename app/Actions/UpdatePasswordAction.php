<?php

namespace App\Actions;

use App\Models\User;

class UpdatePasswordAction
{
    public function execute(User $user, string $password): User
    {
        $user->password = bcrypt($password);

        $user->save();

        return $user;
    }
}

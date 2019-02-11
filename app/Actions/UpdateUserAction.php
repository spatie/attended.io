<?php

namespace App\Actions;

use App\Models\User;

class UpdateUserAction
{
    public function execute(User $user, array $attributes): User
    {
        $user->name = $attributes['name'];
        $user->email = $attributes['email'];

        $user->save();

        return $user;
    }
}

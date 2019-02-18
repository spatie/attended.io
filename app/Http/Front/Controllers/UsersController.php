<?php

namespace App\Http\Front\Controllers;

use App\Domain\User\Models\User;

class UsersController
{
    public function show(User $user)
    {
        return view('front.users.show', compact('user'));
    }
}

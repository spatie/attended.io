<?php

namespace App\Http\Front\Controllers;

use App\Models\User;

class UsersController
{
    public function show(User $user)
    {
        return view('front.users.show', compact('user'));
    }
}
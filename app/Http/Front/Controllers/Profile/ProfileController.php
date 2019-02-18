<?php

namespace App\Http\Front\Controllers\Profile;

use App\Actions\UpdateUserAction;
use App\Http\Front\Requests\UpdateUserRequest;

class ProfileController
{
    public function show()
    {
        $user = auth()->user();

        return view('front.profile.show', compact('user'));
    }

    public function update(UpdateUserRequest $request, UpdateUserAction $updateUserAction)
    {
        $user = auth()->user();

        $updateUserAction->execute($user, $request->validated());

        flash()->message('Your profile has been updated!');

        return back();
    }
}

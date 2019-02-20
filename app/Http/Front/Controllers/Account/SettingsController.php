<?php

namespace App\Http\Front\Controllers\Account;

use App\Domain\User\Actions\UpdateUserAction;
use App\Http\Front\Requests\UpdateUserRequest;

class SettingsController
{
    public function edit()
    {
        return view('front.account.profile', ['user' => auth()->user()]);
    }

    public function update(UpdateUserRequest $request, UpdateUserAction $updateUserAction)
    {
        $updateUserAction->execute(auth()->user(), $request->validated());

        flash()->message('Your profile has been updated!');

        return back();
    }
}

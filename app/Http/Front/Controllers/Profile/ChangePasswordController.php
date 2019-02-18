<?php

namespace App\Http\Front\Controllers\Profile;

use App\Actions\UpdatePasswordAction;
use App\Http\Front\Requests\UpdatePasswordRequest;

class ChangePasswordController
{
    public function show()
    {
        return view('front.profile.password');
    }

    public function update(UpdatePasswordRequest $request, UpdatePasswordAction $updatePasswordAction)
    {
        $user = auth()->user();

        $updatePasswordAction->execute($user, $request->new_password);

        flash()->message('Your password has been updated!');

        return back();
    }
}

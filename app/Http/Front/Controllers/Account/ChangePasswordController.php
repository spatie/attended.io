<?php

namespace App\Http\Front\Controllers\Account;

use App\Domain\User\Actions\UpdatePasswordAction;
use App\Http\Front\Requests\UpdatePasswordRequest;

class ChangePasswordController
{
    public function edit()
    {
        return view('front.account.password');
    }

    public function update(UpdatePasswordRequest $request, UpdatePasswordAction $updatePasswordAction)
    {
        $user = auth()->user();

        $updatePasswordAction->execute($user, $request->new_password);

        flash()->message('Your password has been updated!');

        return back();
    }
}

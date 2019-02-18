<?php

namespace App\Http\Front\Controllers\Auth;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class VerificationController
{
    use ValidatesRequests;

    protected $redirectTo = '/';

    public function verify(Request $request)
    {
        if ($request->route('id') != $request->user()->getKey()) {
            throw new AuthorizationException;
        }

        if ($request->user()->hasVerifiedEmail()) {
            flash()->warning('Your email was already verified');
            return redirect('/');
        }

        $request->user()->markEmailAsVerified();

        flash()->success('Your email has been verified');

        return redirect('/');
    }

    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            flash()->warning('Your email was already verified');

            return redirect('/');
        }

        $request->user()->sendEmailVerificationNotification();

        flash()->success('We have sent you a mail to verify your e-mailaddress');

        return back()->with('resent', true);
    }
}

<?php

namespace App\Http\Front\Controllers\Auth;

use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Foundation\Validation\ValidatesRequests;

class ForgotPasswordController
{
    use SendsPasswordResetEmails, ValidatesRequests;
}

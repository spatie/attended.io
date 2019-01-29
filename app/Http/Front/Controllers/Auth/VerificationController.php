<?php

namespace App\Http\Front\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Foundation\Validation\ValidatesRequests;

class VerificationController
{
    use VerifiesEmails, ValidatesRequests;

    protected $redirectTo = '/';
}

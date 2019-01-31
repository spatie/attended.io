<?php

namespace App\Http\Front\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Validation\ValidatesRequests;

class LoginController
{
    use AuthenticatesUsers, ValidatesRequests;

    protected $redirectTo = '/';
}

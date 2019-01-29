<?php

namespace App\Http\Front\Controllers;

class HomeController
{
    public function index()
    {
        return view('front.home.index');
    }

}
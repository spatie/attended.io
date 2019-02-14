<?php

namespace App\Http\Front\Controllers;

class SearchController
{
    public function __invoke()
    {
        return view('front.search');
    }

}
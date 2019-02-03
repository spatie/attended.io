<?php

use App\Models\User;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Support\Facades\Auth;

function faker(): Generator
{
    return Factory::create();
}

function current_user(): ?User
{
    return Auth::user();
}

<?php

use App\Models\User;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

function faker(): Generator
{
    return Factory::create();
}

function current_user(): ?User
{
    return Auth::user();
}

function ok(): Response
{
    return response('', SymfonyResponse::HTTP_NO_CONTENT);
}

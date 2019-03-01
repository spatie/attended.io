<?php

use App\Domain\User\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'bio' => $faker->boolean() ? $faker->sentence : null,
        'city' => $faker->boolean() ?$faker->city : null,
        'country_code' => $faker->boolean() ? $faker->countryCode : null,
        'joindin_username' => $faker->boolean() ? $faker->userName : null,
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => Str::random(10),
        'admin' => false,
        'email_verified_at' => $faker->dateTime(),
        'can_publish_events_immediately' => false,
    ];
});

$factory->state(User::class, 'unverified-email', [
    'email_verified_at' => null,
]);

$factory->state(User::class, 'admin', [
    'admin' => true,
]);

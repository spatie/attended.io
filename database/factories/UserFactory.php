<?php

use App\Domain\User\Models\User;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'bio' => $faker->boolean() ? $faker->paragraph : null,
        'city' => $faker->boolean() ?$faker->city : null,
        'country' => $faker->boolean() ? $faker->countryCode : null,
        'joindin_username' => $faker->boolean() ? $faker->userName : null,
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
        'admin' => false,
        'email_verified_at' => $faker->dateTime(),
        'can_create_events_immediately' => $faker->boolean(20),
    ];
});

$factory->state(User::class, 'unverified-email', [
    'email_verified_at' => null,
]);

$factory->state(User::class, 'admin', [
    'admin' => true,
]);

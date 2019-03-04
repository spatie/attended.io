<?php

use App\Domain\Slot\Models\Slot;
use App\Domain\Slot\Models\Speaker;
use App\Domain\User\Models\User;
use Faker\Generator as Faker;

$factory->define(Speaker::class, function (Faker $faker) {
    return [
        'slot_id' => factory(Slot::class),
        'user_id' => $faker->boolean ? factory(User::class) : null,
        'name' => $faker->name,
        'email' => $faker->email,
    ];
});

$factory->state(Speaker::class, 'withoutUserAccount', [
    'user_id' => null,
]);

$factory->state(Speaker::class, 'withUserAccount', [
    'user_id' => function () {
        return factory(User::class)->create()->id;
    },
]);

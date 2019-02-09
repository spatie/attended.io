<?php

use App\Models\Slot;
use App\Models\SlotOwnershipClaim;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(SlotOwnershipClaim::class, function (Faker $faker) {
    return [
        'slot_id' => factory(Slot::class),
        'user_id' => factory(User::class),
    ];
});

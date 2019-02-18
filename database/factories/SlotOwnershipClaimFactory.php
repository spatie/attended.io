<?php

use App\Domain\Slot\Models\Slot;
use App\Domain\Slot\Models\SlotOwnershipClaim;
use App\Domain\User\Models\User;
use Faker\Generator as Faker;

$factory->define(SlotOwnershipClaim::class, function (Faker $faker) {
    return [
        'slot_id' => factory(Slot::class),
        'user_id' => factory(User::class),
    ];
});

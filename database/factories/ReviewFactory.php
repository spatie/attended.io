<?php

use App\Domain\Event\Models\Event;
use App\Domain\Review\Models\Review;
use App\Models\Slot;
use App\Domain\User\Models\User;
use Faker\Generator as Faker;

$factory->define(Review::class, function (Faker $faker) {
    $reviewableClass = $faker->randomElement([
        Event::class,
        Slot::class,
    ]);

    return [
        'reviewable_id' => factory($reviewableClass),
        'reviewable_type' => $reviewableClass,
        'rating' => $faker->numberBetween(1, 6),
        'remarks' => $faker->paragraphs(3, true),
        'user_id' => factory(User::class),
    ];
});

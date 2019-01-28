<?php

use App\Models\Enums\SlotType;
use App\Models\Event;
use App\Models\Slot;
use Faker\Generator as Faker;

$factory->define(Slot::class, function (Faker $faker) {
    $startsAt = $faker->dateTimeBetween('-2 years', '+1 year');
    $amountOfMinutes = $faker->randomElement([15,30, 60, 90, 120, 360]);
    $endsAt = (clone $startsAt)->add(new DateInterval("P{$amountOfMinutes}M"));

    return [
        'name' => $faker->name,
        'description' => $faker->paragraphs(3, true),
        'location' => $faker->word,
        'event_id' => factory(Event::class),
        'type' => $faker->randomElement(SlotType::values()),
        'starts_at' => $startsAt,
        'ends_at' => $endsAt,
    ];
});

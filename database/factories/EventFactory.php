<?php

use App\Models\Event;
use Faker\Generator as Faker;

$factory->define(Event::class, function (Faker $faker) {
    $startsAt = $faker->dateTimeBetween('-2 years', '+1 year');
    $amountOfDays = $faker->numberBetween(1, 3);
    $endsAt = (clone $startsAt)->add(new DateInterval("P{$amountOfDays}D"));

    return [
        'name' => $faker->word . 'Conf',
        'description' => $faker->paragraphs(3, true),
        'location'=> $faker->word,
        'city' => $faker->city,
        'country' => $faker->country,
        'website' => $faker->url,
        'starts_at' => $startsAt,
        'ends_at' => $endsAt,
    ];
});

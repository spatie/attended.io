<?php

use App\Models\Event;
use App\Models\Track;
use Faker\Generator as Faker;

$factory->define(Track::class, function (Faker $faker) {
    return [
        'event_id' => factory(Event::class),
        'name' => $faker->word,
    ];
});

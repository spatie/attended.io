<?php

use App\Domain\Event\Models\Event;
use App\Domain\Event\Models\Track;
use Faker\Generator as Faker;

$factory->define(Track::class, function (Faker $faker) {
    return [
        'event_id' => factory(Event::class),
        'name' => $faker->word,
    ];
});

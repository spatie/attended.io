<?php

use App\Models\Comment;
use App\Models\Event;
use App\Models\Slot;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    $commentableClass = $faker->randomElement([
        Event::class,
        Slot::class,
    ]);

    return [
        'commentable_id' => factory($commentableClass),
        'commentable_type' => $commentableClass,
        'rating' => $faker->numberBetween(1, 6),
        'comment' => $faker->paragraphs(3, true),
        'user_id' => factory(User::class),
    ];
});

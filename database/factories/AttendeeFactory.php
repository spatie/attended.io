<?php

use App\Domain\Event\Models\Attendee;
use App\Domain\Event\Models\Event;
use App\Domain\User\Models\User;

$factory->define(Attendee::class, function () {
    return [
        'user_id' => factory(User::class),
        'event_id' => factory(Event::class),
    ];
});

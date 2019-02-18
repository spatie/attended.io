<?php

use App\Domain\Event\Models\Attendance;
use App\Domain\Event\Models\Event;
use App\Domain\User\Models\User;

$factory->define(Attendance::class, function () {
    return [
        'user_id' => factory(User::class),
        'event_id' => factory(Event::class),
    ];
});

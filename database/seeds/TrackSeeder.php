<?php

use App\Domain\Event\Models\Event;
use App\Models\Track;
use Illuminate\Database\Seeder;

class TrackSeeder extends Seeder
{
    public function run()
    {
        Event::get()->each(function (Event $event) {
            factory(Track::class, rand(1, 5))->create([
                'event_id' => $event->id,
            ]);
        });
    }
}

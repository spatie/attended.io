<?php

use App\Domain\Event\Models\Event;
use App\Domain\User\Models\User;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run()
    {
        factory(Event::class, 30)->create()->each(function (Event $event) {
            $users = User::inRandomOrder()->limit(rand(1, 3))->get();

            $event->owners()->sync($users->pluck('id')->toArray());
        });
    }
}

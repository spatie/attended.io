<?php

use App\Models\Attendance;
use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    public function run()
    {
        $userCount = User::count();

        Event::get()->each(function (Event $event) use ($userCount) {
            $amountOfUsers = rand(1, $userCount);

            User::inRandomOrder()->limit($amountOfUsers)->each(function (User $user) use ($event) {
                factory(Attendance::class)->create([
                    'event_id' => $event->id,
                    'user_id' => $user->id,
                ]);
            });
        });
    }
}

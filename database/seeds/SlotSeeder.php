<?php

use App\Models\Event;
use App\Models\Slot;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class SlotSeeder extends Seeder
{
    public function run()
    {
        Event::get()->each(function (Event $event) {
            $randomScheduleTimes = $this->generateRandomSlotTimes($event);

            $trackNames = Collection::times(rand(1, 3))->map(function () {
                return faker()->word;
            });

            foreach ($trackNames as $trackName) {
                $randomScheduleTimes->each(function ($slotTime) use ($event, $trackName) {
                    factory(Slot::class)->create([
                        'event_id' => $event->id,
                        'track' => $trackName,
                        'starts_at' => $slotTime['startsAt'],
                        'ends_at' => $slotTime['endsAt'],
                        'user_id' => faker()->boolean(50) ? User::inRandomOrder()->first() : null,
                    ]);
                });
            }
        });
    }

    protected function generateRandomSlotTimes(Event $event): Collection
    {
        $slotTimes = collect();

        $startsAt = $event->starts_at;

        while (true) {
            $endsAt = $startsAt->copy()->addMinutes(faker()->randomElement([15,30, 60, 90, 120, 360]));

            if ($endsAt->greaterThan($event->ends_at)) {
                return $slotTimes;
            }

            $slotTimes->push(compact('startsAt', 'endsAt'));

            $startsAt = $endsAt;
        }
    }
}

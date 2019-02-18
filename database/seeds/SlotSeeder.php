<?php

use App\Domain\Event\Models\Event;
use App\Models\Slot;
use App\Models\Track;
use App\Domain\User\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class SlotSeeder extends Seeder
{
    public function run()
    {
        Event::get()->each(function (Event $event) {
            $slotTimes = $this->generateRandomSlotTimes($event);

            $event->tracks->each(function (Track $track) use ($slotTimes) {
                $slotTimes->each(function ($slotTime) use ($track) {
                    factory(Slot::class)->create([
                        'track_id' => faker()->boolean(90) ? $track->id : null,
                        'event_id' => $track->event->id,
                        'starts_at' => $slotTime['startsAt'],
                        'ends_at' => $slotTime['endsAt'],
                    ]);
                });
            });
        });

        Slot::all()->each(function (Slot $slot) {
            $users = User::inRandomOrder()->limit(rand(1, 2))->get();

            if (faker()->boolean(90)) {
                $users->each(function (User $user) use ($slot) {
                    $this->addRelation($user, $slot);

                    faker()->boolean(90)
                        ? $slot->owners()->attach($user)
                        : $slot->claimingUsers()->attach($user);
                });
            }
        });
    }

    protected function addRelation(User $user, Slot $slot)
    {
        if (faker()->boolean(90)) {
            $slot->owners()->attach($user);

            return;
        }

        if (faker()->boolean(50)) {
            $slot->claimingUsers()->attach($user);

            return;
        }

        $slot->invitedToBeOwners()->attach($user);
    }

    protected function generateRandomSlotTimes(Event $event): Collection
    {
        $slotTimes = collect();

        $startsAt = $event->starts_at;

        while (true) {
            $endsAt = $startsAt->copy()->addMinutes(faker()->randomElement([15, 30, 60, 90, 120, 360]));

            if ($endsAt->greaterThan($event->ends_at)) {
                return $slotTimes;
            }

            $slotTimes->push(compact('startsAt', 'endsAt'));

            $startsAt = $endsAt;
        }
    }
}

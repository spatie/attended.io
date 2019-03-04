<?php

namespace App\Domain\Slot\Actions;

use App\Domain\Event\Exceptions\CouldNotUpdateSpeaker;
use App\Domain\Slot\Models\Slot;
use App\Domain\Slot\Models\Speaker;
use Illuminate\Database\Eloquent\Builder;

class UpdateSpeakersAction
{
    public function execute(Slot $slot, array $speakerProperties)
    {
        $this
            ->deleteAllSpeakersNotPresent($slot, $speakerProperties)
            ->addNewSpeakers($slot, $speakerProperties)
            ->updateExistingSpeakers($slot, $speakerProperties);
    }

    protected function deleteAllSpeakersNotPresent(Slot $slot, array $speakerProperties)
    {
        $remainingSpeakerIds = collect($speakerProperties)->pluck('id')->filter()->toArray();
        $remainingSpeakerEmails = collect($speakerProperties)->pluck('email')->filter()->toArray();

        $slot->speakers
            ->reject(function (Speaker $speaker) use ($remainingSpeakerIds) {
                return in_array($speaker->id, $remainingSpeakerIds);
            })
            ->reject(function (Speaker $speaker) use ($remainingSpeakerEmails) {
                if (! $speaker->user) {
                    return false;
                }

                return in_array($speaker->user->email, $remainingSpeakerEmails);
            })
            ->each(function (Speaker $speaker) use ($slot, $speakerProperties) {
                $speaker->delete();

                activity()
                    ->performedOn($speaker)
                    ->log("Speaker `{$speaker->name}` removed from slot `{$slot->name}`.");
            });

        return $this;
    }

    protected function addNewSpeakers(Slot $slot, array $speakerProperties)
    {
        collect($speakerProperties)
            ->filter(function (array $speakerProperties) {
                return empty($speakerProperties['id']);
            })
            ->reject(function (array $speakerProperties) use ($slot) {
                $exists = $slot->speakers()
                    ->whereHas('user', function (Builder $query) use ($speakerProperties) {
                        return $query->where('email', $speakerProperties['email']);
                    })
                    ->exists();

                return $exists;
            })
            ->each(function (array $newSpeakerProperties, int $index) use ($slot) {
                Speaker::create([
                    'name' => $newSpeakerProperties['name'],
                    'email' => $newSpeakerProperties['email'] ?? null,
                    'slot_id' => $slot->id,
                ]);

                activity()
                    ->performedOn($slot)
                    ->log("Speaker `{$newSpeakerProperties['name']}` added to slot `{$slot}`.");
            });
        
        return $this;
    }

    protected function updateExistingSpeakers(Slot $slot, array $speakerProperties)
    {
        collect($speakerProperties)
            ->filter(function (array $speakerProperties) {
                return !empty($speakerProperties['id']);
            })
            ->each(function (array $speakerProperties, int $index) use ($slot) {
                $speaker = Speaker::find($speakerProperties['id']);

                if (!$speaker) {
                    throw CouldNotUpdateSpeaker::speakerDoesNotExist($speakerProperties['id']);
                }

                if ($speaker->slot->id !== $slot->id) {
                    throw CouldNotUpdateSpeaker::speakerDoesNotBelongToSlot(
                        $speaker,
                        $slot,
                        );
                }

                $speaker->name = $speakerProperties['name'];
                $speaker->email = $speakerProperties['email'];

                $speaker->save();

                activity()
                    ->performedOn($speaker)
                    ->log("Speaker `{$speaker->name}` has been updated.");
            });

        return $this;
    }
}

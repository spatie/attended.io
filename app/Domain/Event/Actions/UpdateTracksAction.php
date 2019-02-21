<?php

namespace App\Domain\Event\Actions;

use App\Domain\Event\Exceptions\CouldNotDeleteTrack;
use App\Domain\Event\Exceptions\CouldNotUpdateTrack;
use App\Domain\Event\Models\Event;
use App\Domain\Event\Models\Track;

class UpdateTracksAction
{
    public function execute(Event $event, array $trackProperties)
    {
        $this
            ->deleteAllTracksNotPresent($event, $trackProperties)
            ->createNewTracks($event, $trackProperties)
            ->updateExistingTracks($event, $trackProperties);
    }

    public function deleteAllTracksNotPresent(Event $event, array $trackProperties)
    {
        $remainingTrackIds = collect($trackProperties)->pluck('id')->filter()->toArray();

        $event->tracks
            ->reject(function (Track $track) use ($remainingTrackIds) {
                return in_array($track->id, $remainingTrackIds);
            })
            ->each(function (Track $track) use ($event) {
                if ($track->slots()->count()) {
                    throw CouldNotDeleteTrack::trackHasSlots($track);
                }

                $track->delete();

                activity()
                    ->performedOn($event)
                    ->log("Track `{$track->name}` deleted.");
            });

        return $this;
    }

    protected function createNewTracks(Event $event, array $trackProperties)
    {
        collect($trackProperties)
            ->filter(function (array $trackProperties) {
                return empty($trackProperties['id']);
            })
            ->each(function (array $newTrackProperties, int $index) use ($event) {
                Track::create([
                    'name' => $newTrackProperties['name'],
                    'event_id' => $event->id,
                    'order_column' => $index,
                ]);

                activity()
                    ->performedOn($event)
                    ->log("Track `{$newTrackProperties['name']}` created.");
            });

        return $this;
    }

    public function updateExistingTracks(Event $event, array $trackProperties)
    {
        collect($trackProperties)
            ->filter(function (array $trackProperties) {
                return !empty($trackProperties['id']);
            })
            ->each(function (array $newTrackProperties, int $index) use ($event) {
                $track = Track::find($newTrackProperties['id']);

                if (!$track) {
                    throw CouldNotUpdateTrack::trackDoesNotExist($newTrackProperties['id']);
                }

                if ($track->event->id !== $event->id) {
                    throw CouldNotUpdateTrack::trackDoesNotBelongToEvent(
                        $newTrackProperties['id'],
                        $event,
                        );
                }

                $oldName = $track->name;

                $track->name = $newTrackProperties['name'];
                $track->order_column = $index;
                $track->save();

                activity()
                    ->performedOn($track)
                    ->log("Track `{$oldName}` renamed to `{$newTrackProperties['name']}`.");
            });

        return $this;
    }


}

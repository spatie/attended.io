<?php

namespace App\Http\Front\Controllers\EventAdmin;

use App\Domain\Event\Actions\UpdateTracksAction;
use App\Domain\Event\Models\Event;
use App\Domain\Event\Models\Track;
use App\Http\Front\Requests\UpdateTracksRequest;

class TracksController
{
    public function edit(Event $event)
    {
        $tracks = $event
            ->tracks()
            ->orderBy('order_column')
            ->get()
            ->map(function (Track $track) {
                return ['id' => $track->id, 'name' => $track->name, 'slotCount' => $track->slots()->count()];
            })
            ->toArray();

        return view('front.event-admin.tracks.index', compact('event', 'tracks'));
    }

    public function update(Event $event, UpdateTracksRequest $request)
    {
        (new UpdateTracksAction())->execute($event, $request->tracks);

        flash()->message('The tracks have been updated.');

        return back();
    }
}

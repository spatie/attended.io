<?php

namespace App\Http\Front\Controllers\EventAdmin;

use App\Domain\Event\Actions\CreateEventAction;
use App\Domain\Event\Actions\UpdateEventAction;
use App\Domain\Event\Models\Event;
use App\Http\Front\Requests\UpdateEventRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EventsController
{
    use AuthorizesRequests;

    public function index()
    {
        $events = Event::query()
            ->organizedBy(auth()->user())
            ->orderBy('starts_at', 'desc')
            ->paginate();

        return view('front.event-admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('front.event-admin.events.create');
    }

    public function store(UpdateEventRequest $request, CreateEventAction $createEventAction)
    {
        $event = $createEventAction->execute($request);

        flash()->message('The event has been created!');

        return redirect()->route('event-admin.events.edit', $event);
    }

    public function edit(Event $event)
    {
        $this->authorize('administer', $event);

        return view('front.event-admin.events.edit', compact('event'));
    }

    public function update(Event $event, UpdateEventRequest $request, UpdateEventAction $createEventAction)
    {
        $event = $createEventAction->execute($event, $request);

        flash()->message('The event has been saved!');

        return redirect()->route('event-admin.events.edit', $event);
    }
}

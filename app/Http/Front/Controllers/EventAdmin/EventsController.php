<?php

namespace App\Http\Front\Controllers\EventAdmin;

use App\Domain\Event\Actions\CreateEventAction;
use App\Domain\Event\Actions\DeleteEventAction;
use App\Domain\Event\Actions\UpdateEventAction;
use App\Domain\Event\Models\Event;
use App\Http\Front\Requests\UpdateEventRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EventsController
{
    use AuthorizesRequests;

    public function index()
    {
        $query = auth()->user()->admin
            ? Event::all()
            : Event::organizedBy(auth()->user());

        $events = $query
            ->orderBy('starts_at', 'desc')
            ->paginate();

        return view('front.event-admin.events.index', compact('events'));
    }

    public function create()
    {
        $event = new Event();

        return view('front.event-admin.events.create', compact('event'));
    }

    public function store(UpdateEventRequest $request, CreateEventAction $createEventAction)
    {
        $event = $createEventAction->execute(auth()->user(), $request->validated());

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
        $event = $createEventAction->execute($event, $request->validated());

        flash()->message('The event has been saved!');

        return redirect()->route('event-admin.events.edit', $event);
    }

    public function destroy(Event $event)
    {
        $this->authorize('administer', $event);

        (new DeleteEventAction())->execute($event);

        flash()->success('The event has been deleted.');

        return back();
    }
}

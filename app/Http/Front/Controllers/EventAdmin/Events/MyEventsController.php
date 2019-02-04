<?php

namespace App\Http\Front\Controllers\EventAdmin\Events;

use App\Actions\CreateEventAction;
use App\Http\Front\Request\EventRequest;
use App\Models\Event;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MyEventsController
{
    use AuthorizesRequests;

    public function index()
    {
        $events = current_user()->events()->paginate();

        return view('front.event-admin.events.index', compact('events'));
    }

    public function edit(Event $event)
    {
        $this->authorize('administer', $event);

        return view('front.event-admin.events.edit', compact('event'));
    }

    public function create()
    {
        return view('front.event-admin.events.create');
    }

    public function store(EventRequest $request, CreateEventAction $createEventAction)
    {
        $event = $createEventAction->execute($request);

        return redirect()->route('events.show', $event);
    }
}

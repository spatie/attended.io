<?php

namespace App\Http\Front\Controllers\EventAdmin;

use App\Domain\Event\Models\Event;
use App\Domain\Slot\Actions\CreateSlotAction;
use App\Domain\Slot\Actions\DeleteSlotAction;
use App\Domain\Slot\Actions\UpdateSlotAction;
use App\Domain\Slot\Models\Slot;
use App\Http\Front\Requests\CreateSlotRequest;
use App\Http\Front\Requests\UpdateSlotRequest;
use App\Http\Front\ViewModels\SlotsViewModel;

class SlotsController
{
    public function index(Event $event)
    {
        return view('front.event-admin.slots.index', compact('event'));
    }

    public function create(Event $event)
    {
        $slotsViewModel = new SlotsViewModel($event, new Slot());

        return view('front.event-admin.slots.create', $slotsViewModel);
    }

    public function store(Event $event, CreateSlotRequest $request)
    {
        (new CreateSlotAction())->execute($event, $request->validated());

        flash()->success('The slot has been created');

        return back();
    }

    public function edit(Event $event, Slot $slot)
    {
        $slotsViewModel = new SlotsViewModel($event, $slot);

        return view('front.event-admin.slots.edit', $slotsViewModel);
    }

    public function update(Event $event, Slot $slot, UpdateSlotRequest $request)
    {
        (new UpdateSlotAction())->execute($slot, $request->validated());

        flash()->success('The slot has been updated');

        return back();
    }

    public function destroy(Event $event, Slot $slot)
    {
        $this->authorize('administer', $slot);

        (new DeleteSlotAction())->execute($slot);

        flash()->success('The slot has been deleted');

        return back();
    }
}

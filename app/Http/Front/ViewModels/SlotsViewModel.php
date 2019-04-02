<?php

namespace App\Http\Front\ViewModels;

use App\Domain\Event\Models\Event;
use App\Domain\Event\Models\Track;
use App\Domain\Slot\Enums\SlotType;
use App\Domain\Slot\Models\Slot;
use App\Domain\Slot\Models\Speaker;
use Spatie\ViewModels\ViewModel;

class SlotsViewModel extends ViewModel
{
    /** @var \App\Domain\Event\Models\Event */
    public $event;

    /** @var \App\Domain\Slot\Models\Slot */
    public $slot;

    public function __construct(Event $event, Slot $slot)
    {
        $this->event = $event;

        $this->slot = $slot;
    }

    public function tracks(): array
    {
        return $this->event
            ->tracks()
            ->orderBy('order_column')
            ->get()
            ->mapWithKeys(function (Track $track) {
                return [$track->id => $track->name];
            })
            ->toArray();
    }

    public function speakers(): array
    {
        return $this->slot
            ->speakers
            ->map(function (Speaker $speaker) {
                return [
                     'id' => $speaker->id,
                     'name' => $speaker->name(),
                     'email' => $speaker->email(),
                     'editable' => ! $speaker->hasUserAccount(),
                 ];
            })
            ->toArray();
    }

    public function slotTypes(): array
    {
        return SlotType::toArray();
    }
}

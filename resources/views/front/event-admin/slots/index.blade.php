@extends('front.layouts.main')

@section('content')
    {{ Menu::eventAdmin($event) }}

    <a href="{{ route('event-admin.slots.create', $event) }}">Create new slot</a>

    <h1>Slots for {{ $event->name }}</h1>

    <a href="{{ route('event-admin.slots.create', $event->id) }}" class="underline">Add new slot</a>

    @foreach($slotsGroupedByDay as $day => $slots)
        <h2>{{ $day }}</h2>

        <table>
            <thead>
            <tr>
            @if($event->tracks->count() > 1)
                <th>Track</th>
            @endif
            <th>Start</th>
            <th>End</th>
            <th>Name</th>
            <th>Speakers</th>
            <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($slots as $slot)
                <tr>
                    <td>{{ optional($slot->track)->name }}</td>
                    <td>{{ $slot->starts_at->format('H:i') }}</td>
                    <td>{{ $slot->ends_at->format('H:i') }}</td>
                    <td><a href="{{ route('event-admin.slots.edit', [$event, $slot]) }}">{{ $slot->name }}</a></td>
                    <td>{{ $slot->speakersAsString() }}</td>
                    <td>
                        <delete-button :action="route('event-admin.slots.delete', [$event, $slot])"/>
                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>
    @endforeach

@endsection

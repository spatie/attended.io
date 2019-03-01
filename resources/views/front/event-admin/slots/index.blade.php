@extends('front.layouts.main')

@section('content')
    {{ Menu::eventAdmin($event) }}

    <a href="{{ route('event-admin.slots.create', $event) }}">Create new slot</a>

    <h1>Slots for {{ $event->name }}</h1>

    <a href="{{ route('event-admin.slots.create', $event->id) }}" class="underline">Add new slot</a>

    @foreach($slotsGroupedByDay as $day => $slots)
        <h2>{{ $day }}</h2>

        <table>
            <th>
            @if($event->tracks->count() > 1)
                <td>Track</td>
            @endif
            <td>Start</td>
            <td>End</td>
            <td>Name</td>
            <td>Speakers</td>
            <td></td>
            </th>

            @foreach($slots as $slot)
                <tr>
                    @if($event->tracks->count() > 1)
                        <td>{{ $slot->track->name }}</td>
                    @endif
                    <td>{{ $slot->starts_at->format('H:i') }}</td>
                    <td>{{ $slot->ends_at->format('H:i') }}</td>
                    <td>{{ $slot->name }}</td>
                    <td>{{ $slot->speakersAsString() }}</td>
                    <td>actions</td>
                </tr>
            @endforeach

        </table>
    @endforeach

@endsection

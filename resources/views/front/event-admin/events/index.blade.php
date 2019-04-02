@extends('front.layouts.main')

@section('content')
    <h1>Organizing</h1>

    <a href="{{ route('event-admin.events.create') }}">Host new event</a>

    @if($events->isNotEmpty())
        {{ $events->links() }}

        <div class="flex -m-4">
            @foreach($events as $event)
                <a href="{{ route('event-admin.events.edit', $event->idSlug()) }}" class="block bg-blue-lightest m-4">
                    <div class="p-3">
                        <h2 class="font-bold">{{ $event->name }}</h2>
                        {{ $event->timespan() }}<br>
                        {{ $event->location }}
                    </div>
                </>
            @endforeach
        </div>
        {{ $events->links() }}
    @endif
@endsection

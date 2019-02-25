@extends('front.layouts.main')

@section('content')
    {{ Menu::eventAdmin($event) }}

    <h1>Tracks for {{ $event->name }}</h1>

    <form action="{{ route('event-admin.tracks.update', $event) }}" method="POST">
        @csrf

        {{ refract('TracksInput', [
            'initialTracks' => $tracks,
            'errors' => $errors->getMessages(),
        ]) }}

        <button>Save event</button>
    </form>
@endsection

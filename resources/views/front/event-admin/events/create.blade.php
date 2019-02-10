@extends('front.layouts.main')

@section('content')
    <h1>Host new event</h1>

    <form action="{{ route('event-admin.events.store') }}" method="POST">

        @include('front.event-admin.events.partials.form')

        <p>
            After saving this event, you can manage it's co-hosts, tracks, talk and schedule. Saving this event doesn't publish it yet.
        </p>
    </form>
@endsection

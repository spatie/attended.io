@extends('front.layouts.main')

@section('content')
    <h1>Host new event</h1>

    <form action="{{ route('event-admin.events.store') }}" method="POST">
        @csrf

        <scope :model="$event">
            <input-field name="name" label="Name" />
            <input-field name="description" label="Description" />
            <input-field name="location" label="Location" />
            <input-field name="city" label="City" />
            <input-field name="country" label="Country" />
            <input-field name="website" label="Website" />
            <input-field name="starts_at" label="Starts at" type="date" />
            <input-field name="ends_at" label="Ends at" type="date" />

            <h2>Call for papers</h2>

            <checkbox-field name="cfp" label="Call for papers" />
            <input-field name="cfp_link" label="Link" />
            <input-field name=cfp_deadline label="Deadline" type="datetime" />
        </scope>

        <button>Save</button>

        <p>
            After saving this event, you can manage it's co-hosts, tracks, talk and schedule. Saving this event doesn't publish it yet.
        </p>
    </form>
@endsection

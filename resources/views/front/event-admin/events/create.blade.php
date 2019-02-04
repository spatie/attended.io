@extends('front.layouts.main')

@section('content')
    <h1>Host new event</h1>

    <form action="{{ route('event-admin.events.store') }}" method="POST">
        @csrf
        <input type="text" name="name">
        <textarea name="description"></textarea>
        <input type="text" name="location">
        <input type="text" name="website">
        <input type="date" name="starts_at">
        <input type="date" name="ends_at">
        <button>Create</button>
    </form>
@endsection

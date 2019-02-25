@extends('front.layouts.main')

@section('content')
    {{ Menu::eventAdmin($event) }}

    <a href="{{ route('event-admin.slots.create', $event) }}">Create new slot</a>


    <h1>Slots for {{ $event->name }}</h1>
@endsection

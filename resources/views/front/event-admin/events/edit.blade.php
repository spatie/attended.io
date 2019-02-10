@extends('front.layouts.main')

@section('content')
    {{ Menu::eventAdmin($event) }}

    <h1>{{ $event->name }}</h1>

    <form action="{{ route('event-admin.events.update', $event) }}" method="POST">
        @include('front.event-admin.events.partials.form')
    </form>
@endsection
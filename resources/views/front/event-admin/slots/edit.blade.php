@extends('front.layouts.main')

@section('content')
    {{ Menu::eventAdmin($event) }}

    <h1>Update slot {{ $slot->name }}</h1>

    <form action="{{ route('event-admin.slots.update', [$event, $slot]) }}" method="POST">

        @include('front.event-admin.slots.partials.form')

    </form>
@endsection

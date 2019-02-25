@extends('front.layouts.main')

@section('content')
    <h1>Add new slot to {{ $event->name }}</h1>

    <form action="{{ route('event-admin.slots.store', $event) }}" method="POST">

        @include('front.event-admin.slots.partials.form')

    </form>
@endsection

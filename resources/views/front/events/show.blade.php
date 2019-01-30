@extends('front.layouts.main')

@section('content')
    <h2>{{ $event->name }}</h2>
    {{ $event->timespan() }}
    {{ $event->location }}

    @include('front.events.partials.schedule')
@endsection
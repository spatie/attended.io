@extends('front.layouts.main')

@section('content')
    <h1>Profile</h1>

    @include('front.profile.partials.profile')

    @foreach($slots as $slot)
        <div>
            <a href="{{ route('slots.show', $slot) }}">{{ $slot->name }}</a>
            {{ $slot->event->name }}
            {{ $slot->event->timeSpan() }} — {{ $slot->event->location }}
            , {{ $slot->event->city }} {{ $slot->event->country_emoji }}

            @include('front.reviews.partials.summary', ['reviewable' => $slot])
        </div>

    @endforeach

    @if($slots->nextPageUrl())
        <a href="{{ $slots->nextPageUrl() }}">
            Older talks
        </a>
    @endif

    @if($slots->previousPageUrl())
        <a href="{{ $slots->previousPageUrl() }}">
           Newer talks
        </a>
    @endif
@endsection
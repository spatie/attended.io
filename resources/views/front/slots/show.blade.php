@extends('front.layouts.main')

@push('headers')
    <link rel="canonical" href="{{ route('slots.show', $slot->idSlug()) }}"/>
@endpush

@section('content')

    <h1>{{ $slot->name }}</h1>
    {{ $slot->starts_at->format('d M H:i') }} - {{ $slot->trackName() }} - <a
        href="{{ route('events.show-schedule', $slot->event->idSlug()) }}">{{ $slot->event->name }}</a>

    Short url: <a href="{{ url($slot->short_slug) }}">{{ url($slot->short_slug) }}</a>
    @include('front.slots.partials.by-speaker')

    @include('front.reviews.partials.summary', ['reviewable' => $slot])

    @include('front.slots.partials.claim-slot')

    @include('front.slots.partials.ownership-claims')

    {{ $slot->description }}

    @include('front.reviews.partials.feedback', ['reviewable' => $slot])
@endsection

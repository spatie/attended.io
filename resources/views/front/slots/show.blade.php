@extends('front.layouts.main')

@section('content')

    <h1>{{ $slot->name }}</h1>
    {{ $slot->starts_at->format('d M H:i') }} - {{ $slot->location }} - <a href="{{ route('events.show', $slot->event->idSlug()) }}">{{ $slot->event->name }}</a>
    @include('front.slots.partials.by-speaker')

    @include('front.reviews.partials.summary')

    {{ $slot->description }}

    @include('front.reviews.partials.feedback', ['reviewable' => $slot])
@endsection
@extends('front.layouts.main')

@push('headers')
<link rel="canonical" href="{{ route('slots.show', $slot->idSlug()) }}" />
@endpush

@section('content')

    <h1>{{ $slot->name }}</h1>
    {{ $slot->starts_at->format('d M H:i') }} - {{ $slot->trackName() }} - <a href="{{ route('events.show', $slot->event->idSlug()) }}">{{ $slot->event->name }}</a>
    @include('front.slots.partials.by-speaker')

    @include('front.reviews.partials.summary', ['reviewable' => $slot])

    @can('claim', $slot)
        <form method="POST" action="{{ route('slots.claim', $slot->idSlug()) }}">
            @csrf
            <button type="submit">Claim</button>
        </form>
    @endcan

    {{ $slot->description }}

    @include('front.reviews.partials.feedback', ['reviewable' => $slot])
@endsection
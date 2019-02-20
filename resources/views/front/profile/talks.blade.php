@extends('front.layouts.main')

@push('headers')
    <link rel="canonical" href="{{ route('profile.events.show', $user->idSlug()) }}"/>
@endpush

@section('content')
    {{ Menu::profile($user) }}

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

    <pagination
        :paginator="$slots"
        next-label="Older talks"
        previous-label="Newer talks"
    />
@endsection
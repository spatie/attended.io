@extends('front.layouts.main')

@push('headers')
    <link rel="canonical" href="{{ route('slots.show', $slot->idSlug()) }}"/>
@endpush

@section('content')

    <h1>{{ $slot->name }}</h1>
    {{ $slot->starts_at->format('d M H:i') }} - {{ $slot->trackName() }} - <a
            href="{{ route('events.show', $slot->event->idSlug()) }}">{{ $slot->event->name }}</a>

    Short url: <a href="{{ url($slot->short_slug) }}">{{ url($slot->short_slug) }}</a>
    @include('front.slots.partials.by-speaker')

    @include('front.reviews.partials.summary', ['reviewable' => $slot])

    @can('claim', $slot)
        <action-button :action="route('slots.claim', $slot->idSlug())">
            <button type="submit">Claim</button>
        </action-button>
    @endcan

    @can('administer', $slot->event)
        @foreach($slot->claims as $claim)
            <div>
                <a href="{{ route('users.show', $claim->user->id) }}">{{ $claim->user->email }}</a> is claiming this slot

                <action-button :action="route('slot-ownership-claims.approve', $claim->id)">
                    <button type="submit">Approve</button>
                </action-button>

                <action-button :action="route('slot-ownership-claims.reject', $claim->id)">
                    <button type="submit">Reject</button>
                </action-button>

            </div>
        @endforeach
    @endcan


    {{ $slot->description }}

    @include('front.reviews.partials.feedback', ['reviewable' => $slot])
@endsection
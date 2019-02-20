@extends('front.layouts.main')

@push('headers')
    <link rel="canonical" href="{{ route('profile.events.show', $user->idSlug()) }}" />
@endpush

@section('content')
    {{ Menu::profile($user) }}

    @include('front.profile.partials.profile')

    @foreach($events as $event)
        <div>
            {{ $event->name }}
        </div>

    @endforeach
@endsection
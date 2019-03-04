@extends('front.layouts.main')

@push('headers')
<link rel="canonical" href="{{ route('events.show-schedule', $event->idSlug()) }}" />
@endpush

@section('content')
    @include('front.events.partials.event-detail-header')

    @include('front.events.partials.schedule')
@endsection
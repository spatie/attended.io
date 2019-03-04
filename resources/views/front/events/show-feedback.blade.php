@extends('front.layouts.main')

@push('headers')
<link rel="canonical" href="{{ route('events.show-feedback', $event->idSlug()) }}" />
@endpush

@section('content')
    @include('front.events.partials.event-detail-header')

    @include('front.reviews.partials.feedback', ['reviewable' => $event])

@endsection
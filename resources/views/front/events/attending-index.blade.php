@extends('front.layouts.main')

@section('content')
    @include('front.events.partials.filter-bar')

    <h1>Attending</h1>

    @include('front.events.partials.list')
@endsection
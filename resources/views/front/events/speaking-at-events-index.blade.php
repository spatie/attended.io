@extends('front.layouts.main')

@section('content')
    @include('front.events.partials.filter-bar')

    <h1>Speaking</h1>

    @include('front.events.partials.list')
@endsection
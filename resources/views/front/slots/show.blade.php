@extends('front.layouts.main')

@section('content')

    <h1>{{ $slot->name }}</h1>
    @include('front.slots.partials.by-speaker')
@endsection
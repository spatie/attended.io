@extends('front.layouts.main')

@section('content')
    <h1>Recent events</h1>

    <ul>
        @foreach($events as $event)
            <li>@include('front.events.partials.listItem')</li>
        @endforeach
    </ul>
@endsection
@extends('front.layouts.main')

@section('content')
    {{ Menu::eventAdmin($event) }}

    <h1>Slots for {{ $event->name }}</h1>
@endsection

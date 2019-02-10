@extends('front.layouts.main')

@section('content')
    {{ Menu::eventAdmin($event) }}

    <h1>Tracks for {{ $event->name }}</h1>
@endsection
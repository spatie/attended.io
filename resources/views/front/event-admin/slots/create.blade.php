@extends('front.layouts.main')

@section('content')
    <h1>Create new slot</h1>

    <form action="{{ route('event-admin.slots.store', $event) }}" method="POST">

        @include('front.event-admin.slots.partials.form')

    </form>
@endsection

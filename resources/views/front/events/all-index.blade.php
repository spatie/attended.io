@extends('front.layouts.main')

@section('content')
    <div class="max-w-xl -mt-3">
        @include('front.events.partials.filter-bar')

        @include('front.events.partials.list')
    </div>
@endsection
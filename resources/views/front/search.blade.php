@extends('front.layouts.main')

@section('content')
    <h1>Search</h1>

    <form action="{{ route('search') }}">
        <input type="text" value="{{ $query }}" name="query" />

        <button>Search</button>
    </form>

    @forelse($searchResults as $searchResult)
        @include('front.events.partials.listItem', ['event' => $searchResult->searchable])
    @empty
        Nothing found
    @endforelse
@endsection
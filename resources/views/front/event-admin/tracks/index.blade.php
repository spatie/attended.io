@extends('front.layouts.main')

@section('content')
    {{ Menu::eventAdmin($event) }}

    <h1>Tracks for {{ $event->name }}</h1>

    <form action="">

        <div class="flex flex-row">
            @foreach($event->tracks as $track)
                <div class="">
                    <input type="hidden" name="tracks[{{ $loop->index }}][id]" value="{{ $track->id }}">
                    <input type="hidden" name="tracks[{{ $loop->index }}][order]" value="{{ $track->order_column }}">
                    <input type="text" name="tracks[{{ $loop->index }}][name]" value="{{ $track->name }}">
                    <button type="button">Delete</button>
                </div>
            @endforeach
        </div>

        <button type="submit">Save</button>

    </form>
@endsection

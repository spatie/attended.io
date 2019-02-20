@extends('front.layouts.main')

@push('headers')
    <link rel="canonical" href="{{ route('profile.reviews.show', $user->idSlug()) }}" />
@endpush

@section('content')
    {{ Menu::profile($user) }}

    @include('front.profile.partials.profile')

    @foreach($reviews as $review)
        <div>
            @include("front.profile.partials.{$review->reviewableType()}-review")
        </div>
    @endforeach

    <pagination
        :paginator="$reviews"
        next-label="Older reviews"
        previous-label="Newer reviews"
    />
@endsection
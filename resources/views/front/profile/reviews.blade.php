@extends('front.layouts.main')

@push('headers')
    <link rel="canonical" href="{{ route('profile.reviews.show', $user->idSlug()) }}" />
@endpush

@section('content')
    {{ Menu::profile($user) }}

    @include('front.profile.partials.profile')

    @foreach($reviews as $review)
        <div>
            Here is a review
        </div>

    @endforeach
@endsection
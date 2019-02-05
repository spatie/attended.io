@extends('front.layouts.main')

@push('headers')
<link rel="canonical" href="{{ route('users.show', $user->idSlug()) }}" />
@endpush

@section('content')

    <h1>{{ $user->name }}</h1>
@endsection
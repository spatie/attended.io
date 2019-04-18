@extends('front.layouts.app')

@section('main')

    <div class="p-8 | md:p-16 lg:px-32">
        @include('front.layouts.partials.unverified-email-warning')
        @include('front.layouts.partials.flashMessage')
        
        @yield('content')
    </div>

@endsection
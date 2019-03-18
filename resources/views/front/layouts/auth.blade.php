@extends('front.layouts.app')

@section('main')

    <div class="sticky grid pin-t px-8 py-16 | md:p-16 md:min-h-screen md:justify-start md:content-center">
        @include('front.layouts.partials.unverified-email-warning')
        @include('front.layouts.partials.flashMessage')
        <div class="md:-ml-24">    
            @yield('content')
        </div>
    </div>

@endsection
@extends('front.layouts.app')

@section('main')
<main class="layout-content">
    <div class="flex justify-end p-8 | md:hidden">
        <div class="text-grey-darker" style="width: 12rem">
            @include('front/layouts/partials/logo')
        </div> 
    </div>
    <div> 
        <div class="sticky pin-t grid p-8 | md:p-16 md:min-h-screen md:place-content-center">
            @include('front.layouts.partials.unverified-email-warning')
            @include('front.layouts.partials.flashMessage')
            
            @yield('content')
        </div>
    </div>
</main>
@endsection
@extends('front.layouts.auth')

@section('content')  

    <div class="card-form markup">
        @if (session('resent'))
            <div class="alert is-success" role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
        @endif

        <h1 class="text-center">{{ __('Verify email') }}</h1>

        <p>
            {{ __('Before proceeding, please check your email for a verification link.') }}
            {{ __('If you did not receive the email, request one below.') }}
        </p>

        <div class="form-buttons">     
            <a href="{{ route('verification.resend') }}" class="button">
                {{ __('Request new link') }}
            </a>                   
        </div>        
    </div>

@endsection

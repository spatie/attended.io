@extends('front.layouts.auth')

@section('content')

    <div class="card-form markup">
        <h1 class="text-center">{{ __('Reset Password') }}</h1>

        <form class="form" method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-grid">
                <div class="form-field  {{ $errors->has('email') ? 'has-errors' : '' }}" >
                    <label class="text-right" for="email">{{ __('Email') }}</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>

                    @if ($errors->has('email'))
                        <div class="alert is-error" role="alert">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>

                <div class="form-field  {{ $errors->has('password') ? 'has-errors' : ''}}" >
                    <label class="text-right" for="password">{{ __('Password') }}</label>
                    <input id="password" type="text" name="password" value="{{ old('password') }}" required>
                    
                    @if ($errors->has('password'))
                        <div class="alert is-error" role="alert">
                            {{ $errors->first('password') }}
                        </div>
                    @endif  
                </div>
                
                <div class="form-field">
                    <label class="text-right" for="password-confirm">{{ __('Confirm password') }}</label>
                    <input id="password-confirm" type="text" name="password_confirmation" required>   
                </div>
            </div>

            <div class="form-buttons">     
                <button type="submit" class="button">
                    {{ __('Reset Password') }}
                </button>                   
            </div>        
        </form>
    </div>
    
@endsection
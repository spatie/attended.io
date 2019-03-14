@extends('front.layouts.main')

@section('content')

    <div class="card-form markup">
        <h1 class="text-center">{{ __('Create account') }}</h1>

        <form class="form" method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-grid">
                <div class="form-field  {{ $errors->has('name') ? 'has-errors' : ''}}" >
                    <label class="text-right" for="name">{{ __('Name') }}</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>

                    @if ($errors->has('name'))
                        <div class="alert is-error" role="alert">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                </div>

                <div class="form-field  {{ $errors->has('email') ? 'has-errors' : ''}}" >
                    <label class="text-right" for="email">{{ __('Email') }}</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required>

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
                    {{ __('Register') }}
                </button>                   
            </div>
        </form>    
    </div>

    <div class="mt-16 text-center markup">
        <a class="link text-grey" href="{{ route('login') }}">
            {{ __('Already have an account? Log in') }}
        </a>
    </div>

@endsection

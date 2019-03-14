@extends('front.layouts.main')

@section('content')
    
    <div class="card-form markup">
        <h1 class="text-center">{{ __('Log in') }}</h1>

        <form class="form" method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-grid">
                <div class="form-field  {{ $errors->has('email') ? 'has-errors' : ''}}" >
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
                    <input id="password" type="password" name="password" value="{{ old('password') }}" required>  
                    
                    @if ($errors->has('password'))
                        <div class="alert is-error" role="alert">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>               

                <div class="form-field">
                    <label class="startx-2 label-checkbox" for="remember">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span class="normal-case">{{ __('Remember me next time') }}</span>
                    </label>
                </div>                               
            </div>

            <div class="form-buttons">     
                <button type="submit" class="button">
                    {{ __('Enter') }}
                </button>                   
            </div>        
        </form>

    </div>

    @if (Route::has('password.request'))
        <div class="mt-16 text-center markup">
            <a class="link text-grey" href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
        </div>
    @endif

@endsection

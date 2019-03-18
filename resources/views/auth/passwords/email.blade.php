@extends('front.layouts.auth')

@section('content')

    <div class="card-form markup">
        @if (session('status'))
            <div class="alert is-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <h1 class="text-center">{{ __('Reset password') }}</h1>

        <form class="form" method="POST" action="{{ route('password.email') }}">
            @csrf

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
            </div>

            <div class="form-buttons">     
                <button type="submit" class="button">
                    {{ __('Sent reset link') }}
                </button>                   
            </div>        
        </form>
    </div>

@endsection
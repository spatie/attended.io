@extends('front.layouts.main')

@section('content')

    {{ Menu::profile() }}

    <h1>Change password</h1>

<form action="{{ route('password.update') }}" method="POST">
    @csrf
    <input-field type="password" name="current_password"  label="Current password" />

    <input-field type="password" name="new_password"  label="New password" />

    <input-field type="password" name="new_password_confirmation"  label="Verify password" />



    <button>Change password</button>
</form>

@endsection

@extends('front.layouts.main')

@section('content')

    {{ Menu::profile() }}

    <h1>My profile</h1>

    <form action="{{ route('profile.update', $user) }}" method="POST">
        @csrf

        <input-field type="email" name="email" :model="$user" label="Email"/>
        <input-field name="name" :model="$user" label="Name"/>
        <input-field name="bio" :model="$user" label="Bio"/>
        <input-field name="city" :model="$user" label="City"/>
        <country-select name="country_code" :model="$user" label="Country"/>
        <input-field name="joindin_username" :model="$user" label="Joindin username"/>

        <button>Save</button>
    </form>

@endsection

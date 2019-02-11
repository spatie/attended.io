@extends('front.layouts.main')

@section('content')

    {{ Menu::profile() }}

    <h1>My profile</h1>

    <form action="{{ route('profile.update', $user) }}" method="POST">
    @csrf

    <input-field type="email" name="email" :model="$user" label="Email" />
    <input-field name="name" :model="$user" label="Name"/>

    <button>Save</button>
</form>

@endsection

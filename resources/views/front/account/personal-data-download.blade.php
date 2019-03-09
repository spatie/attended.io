@extends('front.layouts.main')

@section('content')

    {{ Menu::account() }}

    <h1>Personal data download</h1>

    <div>
        Want to know what data we've stored on you? No problem. Click the button below and we'll email you a link to a zip file containing all your personal data in our system.
    </div>

    <action-button :action="route('account.personal-data-download.create')">
        <button type="submit">Create personal data download</button>
    </action-button>

@endsection

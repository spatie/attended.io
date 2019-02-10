@can('administer', $slot->event)
    @foreach($slot->claims as $claim)
        <div>
            <a href="{{ route('users.show', $claim->user->id) }}">{{ $claim->user->email }}</a> is claiming this slot

            <action-button :action="route('slot-ownership-claims.approve', $claim->id)">
                <button type="submit">Approve</button>
            </action-button>

            <action-button :action="route('slot-ownership-claims.reject', $claim->id)">
                <button type="submit">Reject</button>
            </action-button>

        </div>
    @endforeach
@endcan
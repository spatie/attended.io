@can('claim', $slot)
    <action-button :action="route('slots.claim', $slot->idSlug())">
        <button type="submit">Claim</button>
    </action-button>
@endcan
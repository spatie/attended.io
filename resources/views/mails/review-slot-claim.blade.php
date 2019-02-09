@component('mail::message')
# Slot claimed

{{ $claimingUser->email }} wants to claim the {{ $slot->name }} slot.

Head over to the <a href="{{ route('slots.show', $slot->idSlug()) }}">slot detail page</a> to approve or reject this claim.

Thanks,<br>
{{ config('app.name') }}
@endcomponent

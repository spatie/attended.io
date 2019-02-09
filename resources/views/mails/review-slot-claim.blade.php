@component('mail::message')
# Slot claimed

{{ $this->claimingUser->email }} wants to claim the {{ $this->slot->name }} slot.

Head over to the [admin page of the event](TODO: add link) to approve or reject this claim.

Thanks,<br>
{{ config('app.name') }}
@endcomponent

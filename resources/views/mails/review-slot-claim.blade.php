@component('mail::message')
# Slot claimed

{{ $pendingOwnership->user->email }} wants to claim the {{ $pendingOwnership->ownable->name }} slot.

Head over to the [admin page of the event](TODO: add link) to approve or reject this claim.

Thanks,<br>
{{ config('app.name') }}
@endcomponent

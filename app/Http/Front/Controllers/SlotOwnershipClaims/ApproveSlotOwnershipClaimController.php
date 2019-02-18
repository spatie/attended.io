<?php

namespace App\Http\Front\Controllers\SlotOwnershipClaims;

use App\Domain\Slot\Actions\ApproveSlotOwnershipClaimAction;
use App\Domain\Slot\Models\SlotOwnershipClaim;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ApproveSlotOwnershipClaimController
{
    use AuthorizesRequests;

    public function __invoke(SlotOwnershipClaim $claim, ApproveSlotOwnershipClaimAction $approveSlotClaimAction)
    {
        $this->authorize('administer', $claim);

        $approveSlotClaimAction->execute($claim);

        flash()->success("This slot is now owned by {$claim->user->email}");

        return back();
    }
}

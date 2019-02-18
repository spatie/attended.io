<?php

namespace App\Http\Front\Controllers\SlotOwnershipClaims;

use App\Domain\Slot\Actions\ApproveSlotOwnershipClaimAction;
use App\Models\SlotOwnershipClaim;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RejectSlotOwnershipClaimController
{
    use AuthorizesRequests;

    public function __invoke(SlotOwnershipClaim $claim, ApproveSlotOwnershipClaimAction $approveSlotClaimAction)
    {
        $this->authorize('administer', $claim);

        $approveSlotClaimAction->execute($claim);

        flash()->success("The claim has been rejected");

        return back();
    }
}

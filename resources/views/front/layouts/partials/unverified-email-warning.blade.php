@auth
    @if(! auth()->user()->hasVerifiedEmail())
        Your email-address is not verified. Please click the link in the verification mail we sent you!

        <action-button :action="route('verification.resend')">
            <button>Resend verification email</button>
        </action-button>
    @endif
@endauth
<p>Hi {{ $profile->full_name }},</p>
<p>Thanks for registration on '{{ config('app.name') }}'. Registration almost completed.</p>
<p>Please confirm your registration
    <a href="{{ route('frontend.account.confirm', ['token' => $account->registration_token]) }}">here</a></p>
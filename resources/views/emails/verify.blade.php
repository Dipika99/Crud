
@component('mail::message')

Your registered email-id is {{$user->email}} , Please click on the below button to verify your email account.


@component('mail::button', ['url' => url('/verifyEmail', $user->email_token)])
Verfiy Account
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

<x-mail::message>
# Verification code

Below is your verification code for your request to reset the password, please do not share this verification code with anyone.

<x-mail::button :url="'#'">
{{ $verification_code }}
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

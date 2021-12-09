@component('mail::message')
# Bevestiging van uw bericht

Uw bericht is in goede orde ontvangen.<br>

{{ $data["message"] }}<br>

Met vriendelijke groet,<br>
{{ config('app.name') }}
@endcomponent
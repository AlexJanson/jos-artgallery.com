@component('mail::message')
# Nieuw bericht

Naam: {{ $data["lastname"] }}, {{ $data["name"] }} - {{ $data["email"] }} <br> <br>
Onderwerp: {{ $data["subject"] }} <br> <br>
Bericht: <br>
{{ $data["message"] }}

@endcomponent
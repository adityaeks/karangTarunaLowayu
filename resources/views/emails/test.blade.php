<x-mail::message>
# Introduction

Ini email test berhasil terkirim via Gmail SMTP!

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

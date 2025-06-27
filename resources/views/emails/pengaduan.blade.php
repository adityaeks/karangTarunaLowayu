@component('mail::message')
# Pengaduan Baru

**Nama:** {{ $name }}  
**Nomor HP:** {{ $number }}  
**Tanggal Pengaduan:** {{ $created_at }}

**Isi Pengaduan:**  
{{ $content }}

@if ($fileUrl)
**Bukti Pengaduan:**  
[Download / Lihat File]({{ $fileUrl }})
@endif

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent

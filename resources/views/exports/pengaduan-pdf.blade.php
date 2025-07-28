<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Pengaduan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
            color: #000000;
        }
        .header h2 {
            margin: 5px 0 0 0;
            font-size: 14px;
            font-weight: normal;
        }
        .header h2:first-of-type {
            font-weight: bold;
            color: #000000;
            font-size: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }
        th {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: center;
        }
        .no-col {
            width: 4%;
            text-align: center;
        }
        .date-col {
            width: 10%;
        }
        .name-col {
            width: 12%;
        }
        .phone-col {
            width: 11%;
        }
        .message-col {
            width: 35%;
        }
        .proof-col {
            width: 8%;
            text-align: center;
        }
        .image-col {
            width: 20%;
            text-align: center;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
        }
        .break-word {
            word-wrap: break-word;
            word-break: break-word;
        }
        .bukti-image {
            max-width: 100px;
            max-height: 80px;
            object-fit: cover;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN DATA PENGADUAN</h1>
        @if(!empty($filterInfo))
            <h2>{{ $filterInfo }}</h2>
        @else
            <h2>Periode: Semua Data</h2>
        @endif
        {{-- Debug: uncomment for testing --}}
        {{-- <p style="font-size:10px; color: red;">Debug: filterInfo = "{{ $filterInfo ?? 'empty' }}"</p> --}}
    </div>

    <table>
        <thead>
            <tr>
                <th class="no-col">No</th>
                <th class="date-col">Tanggal</th>
                <th class="name-col">Nama</th>
                <th class="phone-col">No. Telepon</th>
                <th class="message-col">Pesan Pengaduan</th>
                <th class="image-col">Bukti Gambar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengaduans as $index => $pengaduan)
            <tr>
                <td class="no-col">{{ $index + 1 }}</td>
                <td class="date-col">{{ $pengaduan->created_at->format('d M Y') }}</td>
                <td class="name-col">{{ $pengaduan->name }}</td>
                <td class="phone-col">+62{{ ltrim($pengaduan->number, '0') }}</td>
                <td class="message-col break-word">{{ $pengaduan->content }}</td>
                <td class="image-col">
                    @if($pengaduan->bukti_pengaduan)
                        @php
                            $imagePath = public_path($pengaduan->bukti_pengaduan);
                        @endphp
                        @if(file_exists($imagePath))
                            <img src="{{ $imagePath }}" alt="Bukti" class="bukti-image">
                        @else
                            <small>Gambar tidak ditemukan</small>
                        @endif
                    @else
                        <small>Tidak ada bukti</small>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p><strong>Total Pengaduan: {{ count($pengaduans) }} data</strong></p>
        <p>Dicetak pada: {{ date('d F Y, H:i') }} WIB</p>
    </div>
</body>
</html>

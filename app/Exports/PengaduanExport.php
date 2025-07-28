<?php

namespace App\Exports;

use App\Models\Pengaduan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PengaduanExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize, WithColumnWidths
{
    protected $pengaduans;

    public function __construct($pengaduans = null)
    {
        $this->pengaduans = $pengaduans;
    }

    public function collection()
    {
        if ($this->pengaduans) {
            return $this->pengaduans;
        }
        return Pengaduan::orderBy('created_at', 'asc')->get(); // Ubah ke ASC untuk data lama terlebih dahulu
    }

    public function headings(): array
    {
        return [
            'No',
            'Tanggal',
            'Nama',
            'Nomor Telepon',
            'Pesan Pengaduan',
            'Status Bukti',
            'Path Bukti Gambar'
        ];
    }

    public function map($pengaduan): array
    {
        static $index = 0;
        $index++;

        $buktiPath = '';
        if ($pengaduan->bukti_pengaduan) {
            // Buat URL lengkap untuk akses gambar
            $buktiPath = url($pengaduan->bukti_pengaduan);
        }

        return [
            $index,
            $pengaduan->created_at->format('d M Y, H:i'),
            $pengaduan->name,
            '+62' . ltrim($pengaduan->number, '0'),
            $pengaduan->content,
            $pengaduan->bukti_pengaduan ? 'Ada Bukti' : 'Tidak Ada Bukti',
            $buktiPath
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,   // No
            'B' => 15,  // Tanggal
            'C' => 20,  // Nama
            'D' => 15,  // Nomor Telepon
            'E' => 40,  // Pesan Pengaduan
            'F' => 12,  // Status Bukti
            'G' => 50,  // Path Bukti Gambar
        ];
    }
}

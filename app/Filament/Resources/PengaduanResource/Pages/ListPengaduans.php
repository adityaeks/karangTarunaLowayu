<?php

namespace App\Filament\Resources\PengaduanResource\Pages;

use App\Filament\Resources\PengaduanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PengaduanExport;

class ListPengaduans extends ListRecords
{
    protected static string $resource = PengaduanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('export_pdf')
                ->label('Export PDF')
                ->icon('heroicon-o-document-arrow-down')
                ->color('danger')
                ->action(function () {
                    // Ambil data yang sudah difilter dari table
                    $query = $this->getFilteredTableQuery();
                    $pengaduans = $query->orderBy('created_at', 'asc')->get(); // Ubah ke ASC untuk data lama terlebih dahulu

                    // Ambil informasi filter untuk judul - gunakan method yang benar
                    $tableFilters = $this->getTable()->getFilters();
                    $activeFilters = [];

                    foreach ($tableFilters as $filterName => $filter) {
                        $state = $filter->getState();
                        if (!empty($state)) {
                            $activeFilters[$filterName] = $state;
                        }
                    }

                    $filterInfo = $this->getFilterDisplayInfo($activeFilters);

                    $html = view('exports.pengaduan-pdf', compact('pengaduans', 'filterInfo'))->render();

                    $pdf = PDF::loadHTML($html);
                    $pdf->setPaper('A4', 'landscape');

                    $filename = 'Data_Pengaduan';
                    if (!empty($filterInfo)) {
                        $filename .= '_' . $filterInfo;
                    }
                    $filename .= '_' . date('Y-m-d_H-i-s') . '.pdf';

                    return Response::streamDownload(function() use ($pdf) {
                        echo $pdf->output();
                    }, $filename);
                }),

            Actions\Action::make('export_excel')
                ->label('Export Excel')
                ->icon('heroicon-o-table-cells')
                ->color('success')
                ->action(function () {
                    // Ambil data yang sudah difilter dari table
                    $query = $this->getFilteredTableQuery();
                    $pengaduans = $query->orderBy('created_at', 'asc')->get(); // Ubah ke ASC untuk data lama terlebih dahulu

                    // Ambil informasi filter untuk filename
                    $tableFilters = $this->getTable()->getFilters();
                    $activeFilters = [];

                    foreach ($tableFilters as $filterName => $filter) {
                        $state = $filter->getState();
                        if (!empty($state)) {
                            $activeFilters[$filterName] = $state;
                        }
                    }

                    $filterInfo = $this->getFilterInfo($activeFilters);

                    $filename = 'Data_Pengaduan';
                    if (!empty($filterInfo)) {
                        $filename .= '_' . $filterInfo;
                    }
                    $filename .= '_' . date('Y-m-d_H-i-s') . '.xlsx';

                    return Excel::download(new PengaduanExport($pengaduans), $filename);
                }),
        ];
    }

    /**
     * Ambil informasi filter yang sedang aktif untuk display di PDF
     */
    protected function getFilterDisplayInfo($filters): string
    {
        // Filter bulan
        if (isset($filters['month']['month']) && !empty($filters['month']['month'])) {
            $bulanNames = [
                1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
            ];
            $bulan = $bulanNames[$filters['month']['month']] ?? '';
            $tahun = $filters['month']['year'] ?? date('Y');
            if ($bulan) {
                return "Periode: Bulan {$bulan} {$tahun}";
            }
        } elseif (isset($filters['month']['year']) && !empty($filters['month']['year'])) {
            return "Periode: Tahun " . $filters['month']['year'];
        }

        // Filter tanggal
        if (isset($filters['created_at']['created_from']) && !empty($filters['created_at']['created_from'])) {
            $from = date('d F Y', strtotime($filters['created_at']['created_from']));
            $to = isset($filters['created_at']['created_until']) ?
                  date('d F Y', strtotime($filters['created_at']['created_until'])) : $from;

            if ($from === $to) {
                return "Periode: Tanggal {$from}";
            } else {
                return "Periode: {$from} sampai {$to}";
            }
        }

        return '';
    }

    /**
     * Ambil informasi filter yang sedang aktif untuk filename
     */
    protected function getFilterInfo($filters): string
    {
        $filterParts = [];

        // Filter bulan
        if (isset($filters['month']['month']) && !empty($filters['month']['month'])) {
            $bulanNames = [
                1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
            ];
            $bulan = $bulanNames[$filters['month']['month']] ?? '';
            $tahun = $filters['month']['year'] ?? date('Y');
            if ($bulan) {
                $filterParts[] = $bulan . '_' . $tahun;
            }
        } elseif (isset($filters['month']['year']) && !empty($filters['month']['year'])) {
            $filterParts[] = 'Tahun_' . $filters['month']['year'];
        }

        // Filter tanggal
        if (isset($filters['created_at']['created_from']) && !empty($filters['created_at']['created_from'])) {
            $from = date('d-m-Y', strtotime($filters['created_at']['created_from']));
            $to = isset($filters['created_at']['created_until']) ?
                  date('d-m-Y', strtotime($filters['created_at']['created_until'])) : $from;
            $filterParts[] = $from . '_sampai_' . $to;
        }

        return implode('_', $filterParts);
    }

    protected function getActions(): array
    {
        return [];
    }

}

<?php

namespace App\Filament\Resources\PengaduanResource\Pages;

use App\Filament\Resources\PengaduanResource;
use Filament\Resources\Pages\ViewRecord;

class ViewPengaduan extends ViewRecord
{
    protected static string $resource = PengaduanResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            // ...existing code...
        ];
    }

    protected function getActions(): array
    {
        return [
            // Add a custom action to download the evidence file
            \Filament\Pages\Actions\Action::make('download')
                ->label('Download Bukti Pengaduan')
                ->url(fn () => $this->record->bukti_pengaduan ? asset('storage/' . $this->record->bukti_pengaduan) : null)
                ->openUrlInNewTab()
                ->disabled(fn () => is_null($this->record->bukti_pengaduan)),
        ];
    }
}

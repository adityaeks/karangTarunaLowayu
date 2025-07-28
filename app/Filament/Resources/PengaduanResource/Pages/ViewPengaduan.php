<?php

namespace App\Filament\Resources\PengaduanResource\Pages;

use App\Filament\Resources\PengaduanResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Actions\Action;
use Illuminate\Support\Facades\Storage;

class ViewPengaduan extends ViewRecord
{
    protected static string $resource = PengaduanResource::class;

    public function infolist(\Filament\Infolists\Infolist $infolist): \Filament\Infolists\Infolist
    {
        return $infolist
            ->schema([
                Section::make('Informasi Pengaduan')
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Tanggal Pengaduan')
                            ->dateTime('d F Y, H:i')
                            ->timezone('Asia/Jakarta'),
                        TextEntry::make('name')
                            ->label('Nama Pelapor'),
                        TextEntry::make('number')
                            ->label('Nomor Telepon')
                            ->formatStateUsing(fn ($state) => '+62' . ltrim($state, '0')),
                        TextEntry::make('content')
                            ->label('Isi Pengaduan')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Bukti Pengaduan')
                    ->schema([
                        ImageEntry::make('bukti_pengaduan')
                            ->label('File Bukti')
                            ->getStateUsing(function ($record) {
                                // Data di database sudah berisi full path, gunakan langsung
                                return $record->bukti_pengaduan ? $record->bukti_pengaduan : null;
                            })
                            ->height(300)
                            ->width(400)
                            ->hiddenLabel()
                            ->visible(fn ($record) => $record->bukti_pengaduan),

                        TextEntry::make('bukti_status')
                            ->label('Status Bukti')
                            ->getStateUsing(function ($record) {
                                return $record->bukti_pengaduan ? 'Bukti Tersedia' : 'Tidak Ada Bukti';
                            })
                            ->badge()
                            ->color(fn ($state) => $state === 'Bukti Tersedia' ? 'success' : 'danger'),
                    ])
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('download_bukti')
                ->label('Download Bukti')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('primary')
                ->url(function () {
                    if ($this->record->bukti_pengaduan) {
                        // Gunakan path langsung dari database
                        return asset($this->record->bukti_pengaduan);
                    }
                    return null;
                })
                ->openUrlInNewTab()
                ->visible(fn () => $this->record->bukti_pengaduan),

            \Filament\Actions\DeleteAction::make()
                ->requiresConfirmation()
                ->modalHeading('Hapus Pengaduan')
                ->modalDescription('Apakah Anda yakin ingin menghapus pengaduan ini? Data yang dihapus tidak dapat dikembalikan.')
                ->modalSubmitActionLabel('Ya, Hapus')
                ->modalCancelActionLabel('Batal')
                ->successNotificationTitle('Pengaduan berhasil dihapus')
                ->successRedirectUrl(route('filament.admin.resources.pengaduans.index'))
                ->after(function () {
                    // Hapus file bukti pengaduan jika ada
                    if ($this->record->bukti_pengaduan && file_exists(public_path($this->record->bukti_pengaduan))) {
                        unlink(public_path($this->record->bukti_pengaduan));
                    }
                }),
        ];
    }
}

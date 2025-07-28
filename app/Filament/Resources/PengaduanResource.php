<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengaduanResource\Pages;
use App\Filament\Resources\PengaduanResource\RelationManagers;
use App\Models\Pengaduan;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Twilio\Rest\Client; // Add this import for Twilio
use Filament\Tables\Filters\Filter;

class PengaduanResource extends Resource
{
    protected static ?string $model = Pengaduan::class;
    protected static ?string $navigationLabel = 'Pengaduan';
    protected static ?string $pluralLabel = 'Pengaduan';

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required(),

                TextInput::make('number')
                    ->prefix('+62')
                    ->numeric()
                    ->required(),

                Textarea::make('content')
                    ->rows(10)
                    ->cols(20)
                    ->required(),

                FileUpload::make('bukti_pengaduan')
                    ->label('Bukti Pengaduan')
                    ->disk('public_uploads') // custom disk ke public/uploads
                    ->directory('pengaduan_files')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('index')
                    ->label('No')
                    ->getStateUsing(function ($rowLoop, $record, $table) {
                        $totalRecords = $table->getRecords()->count();
                        return $totalRecords - $rowLoop->iteration + 1;
                    }),
                TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y, H:i')
                    ->timezone('Asia/Jakarta')
                    ->sortable(),
                TextColumn::make('name'),
                TextColumn::make('number')
                    ->getStateUsing(function ($record) {
                        return '+62' . ltrim($record->number, '0');
                    })
                    ->limit(12),
                TextColumn::make('content')
                    ->label('Pesan Pengaduan')
                    ->limit(50),
                TextColumn::make('bukti_pengaduan')
                    ->label('Bukti')
                    ->getStateUsing(function ($record) {
                        return $record->bukti_pengaduan ? 'Ada' : 'Tidak';
                    })
                    ->color(function ($state) {
                        return $state === 'Ada' ? 'success' : 'danger';
                    })
                    ->badge(),
            ])
            ->filters([
                // Filter::make('created_at')
                //     ->label('Tanggal Pengaduan')
                //     ->form([
                //         Forms\Components\DatePicker::make('created_from')
                //             ->label('Dari Tanggal'),
                //         Forms\Components\DatePicker::make('created_until')
                //             ->label('Sampai Tanggal'),
                //     ])
                //     ->query(function (Builder $query, array $data) {
                //         return $query
                //             ->when($data['created_from'] ?? null, fn ($query, $date) => $query->whereDate('created_at', '>=', $date))
                //             ->when($data['created_until'] ?? null, fn ($query, $date) => $query->whereDate('created_at', '<=', $date));
                //     })
                //     ->indicateUsing(function (array $data): array {
                //         $indicators = [];

                //         if ($data['created_from'] ?? null) {
                //             $indicators[] = 'Dari: ' . date('d M Y', strtotime($data['created_from']));
                //         }

                //         if ($data['created_until'] ?? null) {
                //             $indicators[] = 'Sampai: ' . date('d M Y', strtotime($data['created_until']));
                //         }

                //         return $indicators;
                //     }),

                Filter::make('month')
                    ->label('Filter Bulan')
                    ->form([
                        Forms\Components\Select::make('month')
                            ->label('Pilih Bulan')
                            ->options([
                                1 => 'Januari',
                                2 => 'Februari',
                                3 => 'Maret',
                                4 => 'April',
                                5 => 'Mei',
                                6 => 'Juni',
                                7 => 'Juli',
                                8 => 'Agustus',
                                9 => 'September',
                                10 => 'Oktober',
                                11 => 'November',
                                12 => 'Desember',
                            ])
                            ->placeholder('Semua Bulan'),
                        Forms\Components\Select::make('year')
                            ->label('Pilih Tahun')
                            ->options(function () {
                                $currentYear = date('Y');
                                $years = [];
                                for ($i = $currentYear; $i >= $currentYear - 5; $i--) {
                                    $years[$i] = $i;
                                }
                                return $years;
                            })
                            ->default(date('Y'))
                            ->placeholder('Pilih Tahun'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when($data['month'] ?? null, function ($query, $month) use ($data) {
                                $year = $data['year'] ?? date('Y');
                                return $query->whereMonth('created_at', $month)
                                           ->whereYear('created_at', $year);
                            })
                            ->when($data['year'] ?? null, function ($query, $year) use ($data) {
                                if (!isset($data['month'])) {
                                    return $query->whereYear('created_at', $year);
                                }
                                return $query;
                            });
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];

                        if ($data['month'] ?? null) {
                            $bulanNames = [
                                1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                                5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                                9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                            ];
                            $bulan = $bulanNames[$data['month']];
                            $tahun = $data['year'] ?? date('Y');
                            $indicators[] = "Bulan: {$bulan} {$tahun}";
                        } elseif ($data['year'] ?? null) {
                            $indicators[] = "Tahun: " . $data['year'];
                        }

                        return $indicators;
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->requiresConfirmation()
                    ->modalHeading('Hapus Pengaduan')
                    ->modalDescription('Apakah Anda yakin ingin menghapus pengaduan ini? Data yang dihapus tidak dapat dikembalikan.')
                    ->modalSubmitActionLabel('Ya, Hapus')
                    ->modalCancelActionLabel('Batal')
                    ->successNotificationTitle('Pengaduan berhasil dihapus')
                    ->after(function ($record) {
                        // Hapus file bukti pengaduan jika ada
                        if ($record->bukti_pengaduan && file_exists(public_path($record->bukti_pengaduan))) {
                            unlink(public_path($record->bukti_pengaduan));
                        }
                    }),
            ])
            ->bulkActions([
                // Bulk actions removed - only individual delete buttons available
            ])
            ->selectable(false)
            ->defaultSort('created_at', 'desc'); // Add this line to sort by newest
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPengaduans::route('/'),
            'view' => Pages\ViewPengaduan::route('/{record}'),
        ];
    }
}

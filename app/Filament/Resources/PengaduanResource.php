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
                    ->dateTime('d M Y')
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
                    }),
            ])
            ->filters([
                Filter::make('created_at')
                    ->label('Tanggal Pengaduan')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('Dari Tanggal'),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when($data['created_from'] ?? null, fn ($query, $date) => $query->whereDate('created_at', '>=', $date))
                            ->when($data['created_until'] ?? null, fn ($query, $date) => $query->whereDate('created_at', '<=', $date));
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([])
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

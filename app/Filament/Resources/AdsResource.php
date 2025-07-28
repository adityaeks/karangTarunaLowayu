<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdsResource\Pages;
use App\Filament\Resources\AdsResource\RelationManagers;
use App\Models\Ads;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Redirect;
use Filament\Facades\Filament;

class AdsResource extends Resource
{
    protected static ?string $model = Ads::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationLabel = 'Promosi';
    protected static ?string $pluralLabel = 'Promosi';

    // Menonaktifkan menu di sidebar
    protected static bool $shouldRegisterNavigation = false;

    public static function boot(): void
    {
        parent::boot();

        Filament::serving(function () {
            if (request()->is('admin/ads')) {
                $adsCount = Ads::count();
                if ($adsCount === 1) {
                    $ads = Ads::first();
                    Redirect::to(static::getUrl('edit', ['record' => $ads->id]))->send();
                    exit;
                }
            }
        });
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(1) // Single-column grid
                    ->schema([
                        FileUpload::make('photo')
                            ->disk('public_uploads') // custom disk ke public/uploads
                            ->directory('ads')
                            ->required()
                            ->image()
                            ->columnSpan('full'), // Full width
                        TextInput::make('title')
                            ->required()
                            ->columnSpan('full'), // Full width
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo')
                    ->disk('public_uploads'),
                Tables\Columns\TextColumn::make('title'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\EditAds::route('/{record?}'),
        ];
    }
}

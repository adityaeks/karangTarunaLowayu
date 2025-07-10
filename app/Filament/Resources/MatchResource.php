<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MatchResource\Pages;
use App\Filament\Resources\MatchResource\RelationManagers;
use App\Models\Match;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Tabs\Tab;
use App\Models\Match17;

class MatchResource extends Resource
{
    protected static ?string $model = Match17::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Lomba Agustus';
    protected static ?string $modelLabel = 'Lomba Agustus';
    protected static ?string $pluralModelLabel = 'Lomba Agustus';
    // protected static ?string $navigationGroup = 'Lomba Agustus';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('team1')
                    ->label('Team 1')
                    ->required()
                    ->numeric()
                    ->prefix('RT ')
                    ->maxLength(3),
                Forms\Components\TextInput::make('team2')
                    ->label('Team 2')
                    ->required()
                    ->numeric()
                    ->prefix('RT ')
                    ->maxLength(3),
                Forms\Components\TextInput::make('score')
                    ->maxLength(20),
                Forms\Components\DatePicker::make('date')
                    ->required(),
                Forms\Components\TimePicker::make('time')
                    ->required()
                    ->seconds(false),
                Forms\Components\Select::make('type')
                    ->options([
                        'sepakbola' => 'Sepak Bola',
                        'voli' => 'Bola Voli',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('team1')
                    ->label('Team 1')
                    ->formatStateUsing(fn($state) => 'RT ' . $state)
                    ->searchable(),
                Tables\Columns\TextColumn::make('team2')
                    ->label('Team 2')
                    ->formatStateUsing(fn($state) => 'RT ' . $state)
                    ->searchable(),
                Tables\Columns\TextColumn::make('score'),
                Tables\Columns\TextColumn::make('date')->date(),
                Tables\Columns\TextColumn::make('time')
                    ->formatStateUsing(fn($state) => substr($state, 0, 5)),
                Tables\Columns\TextColumn::make('type')->label('Jenis'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'sepakbola' => 'Sepak Bola',
                        'voli' => 'Bola Voli',
                    ]),
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
            'index' => Pages\ListMatches::route('/'),
            'create' => Pages\CreateMatch::route('/create'),
            'edit' => Pages\EditMatch::route('/{record}/edit'),
        ];
    }
}

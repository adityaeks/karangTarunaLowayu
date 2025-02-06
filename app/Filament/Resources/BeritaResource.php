<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BeritaResource\Pages;
use App\Filament\Resources\BeritaResource\RelationManagers;
use App\Models\Berita;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\SelectFilter;

class BeritaResource extends Resource
{
    protected static ?string $model = Berita::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationLabel = 'Berita';
    protected static ?string $navigationGroup = 'Kelola Website';
    protected static ?string $pluralLabel = 'Berita';
    protected static ?string $label = 'Berita';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Image')
                    ->schema([
                        FileUpload::make('photo')
                            ->label('Thumbnail')
                            ->image()
                            ->required(),
                    ])
                    ->collapsible(),

                Section::make()
                    ->schema([
                        TextInput::make('name')
                            ->label('Judul Berita')
                            ->required()
                            ->afterStateUpdated(fn(string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),

                        TextInput::make('slug')
                            ->disabled()
                            ->dehydrated()
                            ->required()
                            ->maxLength(255)
                            ->unique(Berita::class, 'slug', ignoreRecord: true),

                        MarkdownEditor::make('content')
                            ->required()
                            ->columnSpan('full'),

                        Select::make('author_id')
                            ->label('Author')
                            ->relationship('author', 'name')
                            ->required(),

                        Select::make('category_id')
                            ->label('Category')
                            ->relationship('category', 'name')
                            ->required(),

                        // TagsInput::make('tags'),

                        DatePicker::make('published_at')
                            ->label('Published Date'),
                    ])
                    ->columns(2),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo')->label('Thumbnail'),
                TextColumn::make('published_at')->label('Date'), // Add this line
                TextColumn::make('name')->label('Title'),
                TextColumn::make('author.name')->label('Author'),
                TextColumn::make('category.name')->label('Category'),
                TextColumn::make('content')
                    ->limit(30), // Limit the text to 50 characters
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
            'index' => Pages\ListBeritas::route('/'),
            'create' => Pages\CreateBerita::route('/create'),
            'edit' => Pages\EditBerita::route('/{record}/edit'),
        ];
    }
}

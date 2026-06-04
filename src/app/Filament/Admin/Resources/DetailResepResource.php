<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\DetailResepResource\Pages;
use App\Models\DetailResep;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DetailResepResource extends Resource
{
    protected static ?string $model = DetailResep::class;

    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';

    protected static ?string $navigationLabel = 'Detail Resep';

    protected static ?string $modelLabel = 'Detail Resep';

    protected static ?string $pluralModelLabel = 'Detail Resep';

    protected static ?string $navigationGroup = 'Master Data';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Select::make('resep_id')
                    ->label('Resep')
                    ->relationship('resep', 'nama')
                    ->searchable()
                    ->preload()
                    ->required(),

                Forms\Components\Select::make('bahan_id')
                    ->label('Bahan')
                    ->relationship('bahan', 'nama')
                    ->searchable()
                    ->preload()
                    ->required(),

                Forms\Components\TextInput::make('jumlah')
                    ->label('Jumlah')
                    ->required()
                    ->placeholder('Contoh: 500 gram'),
            ])
            ->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('resep.nama')
                    ->label('Resep')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('bahan.nama')
                    ->label('Bahan')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('jumlah')
                    ->label('Jumlah'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->date('d M Y')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('resep')
                    ->relationship('resep', 'nama'),

                Tables\Filters\SelectFilter::make('bahan')
                    ->relationship('bahan', 'nama'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Edit'),

                Tables\Actions\DeleteAction::make()
                    ->label('Hapus'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDetailReseps::route('/'),
            'create' => Pages\CreateDetailResep::route('/create'),
            'edit' => Pages\EditDetailResep::route('/{record}/edit'),
        ];
    }
}
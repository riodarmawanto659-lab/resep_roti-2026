<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\BahanResource\Pages;
use App\Models\Bahan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BahanResource extends Resource
{
    protected static ?string $model = Bahan::class;

    protected static ?string $navigationIcon = 'heroicon-o-beaker';

    protected static ?string $navigationLabel = 'Bahan';

    protected static ?string $modelLabel = 'Bahan';

    protected static ?string $pluralModelLabel = 'Bahan';

    protected static ?string $navigationGroup = 'Master Data';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\TextInput::make('nama')
                    ->label('Nama Bahan')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),

                Forms\Components\Select::make('satuan')
                    ->label('Satuan')
                    ->required()
                    ->options([
                        'gram' => 'Gram',
                        'kg' => 'Kilogram',
                        'ml' => 'Mililiter',
                        'liter' => 'Liter',
                        'sendok makan' => 'Sendok Makan',
                        'sendok teh' => 'Sendok Teh',
                        'butir' => 'Butir',
                        'bungkus' => 'Bungkus',
                        'buah' => 'Buah',
                    ])
                    ->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Bahan')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('satuan')
                    ->label('Satuan'),

                Tables\Columns\TextColumn::make('detail_reseps_count')
                    ->label('Digunakan')
                    ->counts('detailReseps')
                    ->suffix(' resep'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->date('d M Y')
                    ->sortable(),
            ])
            ->defaultSort('nama')
            ->filters([
                //
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
            'index' => Pages\ListBahans::route('/'),
            'create' => Pages\CreateBahan::route('/create'),
            'edit' => Pages\EditBahan::route('/{record}/edit'),
        ];
    }
}
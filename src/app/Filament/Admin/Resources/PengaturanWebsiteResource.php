<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PengaturanWebsiteResource\Pages;
use App\Models\PengaturanWebsite;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PengaturanWebsiteResource extends Resource
{
    protected static ?string $model = PengaturanWebsite::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationLabel = 'Pengaturan Website';

    protected static ?string $modelLabel = 'Pengaturan Website';

    protected static ?string $pluralModelLabel = 'Pengaturan Website';

    protected static ?string $navigationGroup = 'Website';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Section::make('Informasi Website')
                    ->schema([

                        Forms\Components\TextInput::make('nama_website')
                            ->label('Nama Website')
                            ->required(),

                        Forms\Components\FileUpload::make('logo')
                            ->label('Logo Website')
                            ->image()
                            ->directory('website/logo')
                            ->imageEditor(),

                    ])
                    ->columns(2),

                Forms\Components\Section::make('Hero Section')
                    ->schema([

                        Forms\Components\TextInput::make('judul_hero')
                            ->label('Judul Hero')
                            ->required(),

                        Forms\Components\Textarea::make('subjudul_hero')
                            ->label('Sub Judul Hero')
                            ->rows(3),

                        Forms\Components\FileUpload::make('gambar_hero')
                            ->label('Gambar Hero')
                            ->image()
                            ->directory('website/hero')
                            ->imageEditor(),
                    ]),

                Forms\Components\Section::make('Tentang Kami')
                    ->schema([

                        Forms\Components\RichEditor::make('tentang_kami')
                            ->label('Tentang Kami')
                            ->columnSpanFull(),

                    ]),

                Forms\Components\Section::make('Kontak')
                    ->schema([

                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->label('Email'),

                        Forms\Components\TextInput::make('telepon')
                            ->tel()
                            ->label('Nomor Telepon'),

                        Forms\Components\Textarea::make('alamat')
                            ->label('Alamat')
                            ->rows(3),
                    ])
                    ->columns(2),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\ImageColumn::make('logo')
                    ->label('Logo')
                    ->circular(),

                Tables\Columns\TextColumn::make('nama_website')
                    ->label('Nama Website')
                    ->searchable(),

                Tables\Columns\TextColumn::make('judul_hero')
                    ->label('Judul Hero')
                    ->limit(40),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->copyable(),

                Tables\Columns\TextColumn::make('telepon')
                    ->label('Telepon'),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Terakhir Diubah')
                    ->dateTime('d M Y H:i'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPengaturanWebsites::route('/'),
            'create' => Pages\CreatePengaturanWebsite::route('/create'),
            'edit' => Pages\EditPengaturanWebsite::route('/{record}/edit'),
        ];
    }
}
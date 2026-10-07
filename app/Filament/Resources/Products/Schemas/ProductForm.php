<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                TextInput::make('name')
                    ->label('Nama menu')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state ?? ''))),

                TextInput::make('slug')
                    ->label('Slug (alamat URL)')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->helperText('Terisi otomatis dari nama menu.'),

                TextInput::make('price')
                    ->label('Harga')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->prefix('Rp'),

                TextInput::make('initial_stock')
                    ->label('Stok awal')
                    ->numeric()
                    ->integer()
                    ->minValue(0)
                    ->default(0)
                    ->required()
                    ->visibleOn('create')
                    ->helperText('Perubahan stok berikutnya dilakukan lewat tombol "Tambah stok" atau "Koreksi stok" supaya tercatat di riwayat.'),

                TextInput::make('stock')
                    ->label('Stok saat ini')
                    ->disabled()
                    ->dehydrated(false)
                    ->visibleOn('edit')
                    ->helperText('Ubah lewat tombol "Tambah stok" atau "Koreksi stok" di daftar menu.'),

                TextInput::make('low_stock_threshold')
                    ->label('Batas stok menipis')
                    ->numeric()
                    ->integer()
                    ->minValue(0)
                    ->default(5)
                    ->required()
                    ->helperText('Peringatan muncul saat stok sama dengan atau di bawah angka ini.'),

                Textarea::make('description')
                    ->label('Deskripsi')
                    ->rows(4)
                    ->columnSpanFull(),

                FileUpload::make('image')
                    ->label('Foto menu')
                    ->image()
                    ->disk('public')
                    ->visibility('public')
                    ->directory('products')
                    ->maxSize(2048)
                    ->columnSpanFull(),

                Toggle::make('is_available')
                    ->label('Tampil di menu')
                    ->default(true)
                    ->helperText('Saklar manual untuk menyembunyikan menu. Status "Habis" diatur otomatis dari stok.'),

                Toggle::make('is_featured')
                    ->label('Tampil di menu favorit (beranda)'),
            ]);
    }
}

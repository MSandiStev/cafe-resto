<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Models\Product;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ImageEntry::make('image')
                    ->label('Foto')
                    ->disk('public')
                    ->placeholder('-'),
                TextEntry::make('name')
                    ->label('Nama menu'),
                TextEntry::make('category.name')
                    ->label('Kategori'),
                TextEntry::make('price')
                    ->label('Harga')
                    ->money('IDR', locale: 'id', decimalPlaces: 0),
                TextEntry::make('stock')
                    ->label('Stok saat ini')
                    ->badge()
                    ->formatStateUsing(fn ($state) => (int) $state <= 0 ? 'Habis' : (string) $state)
                    ->color(fn (Product $record) => match ($record->stockStatus()) {
                        'out'   => 'danger',
                        'low'   => 'warning',
                        default => 'success',
                    }),
                TextEntry::make('low_stock_threshold')
                    ->label('Batas stok menipis'),
                TextEntry::make('slug')
                    ->label('Slug'),
                TextEntry::make('description')
                    ->label('Deskripsi')
                    ->placeholder('-')
                    ->columnSpanFull(),
                IconEntry::make('is_available')
                    ->label('Tampil di menu')
                    ->boolean(),
                IconEntry::make('is_featured')
                    ->label('Menu favorit')
                    ->boolean(),
            ]);
    }
}

<?php

namespace App\Filament\Resources\Products\Schemas;

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
                TextEntry::make('slug')
                    ->label('Slug'),
                TextEntry::make('description')
                    ->label('Deskripsi')
                    ->placeholder('-')
                    ->columnSpanFull(),
                IconEntry::make('is_available')
                    ->label('Tersedia')
                    ->boolean(),
                IconEntry::make('is_featured')
                    ->label('Menu favorit')
                    ->boolean(),
            ]);
    }
}

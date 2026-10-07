<?php

namespace App\Filament\Resources\StockMovements\Tables;

use App\Models\StockMovement;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class StockMovementsTable
{
    public static function configure(Table $table, bool $withProduct = true): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->label('Waktu')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
                TextColumn::make('product.name')
                    ->label('Menu')
                    ->searchable()
                    ->visible($withProduct),
                TextColumn::make('type')
                    ->label('Jenis')
                    ->badge()
                    ->formatStateUsing(fn (string $state) => StockMovement::TYPES[$state] ?? $state)
                    ->color(fn (string $state) => StockMovement::TYPE_COLORS[$state] ?? 'gray'),
                TextColumn::make('quantity')
                    ->label('Perubahan')
                    ->badge()
                    ->formatStateUsing(fn (int $state) => ($state > 0 ? '+' : '') . $state)
                    ->color(fn (int $state) => $state > 0 ? 'success' : 'danger'),
                TextColumn::make('stock_after')
                    ->label('Stok akhir')
                    ->description(fn (StockMovement $record) => 'sebelumnya ' . $record->stock_before),
                TextColumn::make('order.order_number')
                    ->label('Pesanan')
                    ->placeholder('-'),
                TextColumn::make('user.name')
                    ->label('Oleh')
                    ->placeholder('Sistem'),
                TextColumn::make('note')
                    ->label('Catatan')
                    ->placeholder('-')
                    ->wrap(),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->label('Jenis')
                    ->options(StockMovement::TYPES),
            ])
            ->defaultSort('created_at', 'desc')
            ->defaultPaginationPageOption(25);
    }
}

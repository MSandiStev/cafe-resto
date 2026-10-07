<?php

namespace App\Filament\Resources\Products\Tables;

use App\Filament\Resources\Products\Actions\StockActions;
use App\Models\Product;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ProductsTable
{
    /** Kolom stok berwarna: merah = habis, kuning = menipis, hijau = aman. Dipakai juga di widget dashboard. */
    public static function stockColumn(): TextColumn
    {
        return TextColumn::make('stock')
            ->label('Stok')
            ->badge()
            ->sortable()
            ->formatStateUsing(fn ($state) => (int) $state <= 0 ? 'Habis' : (string) $state)
            ->description(fn (Product $record) => $record->isLowStock() ? 'Menipis' : null)
            ->color(fn (Product $record) => match ($record->stockStatus()) {
                'out'   => 'danger',
                'low'   => 'warning',
                default => 'success',
            });
    }

    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Foto')
                    ->disk('public')
                    ->square(),

                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('category.name')
                    ->label('Kategori')
                    ->sortable(),

                TextColumn::make('price')
                    ->label('Harga')
                    ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.'))
                    ->sortable(),

                self::stockColumn(),

                ToggleColumn::make('is_available')
                    ->label('Tampil di menu'),

                IconColumn::make('is_featured')
                    ->label('Favorit')
                    ->boolean(),
            ])
            ->filters([
                Filter::make('needs_restock')
                    ->label('Stok menipis / habis')
                    ->query(fn (Builder $query) => $query->needsRestock())
                    ->toggle(),
                SelectFilter::make('category')
                    ->label('Kategori')
                    ->relationship('category', 'name'),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                ActionGroup::make([
                    StockActions::add(),
                    StockActions::correct(),
                ])
                    ->label('Stok')
                    ->icon(Heroicon::OutlinedCube)
                    ->button(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('name');
    }
}
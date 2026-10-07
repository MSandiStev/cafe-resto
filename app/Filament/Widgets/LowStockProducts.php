<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Products\Actions\StockActions;
use App\Filament\Resources\Products\Tables\ProductsTable;
use App\Models\Product;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class LowStockProducts extends TableWidget
{
    protected static ?int $sort = 5;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->heading('Stok perlu perhatian')
            ->description('Menu yang stoknya menipis atau sudah habis.')
            ->query(fn (): Builder => Product::query()->needsRestock())
            ->columns([
                TextColumn::make('name')
                    ->label('Menu')
                    ->searchable(),
                TextColumn::make('category.name')
                    ->label('Kategori'),
                ProductsTable::stockColumn(),
                TextColumn::make('low_stock_threshold')
                    ->label('Batas menipis'),
            ])
            ->recordActions([
                StockActions::add(),
            ])
            ->defaultSort('stock')
            ->paginated([5, 10])
            ->emptyStateHeading('Semua stok aman')
            ->emptyStateDescription('Tidak ada menu yang stoknya menipis atau habis.');
    }
}

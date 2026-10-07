<?php

namespace App\Filament\Resources\Products\RelationManagers;

use App\Filament\Resources\StockMovements\Tables\StockMovementsTable;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class StockMovementsRelationManager extends RelationManager
{
    protected static string $relationship = 'stockMovements';

    protected static ?string $title = 'Riwayat stok';

    public function table(Table $table): Table
    {
        return StockMovementsTable::configure($table, withProduct: false);
    }
}

<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\Actions\StockActions;
use App\Filament\Resources\Products\ProductResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewProduct extends ViewRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            StockActions::add(),
            StockActions::correct(),
            EditAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use App\Services\StockService;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    protected int $initialStock = 0;

    // Stok awal tidak disimpan langsung ke kolom; dicatat lewat StockService supaya masuk riwayat.
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $this->initialStock = (int) ($data['initial_stock'] ?? 0);
        unset($data['initial_stock']);

        return $data;
    }

    protected function afterCreate(): void
    {
        if ($this->initialStock > 0) {
            app(StockService::class)->adjust($this->record, $this->initialStock, 'initial', 'Stok awal');
        }
    }
}

<?php

namespace App\Filament\Resources\Products\Actions;

use App\Models\Product;
use App\Services\StockService;
use Filament\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;

class StockActions
{
    /** Tombol "Tambah stok" (barang masuk). */
    public static function add(): Action
    {
        return Action::make('addStock')
            ->label('Tambah stok')
            ->icon(Heroicon::OutlinedPlusCircle)
            ->color('success')
            ->modalHeading(fn (Product $record) => 'Tambah stok: ' . $record->name)
            ->modalSubmitActionLabel('Simpan')
            ->schema([
                TextInput::make('quantity')
                    ->label('Jumlah masuk')
                    ->numeric()
                    ->integer()
                    ->required()
                    ->minValue(1)
                    ->maxValue(100000),
                Textarea::make('note')
                    ->label('Catatan')
                    ->placeholder('Contoh: belanja pasar, kiriman supplier')
                    ->rows(2)
                    ->maxLength(255),
            ])
            ->action(function (Product $record, array $data) {
                app(StockService::class)->adjust($record, (int) $data['quantity'], 'restock', $data['note'] ?? null);

                Notification::make()
                    ->title('Stok ditambahkan')
                    ->body("{$record->name}: stok sekarang {$record->stock}.")
                    ->success()
                    ->send();
            });
    }

    /** Tombol "Koreksi stok" (set ke jumlah sebenarnya hasil hitung fisik). */
    public static function correct(): Action
    {
        return Action::make('correctStock')
            ->label('Koreksi stok')
            ->icon(Heroicon::OutlinedAdjustmentsHorizontal)
            ->color('gray')
            ->modalHeading(fn (Product $record) => 'Koreksi stok: ' . $record->name)
            ->modalDescription('Isi jumlah stok yang sebenarnya. Selisihnya dicatat di riwayat.')
            ->modalSubmitActionLabel('Simpan')
            ->fillForm(fn (Product $record) => ['new_stock' => $record->stock])
            ->schema([
                TextInput::make('new_stock')
                    ->label('Stok sebenarnya')
                    ->numeric()
                    ->integer()
                    ->required()
                    ->minValue(0)
                    ->maxValue(100000),
                Textarea::make('note')
                    ->label('Alasan koreksi')
                    ->placeholder('Contoh: rusak, kadaluarsa, selisih hitung fisik')
                    ->required()
                    ->rows(2)
                    ->maxLength(255),
            ])
            ->action(function (Product $record, array $data) {
                $movement = app(StockService::class)->setTo($record, (int) $data['new_stock'], $data['note']);

                if (! $movement) {
                    Notification::make()->title('Tidak ada perubahan stok')->warning()->send();

                    return;
                }

                Notification::make()
                    ->title('Stok dikoreksi')
                    ->body("{$record->name}: stok sekarang {$record->stock}.")
                    ->success()
                    ->send();
            });
    }
}

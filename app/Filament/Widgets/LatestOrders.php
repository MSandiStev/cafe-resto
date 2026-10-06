<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Orders\OrderResource;
use App\Models\Order;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class LatestOrders extends TableWidget
{
    protected static ?int $sort = 4;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(fn () => Order::query()->latest()->limit(6))
            ->heading('Pesanan terbaru')
            ->paginated(false)
            ->poll('30s')
            ->columns([
                TextColumn::make('order_number')
                    ->label('No. pesanan'),
                TextColumn::make('customer_name')
                    ->label('Pelanggan')
                    ->description(fn (Order $record) => $record->customer_phone),
                TextColumn::make('type')
                    ->label('Tipe')
                    ->badge()
                    ->color('gray')
                    ->formatStateUsing(fn (string $state) => Order::TYPES[$state] ?? $state),
                TextColumn::make('total')
                    ->label('Total')
                    ->money('IDR', locale: 'id', decimalPlaces: 0),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn (string $state) => Order::STATUSES[$state] ?? $state)
                    ->color(fn (string $state) => Order::STATUS_COLORS[$state] ?? 'gray'),
                TextColumn::make('created_at')
                    ->label('Waktu')
                    ->since(),
            ])
            ->recordUrl(fn (Order $record) => OrderResource::getUrl('view', ['record' => $record]))
            ->emptyStateHeading('Belum ada pesanan')
            ->emptyStateDescription('Pesanan dari website akan muncul di sini.');
    }
}

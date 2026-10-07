<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Orders\OrderResource;
use App\Models\Order;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class LatestOrders extends TableWidget
{
    protected static ?int $sort = 4;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(fn () => Order::query()->latest()->limit(7))
            ->heading('Pesanan Masuk Terbaru')
            ->description('7 pesanan terakhir.')
            ->headerActions([
                Action::make('view_all')
                    ->label('Lihat semua pesanan')
                    ->url(fn (): string => OrderResource::getUrl('index'))
                    ->color('gray'),
            ])
            ->paginated(false)
            ->poll('20s')
            ->columns([
                TextColumn::make('order_number')
                    ->label('No. Pesanan')
                    ->weight('bold')
                    ->searchable(),

                TextColumn::make('customer_name')
                    ->label('Pelanggan')
                    ->description(fn (Order $record): ?string => $record->customer_phone ?: ($record->table_number ? 'Meja '.$record->table_number : null)),

                TextColumn::make('type')
                    ->label('Tipe Pesanan')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'dine_in' => 'warning',
                        'pickup' => 'info',
                        'delivery' => 'primary',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => Order::TYPES[$state] ?? $state),

                TextColumn::make('total')
                    ->label('Total Transaksi')
                    ->money('IDR', locale: 'id', decimalPlaces: 0)
                    ->weight('semibold'),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => Order::STATUSES[$state] ?? $state)
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'danger',
                        'processing' => 'warning',
                        'ready' => 'info',
                        'completed' => 'success',
                        'cancelled' => 'gray',
                        default => 'gray',
                    }),

                TextColumn::make('created_at')
                    ->label('Waktu Masuk')
                    ->since()
                    ->color('gray'),
            ])
            ->recordUrl(fn (Order $record): string => OrderResource::getUrl('view', ['record' => $record]))
            ->emptyStateHeading('Belum ada pesanan terbaru')
            ->emptyStateDescription('Pesanan dari pelanggan di website akan otomatis muncul di sini.');
    }
}

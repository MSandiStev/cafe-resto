<?php

namespace App\Filament\Resources\Orders\Tables;

use App\Models\Order;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order_number')
                    ->label('No. pesanan')
                    ->searchable()
                    ->copyable(),
                TextColumn::make('created_at')
                    ->label('Waktu')
                    ->dateTime('d M, H:i')
                    ->sortable(),
                TextColumn::make('customer_name')
                    ->label('Pelanggan')
                    ->description(fn (Order $record) => $record->customer_phone)
                    ->searchable(),
                TextColumn::make('type')
                    ->label('Tipe')
                    ->badge()
                    ->color('gray')
                    ->formatStateUsing(fn (string $state) => Order::TYPES[$state] ?? $state),
                TextColumn::make('total')
                    ->label('Total')
                    ->money('IDR', locale: 'id', decimalPlaces: 0)
                    ->sortable(),
                TextColumn::make('payment_status')
                    ->label('Pembayaran')
                    ->badge()
                    ->formatStateUsing(fn (string $state) => Order::PAYMENT_STATUSES[$state] ?? $state)
                    ->color(fn (string $state) => $state === 'paid' ? 'success' : 'danger'),
                // Status bisa diganti langsung dari daftar, tanpa membuka halaman edit.
                SelectColumn::make('status')
                    ->label('Status')
                    ->options(Order::STATUSES)
                    ->selectablePlaceholder(false),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options(Order::STATUSES),
                SelectFilter::make('type')
                    ->label('Tipe')
                    ->options(Order::TYPES),
                SelectFilter::make('payment_status')
                    ->label('Pembayaran')
                    ->options(Order::PAYMENT_STATUSES),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->defaultSort('created_at', 'desc')
            ->poll('20s');
    }
}

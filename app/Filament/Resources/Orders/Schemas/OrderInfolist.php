<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\Models\Order;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class OrderInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Pesanan')
                    ->columnSpanFull()
                    ->columns(3)
                    ->schema([
                        TextEntry::make('order_number')
                            ->label('Nomor pesanan')
                            ->copyable(),
                        TextEntry::make('status')
                            ->label('Status pesanan')
                            ->badge()
                            ->formatStateUsing(fn (string $state) => Order::STATUSES[$state] ?? $state)
                            ->color(fn (string $state) => Order::STATUS_COLORS[$state] ?? 'gray'),
                        TextEntry::make('payment_status')
                            ->label('Pembayaran')
                            ->badge()
                            ->formatStateUsing(fn (string $state) => Order::PAYMENT_STATUSES[$state] ?? $state)
                            ->color(fn (string $state) => $state === 'paid' ? 'success' : 'danger'),
                        TextEntry::make('type')
                            ->label('Tipe pesanan')
                            ->formatStateUsing(fn (string $state) => Order::TYPES[$state] ?? $state),
                        TextEntry::make('payment_method')
                            ->label('Metode pembayaran')
                            ->placeholder('-'),
                        TextEntry::make('created_at')
                            ->label('Waktu pesan')
                            ->dateTime('d M Y, H:i'),
                    ]),

                Section::make('Pelanggan')
                    ->columnSpanFull()
                    ->columns(3)
                    ->schema([
                        TextEntry::make('customer_name')
                            ->label('Nama'),
                        TextEntry::make('customer_phone')
                            ->label('Nomor HP')
                            ->copyable(),
                        TextEntry::make('table_number')
                            ->label('Nomor meja')
                            ->placeholder('-'),
                        TextEntry::make('delivery_address')
                            ->label('Alamat pengantaran')
                            ->placeholder('-')
                            ->columnSpan(2),
                        TextEntry::make('notes')
                            ->label('Catatan')
                            ->placeholder('-')
                            ->columnSpanFull(),
                    ]),

                Section::make('Item pesanan')
                    ->columnSpanFull()
                    ->schema([
                        RepeatableEntry::make('items')
                            ->hiddenLabel()
                            ->columns(5)
                            ->schema([
                                TextEntry::make('product_name')
                                    ->label('Menu')
                                    ->columnSpan(2),
                                TextEntry::make('qty')
                                    ->label('Jumlah'),
                                TextEntry::make('price')
                                    ->label('Harga')
                                    ->money('IDR', locale: 'id', decimalPlaces: 0),
                                TextEntry::make('subtotal')
                                    ->label('Subtotal')
                                    ->money('IDR', locale: 'id', decimalPlaces: 0),
                                TextEntry::make('note')
                                    ->label('Catatan')
                                    ->placeholder('-')
                                    ->columnSpanFull(),
                            ]),
                    ]),

                Section::make('Rincian biaya')
                    ->columnSpanFull()
                    ->columns(3)
                    ->schema([
                        TextEntry::make('subtotal')
                            ->label('Subtotal')
                            ->money('IDR', locale: 'id', decimalPlaces: 0),
                        TextEntry::make('delivery_fee')
                            ->label('Ongkir')
                            ->money('IDR', locale: 'id', decimalPlaces: 0),
                        TextEntry::make('total')
                            ->label('Total')
                            ->money('IDR', locale: 'id', decimalPlaces: 0)
                            ->weight('bold'),
                    ]),
            ]);
    }
}

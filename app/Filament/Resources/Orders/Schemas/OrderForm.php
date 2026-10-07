<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\Models\Order;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Status pesanan')
                    ->columnSpanFull()
                    ->columns(3)
                    ->schema([
                        Select::make('status')
                            ->label('Status pesanan')
                            ->options(Order::STATUSES)
                            ->required()
                            ->native(false)
                            ->disabled(fn (?Order $record) => $record?->status === 'cancelled')
                            ->helperText('Pesanan yang dibatalkan mengembalikan stok otomatis dan tidak bisa dibuka lagi.'),
                        Select::make('payment_status')
                            ->label('Status pembayaran')
                            ->options(Order::PAYMENT_STATUSES)
                            ->required()
                            ->native(false),
                        TextInput::make('payment_method')
                            ->label('Metode pembayaran')
                            ->placeholder('Contoh: Tunai di kasir')
                            ->maxLength(30),
                    ]),

                // Data di bawah hanya untuk dibaca. Kolom disabled tidak ikut tersimpan.
                Section::make('Data pelanggan')
                    ->columnSpanFull()
                    ->columns(2)
                    ->schema([
                        TextInput::make('order_number')
                            ->label('Nomor pesanan')
                            ->disabled(),
                        TextInput::make('customer_name')
                            ->label('Nama pelanggan')
                            ->disabled(),
                        TextInput::make('customer_phone')
                            ->label('Nomor HP')
                            ->disabled(),
                        Select::make('type')
                            ->label('Tipe pesanan')
                            ->options(Order::TYPES)
                            ->disabled(),
                        TextInput::make('table_number')
                            ->label('Nomor meja')
                            ->disabled(),
                        Textarea::make('delivery_address')
                            ->label('Alamat pengantaran')
                            ->rows(2)
                            ->disabled(),
                        Textarea::make('notes')
                            ->label('Catatan pelanggan')
                            ->rows(2)
                            ->disabled()
                            ->columnSpanFull(),
                    ]),

                Section::make('Rincian biaya')
                    ->columnSpanFull()
                    ->columns(3)
                    ->schema([
                        TextInput::make('subtotal')
                            ->label('Subtotal')
                            ->prefix('Rp')
                            ->disabled(),
                        TextInput::make('delivery_fee')
                            ->label('Ongkir')
                            ->prefix('Rp')
                            ->disabled(),
                        TextInput::make('total')
                            ->label('Total')
                            ->prefix('Rp')
                            ->disabled(),
                    ]),
            ]);
    }
}

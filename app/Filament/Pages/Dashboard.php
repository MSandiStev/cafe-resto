<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use Illuminate\Contracts\Support\Htmlable;

class Dashboard extends BaseDashboard
{
    protected static ?string $title = 'Dashboard Operasional';

    public function getHeading(): string|Htmlable|null
    {
        return 'Ringkasan Operasional & Penjualan';
    }

    public function getSubheading(): string|Htmlable|null
    {
        return 'Pantau metrik penjualan harian, pesanan pelanggan, dan performa menu secara real-time.';
    }

    public function getColumns(): int|array
    {
        return [
            'default' => 1,
            'md' => 2,
            'xl' => 3,
        ];
    }
}

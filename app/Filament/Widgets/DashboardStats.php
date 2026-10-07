<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStats extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected ?string $pollingInterval = '30s';

    protected int|string|array $columnSpan = 'full';

    protected function getStats(): array
    {
        $ordersToday = Order::whereDate('created_at', today())->count();
        $ordersYesterday = Order::whereDate('created_at', today()->subDay())->count();

        $revenueToday = (int) Order::whereDate('created_at', today())
            ->where('status', '!=', 'cancelled')
            ->sum('total');

        $pending = Order::where('status', 'pending')->count();

        $availableMenu = Product::where('is_available', true)->count();
        $totalMenu = Product::count();

        // Trend pesanan 7 hari
        $perDay = Order::where('created_at', '>=', today()->subDays(6))
            ->get(['created_at'])
            ->groupBy(fn (Order $order) => $order->created_at->format('Y-m-d'));
            
        $diff = $ordersToday - $ordersYesterday;

        $trend = [];
        for ($i = 6; $i >= 0; $i--) {
            $trend[] = $perDay->get(today()->subDays($i)->format('Y-m-d'))?->count() ?? 0;
        }

        // Trend omzet 7 hari
        $revPerDay = Order::where('created_at', '>=', today()->subDays(6))
            ->where('status', '!=', 'cancelled')
            ->get(['created_at', 'total'])
            ->groupBy(fn (Order $order) => $order->created_at->format('Y-m-d'));

        $revTrend = [];
        for ($i = 6; $i >= 0; $i--) {
            $revTrend[] = (int) ($revPerDay->get(today()->subDays($i)->format('Y-m-d'))?->sum('total') ?? 0);
        }

        $revenueYesterday = (int) Order::whereDate('created_at', today()->subDay())
            ->where('status', '!=', 'cancelled')
            ->sum('total');
            
        $revDiff = $revenueToday - $revenueYesterday;

        return [
            Stat::make('Pesanan hari ini', $ordersToday)
                ->description(match (true) {
                    $diff > 0 => "+{$diff} dibanding kemarin",
                    $diff < 0 => abs($diff).' lebih sedikit dari kemarin',
                    default => 'Stabil dibanding kemarin',
                })
                ->descriptionIcon($diff >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($diff >= 0 ? 'success' : 'danger')
                ->chart($trend),

            Stat::make('Omzet hari ini', 'Rp '.number_format($revenueToday, 0, ',', '.'))
                ->description(match (true) {
                    $revDiff > 0 => '+Rp '.number_format($revDiff, 0, ',', '.').' dari kemarin',
                    $revDiff < 0 => '-Rp '.number_format(abs($revDiff), 0, ',', '.').' dari kemarin',
                    default => 'Sama dengan kemarin',
                })
                ->descriptionIcon($revDiff >= 0 ? 'heroicon-m-banknotes' : 'heroicon-m-arrow-trending-down')
                ->color($revDiff >= 0 ? 'success' : 'danger')
                ->chart($revTrend),

            Stat::make('Perlu diproses', $pending)
                ->description($pending > 0 ? 'Pesanan menunggu konfirmasi' : 'Semua pesanan sudah ditangani')
                ->descriptionIcon($pending > 0 ? 'heroicon-m-clock' : 'heroicon-m-check-badge')
                ->color($pending > 0 ? 'danger' : 'success'),

            Stat::make('Menu tersedia', "{$availableMenu} dari {$totalMenu}")
                ->description($availableMenu < $totalMenu ? ($totalMenu - $availableMenu).' menu sedang dimatikan' : 'Semua menu aktif')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('gray'),
        ];
    }
}
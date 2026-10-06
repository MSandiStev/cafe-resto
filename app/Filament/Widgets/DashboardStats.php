<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Product;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStats extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected ?string $pollingInterval = '30s';

    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        $ordersToday     = Order::whereDate('created_at', today())->count();
        $ordersYesterday = Order::whereDate('created_at', today()->subDay())->count();

        $revenueToday = (int) Order::whereDate('created_at', today())
            ->where('status', '!=', 'cancelled')
            ->sum('total');

        $pending = Order::where('status', 'pending')->count();

        $availableMenu = Product::where('is_available', true)->count();
        $totalMenu     = Product::count();

        // Jumlah pesanan per hari selama 7 hari terakhir, untuk garis kecil di kartu.
        $perDay = Order::where('created_at', '>=', today()->subDays(6))
            ->get(['created_at'])
            ->groupBy(fn (Order $order) => $order->created_at->format('Y-m-d'));

        $trend = [];
        for ($i = 6; $i >= 0; $i--) {
            $trend[] = $perDay->get(today()->subDays($i)->format('Y-m-d'))?->count() ?? 0;
        }

        $diff = $ordersToday - $ordersYesterday;

        return [
            Stat::make('Pesanan hari ini', $ordersToday)
                ->description(match (true) {
                    $diff > 0  => "{$diff} lebih banyak dari kemarin",
                    $diff < 0  => abs($diff) . ' lebih sedikit dari kemarin',
                    default    => 'Sama dengan kemarin',
                })
                ->descriptionIcon($diff >= 0 ? Heroicon::OutlinedArrowTrendingUp : Heroicon::OutlinedArrowTrendingDown)
                ->color($diff >= 0 ? 'success' : 'danger')
                ->chart($trend),

            Stat::make('Omzet hari ini', 'Rp ' . number_format($revenueToday, 0, ',', '.'))
                ->description('Tidak termasuk pesanan batal')
                ->descriptionIcon(Heroicon::OutlinedBanknotes)
                ->color('primary'),

            Stat::make('Perlu diproses', $pending)
                ->description($pending > 0 ? 'Pesanan menunggu konfirmasi' : 'Semua pesanan sudah ditangani')
                ->descriptionIcon($pending > 0 ? Heroicon::OutlinedClock : Heroicon::OutlinedCheckBadge)
                ->color($pending > 0 ? 'danger' : 'success'),

            Stat::make('Menu tersedia', "{$availableMenu} dari {$totalMenu}")
                ->description($availableMenu < $totalMenu ? ($totalMenu - $availableMenu) . ' menu sedang dimatikan' : 'Semua menu aktif')
                ->descriptionIcon(Heroicon::OutlinedShoppingBag)
                ->color('gray'),
        ];
    }
}

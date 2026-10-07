<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Orders\OrderResource;
use App\Filament\Resources\Products\ProductResource;
use App\Models\Order;
use App\Models\Product;
use Filament\Widgets\Widget;

class DashboardBanner extends Widget
{
    protected static ?int $sort = 0;

    protected string $view = 'filament.widgets.dashboard-banner';

    protected int|string|array $columnSpan = 'full';

    protected function getViewData(): array
    {
        $adminName = auth()->user()?->name ?? 'Admin';
        $firstName = explode(' ', trim($adminName))[0];

        $pendingCount = Order::where('status', 'pending')->count();
        $processingCount = Order::where('status', 'processing')->count();

        $todayRevenue = (int) Order::whereDate('created_at', today())
            ->where('status', '!=', 'cancelled')
            ->sum('total');

        $activeProducts = Product::where('is_available', true)->count();
        $totalProducts = Product::count();

        return [
            'adminName' => $adminName,
            'firstName' => $firstName,
            'pendingCount' => $pendingCount,
            'processingCount' => $processingCount,
            'todayRevenue' => $todayRevenue,
            'activeProducts' => $activeProducts,
            'totalProducts' => $totalProducts,
            'createMenuUrl' => ProductResource::getUrl('create'),
            'ordersListUrl' => OrderResource::getUrl('index'),
        ];
    }
}

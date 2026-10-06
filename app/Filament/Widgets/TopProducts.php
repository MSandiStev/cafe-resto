<?php

namespace App\Filament\Widgets;

use App\Models\OrderItem;
use Filament\Widgets\Widget;

class TopProducts extends Widget
{
    protected static ?int $sort = 3;

    protected string $view = 'filament.widgets.top-products';

    protected int | string | array $columnSpan = 1;

    protected function getViewData(): array
    {
        $products = OrderItem::query()
            ->selectRaw('product_name, SUM(qty) as total_qty, SUM(subtotal) as total_sales')
            ->whereHas('order', fn ($query) => $query->where('status', '!=', 'cancelled'))
            ->groupBy('product_name')
            ->orderByDesc('total_qty')
            ->limit(5)
            ->get();

        return [
            'products' => $products,
            'max'      => (int) ($products->max('total_qty') ?? 0),
        ];
    }
}

<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Support\RawJs;
use Filament\Widgets\ChartWidget;

class OmzetChart extends ChartWidget
{
    protected static ?int $sort = 2;

    protected ?string $heading = 'Omzet 7 hari terakhir';

    protected ?string $maxHeight = '280px';

    protected int | string | array $columnSpan = [
        'md' => 2,
        'xl' => 2,
    ];

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getData(): array
    {
        $perDay = Order::where('created_at', '>=', today()->subDays(6))
            ->where('status', '!=', 'cancelled')
            ->get(['total', 'created_at'])
            ->groupBy(fn (Order $order) => $order->created_at->format('Y-m-d'));

        $labels = [];
        $values = [];

        for ($i = 6; $i >= 0; $i--) {
            $day = today()->subDays($i);

            $labels[] = $day->locale('id')->translatedFormat('D, j M');
            $values[] = (int) ($perDay->get($day->format('Y-m-d'))?->sum('total') ?? 0);
        }

        return [
            'datasets' => [
                [
                    'label'        => 'Omzet',
                    'data'         => $values,
                    'borderRadius' => 6,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getOptions(): array | RawJs | null
    {
        return RawJs::make(<<<'JS'
        {
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: (ctx) => 'Rp ' + Number(ctx.parsed.y).toLocaleString('id-ID'),
                    },
                },
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: (value) => 'Rp ' + Number(value).toLocaleString('id-ID'),
                    },
                },
            },
        }
        JS);
    }
}

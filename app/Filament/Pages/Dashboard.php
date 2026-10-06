<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use Illuminate\Contracts\Support\Htmlable;

class Dashboard extends BaseDashboard
{
    protected static ?string $title = 'Ringkasan';

    public function getHeading(): string | Htmlable | null
    {
        $name = explode(' ', trim(auth()->user()?->name ?? 'Admin'))[0];

        return 'Halo, ' . $name;
    }

    public function getSubheading(): string | Htmlable | null
    {
        return now()->locale('id')->translatedFormat('l, j F Y');
    }

    public function getColumns(): int | array
    {
        return [
            'default' => 1,
            'md'      => 2,
            'xl'      => 3,
        ];
    }
}

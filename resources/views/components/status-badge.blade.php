@props(['status'])

@php
    $classes = match ($status) {
        'processing' => 'bg-amber-50 text-amber-700',
        'ready'      => 'bg-sky-50 text-sky-700',
        'completed'  => 'bg-green-50 text-green-700',
        'cancelled'  => 'bg-red-50 text-red-700',
        default      => 'bg-neutral-100 text-neutral-700',
    };
@endphp

<span {{ $attributes->merge(['class' => "inline-block rounded-full px-3 py-1 text-xs font-semibold {$classes}"]) }}>
    {{ \App\Models\Order::STATUSES[$status] ?? $status }}
</span>

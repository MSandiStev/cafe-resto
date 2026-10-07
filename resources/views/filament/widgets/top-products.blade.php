<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            <div class="flex items-center gap-2">
                <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-amber-500/10 text-amber-500">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </span>
                <span>Menu Terlaris</span>
            </div>
        </x-slot>

        <x-slot name="description">
            Peringkat menu berdasarkan total kuantitas pesanan yang berhasil.
        </x-slot>

        <div class="fi-top-products-list">
            @forelse ($products as $item)
                @php
                    $percentage = $max > 0 ? round(($item->total_qty / $max) * 100) : 0;
                    $rank = $loop->iteration;
                @endphp
                <div class="fi-top-product-card">
                    <div class="fi-top-product-header">
                        <div class="fi-top-product-left">
                            <span class="fi-top-rank-badge fi-rank-{{ $rank }}">
                                @if ($rank === 1)
                                    👑 1
                                @elseif ($rank === 2)
                                    🥈 2
                                @elseif ($rank === 3)
                                    🥉 3
                                @else
                                    #{{ $rank }}
                                @endif
                            </span>
                            <div class="fi-top-product-info">
                                <h4 class="fi-top-product-name">{{ $item->product_name }}</h4>
                                <span class="fi-top-product-sales">Rp {{ number_format($item->total_sales ?? 0, 0, ',', '.') }} omzet</span>
                            </div>
                        </div>

                        <div class="fi-top-product-right">
                            <span class="fi-top-qty-pill">{{ $item->total_qty }}x terjual</span>
                        </div>
                    </div>

                    {{-- Progress Bar --}}
                    <div class="fi-top-progress-track">
                        <div class="fi-top-progress-fill fi-fill-{{ $rank }}" style="width: {{ $percentage }}%"></div>
                    </div>
                </div>
            @empty
                <div class="fi-top-empty-state">
                    <div class="fi-top-empty-icon">☕</div>
                    <p class="fi-top-empty-title">Belum ada menu yang terjual</p>
                    <p class="fi-top-empty-desc">Pesanan yang berstatus sukses akan otomatis terdata di peringkat ini.</p>
                </div>
            @endforelse
        </div>
    </x-filament::section>
</x-filament-widgets::widget>

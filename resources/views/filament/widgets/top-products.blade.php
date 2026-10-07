<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">Menu Terlaris</x-slot>

        <x-slot name="description">
            Diurutkan berdasarkan jumlah porsi terjual.
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
                            <span class="fi-top-rank-badge fi-rank-{{ $rank }}">{{ $rank }}</span>
                            <div class="fi-top-product-info">
                                <h4 class="fi-top-product-name">{{ $item->product_name }}</h4>
                                <span class="fi-top-product-sales">Rp {{ number_format($item->total_sales ?? 0, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <span class="fi-top-qty-pill">{{ $item->total_qty }} terjual</span>
                    </div>

                    <div class="fi-top-progress-track">
                        <div class="fi-top-progress-fill" style="width: {{ $percentage }}%"></div>
                    </div>
                </div>
            @empty
                <div class="fi-top-empty-state">
                    <p class="fi-top-empty-title">Belum ada menu yang terjual</p>
                    <p class="fi-top-empty-desc">Menu yang terjual akan muncul di sini.</p>
                </div>
            @endforelse
        </div>
    </x-filament::section>
</x-filament-widgets::widget>

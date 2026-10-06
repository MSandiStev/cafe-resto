<x-filament-widgets::widget>
    <x-filament::section heading="Menu terlaris" description="Berdasarkan jumlah terjual">
        @forelse ($products as $item)
            <div class="cafe-top-row">
                <div class="cafe-top-head">
                    <span class="cafe-top-rank">{{ $loop->iteration }}</span>
                    <span class="cafe-top-name">{{ $item->product_name }}</span>
                    <span class="cafe-top-qty">{{ $item->total_qty }}x</span>
                </div>
                <div class="cafe-top-bar">
                    <span style="width: {{ $max > 0 ? round(($item->total_qty / $max) * 100) : 0 }}%"></span>
                </div>
            </div>
        @empty
            <p class="cafe-top-empty">Belum ada pesanan masuk.</p>
        @endforelse
    </x-filament::section>
</x-filament-widgets::widget>
